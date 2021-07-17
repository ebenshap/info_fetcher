<?php

namespace Drupal\info_fetcher\Plugin\InfoFetcher;
use Drupal\Component\Plugin\Exception\PluginException;

use Drupal\info_fetcher\Plugin\InfoFetcherBase;

/**
 * 
 * @InfoFetcher(
 *   id = "weather",
 *   label = @Translation("Weather Info Grabber")
 * )
 */

class InfoFetcherWeather extends InfoFetcherBase {

  public function getInfo(){
    echo "Got the weather!";
  }

}