<?php

namespace Crawler;

use Exception;

class BrandNotFoundException extends Exception
{

  /**
   * @param string $message mensagem
   * @param integer $code código (opcional)
   */
  public function __construct($message, $code = 0)
  {
    parent::__construct($message, $code);
  }

}
