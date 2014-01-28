<?php

namespace Crawler\http;

class CURL
{

  private $channel;

  public function __construct($url)
  {
      $this->channel = curl_init($url);
      curl_setopt($this->channel, CURLOPT_RETURNTRANSFER, true);
  }

  public function setMethod($method)
  {
    if ($method == 'POST') {
        curl_setopt($this->channel, CURLOPT_POST, true);      
    } else {
        curl_setopt($this->channel, CURLOPT_HTTPGET, true);
    }
  }

  public function setFields($fields)
  {
      $fieldstring = '';
      foreach ($fields as $key => $value) {
          $fieldstring .= sprintf('%s=%s,', $key, $value);
      }

      curl_setopt($this->channel, CURLOPT_POSTFIELDS, rtrim($fieldstring, ','));
  }

  public function getResponse()
  {
      return curl_exec($this->channel);
  }

  public function close()
  {
    curl_close($this->channel);
  }

}