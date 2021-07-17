<?php

namespace Drupal\info_fetcher\Plugin\InfoFetcher;

use Drupal\info_fetcher\Plugin\InfoFetcherBase;
use Drupal\Component\Plugin\Exception\PluginException;

/**
 * 
 * @InfoFetcher(
 *   id = "news",
 *   label = @Translation("News Info Grabber")
 * )
 */

class InfoFetcherNews extends InfoFetcherBase {

  protected function extractData ($xml, $cutOffTime) {
    $data = [];
    foreach ($xml->channel->item as $item){
      if($item->pubDate) {
        $articleDate = strtotime( (string) $item->pubDate);
        // If the article is from the last 24 hrs, then save it.
        // This is not a precise method, it's possible I will miss
        // articles from the feed, so this method is just meant to get
        // most of the articles. If I wanted to get all of the articles then
        // I would have a more complex entity for saving the articles individually
        // in their own row.
        if($articleDate > $cutOffTime){     
          $item->title = (string) $item->title;  
          $data[] = $item;
        }
      }
    }
    if($data) {
      $data = json_encode($data);
    }
    return $data;
  }

  protected function lastCreated() {
    // Get the id of the last news item saved.
    $database = \Drupal::database();    
    $result = $database->query("select created from fetched_info where type='news' order by id desc limit 1");
    $result = $result->fetch();
    return $result->created;
  }

  public function getInfo(){
    // Get the id of the last news item saved.
    $created = $this->lastCreated();
    
    // Fetch and parse the latest feed.
    $xml = simplexml_load_file("http://rss.cnn.com/rss/cnn_topstories.rss");

    // Only run the code if atleast 23 hours has passed since the last data pull.
    // The cron will run every 24 hours, but this safeguard will protect against
    // doing a data pull incase the cron is triggered early by some other means.
    // The past is small, the future is large.
    $yesterdayMinus1 = strtotime( '-23 hours');
    if(!$created || $created < $yesterdayMinus1) {
      // Filter out news items from the last 24 hours.
      $yesterday = strtotime( '-1 day');
      $data = $this->extractData($xml, $yesterday);
      
      $values = [
        'type' => 'news',
        'fetched_data' => $data,
        'source'=> "cnn"
      ];
      $node = \Drupal::entityTypeManager()->getStorage('fetched_info')->create($values);
      $node->save();
      echo "Got the news!";
    }
  }

}