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
   * Marca
   * @var Brand
   */
  private $brand;

  /**
   * Define o nome do veículo
   * 
   * @param string $name nome do carro
   * @param Brand $brand marca do veículo
   */
  public function __construct($name, Brand $brand)
  {
    $this->name = $name;
    $this->brand = $brand;
  }

  /**
   * Recupera o nome do automóvel
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Recupera a marca do automóvel
   * @return Brand
   */
  public function getBrand()
  {
    return $this->brand;
  }

}
