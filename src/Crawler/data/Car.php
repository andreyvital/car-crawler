<?php

namespace Crawler\data;

class Car extends AbstractEntity
{

  /**
   * Nome do automóvel (carro)
   * @var string
   */
  private $name;
  
  /**
   * Define o nome do veículo
   * 
   * @param string $name nome do carro
   * @param Brand $brand marca do veículo
   */
  public function __construct($id, $name)
  {
    $this->name = $name;
    $this->setId($id);
  }

  /**
   * Recupera o nome do automóvel
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

}
