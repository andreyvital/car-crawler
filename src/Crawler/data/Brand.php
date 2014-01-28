<?php

namespace Crawler\data;

class Brand extends AbstractEntity
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
