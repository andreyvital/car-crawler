<?php

namespace Crawler\data;

use Crawler\CarIndustry;

class Brand extends CarIndustry
{

  /**
   * Nome da marca
   * @var string
   */
  private $name;

  public function __construct($id, $name)
  {
    $this->setId($id);
    $this->name = $name;
  }

  /**
   * Recupera o nome da marca
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

}
