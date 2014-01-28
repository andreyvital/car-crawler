<?php

namespace Crawler;

use Crawler\data\AbstractEntity;
use Crawler\data\Car;

use IteratorAggregate;
use ArrayIterator;
use Countable;

abstract class CarIndustry extends AbstractEntity implements IteratorAggregate, Countable
{

  /**
   * Matriz de veículos
   * @var array
   */
  private $cars;

  /**
   * Recupera todos os carros
   * @return Car
   */
  public function getCars()
  {
    return $this->cars;
  }

  /**
   * Adiciona um carro
   * @return Car
   */
  public function addCar(Car $car)
  {
    $this->cars[] = $car;
  }

  /**
   * Recupera um iterator para todos os carros
   * @return ArrayIterator
   */
  public function getIterator()
  {
    return new ArrayIterator($this->cars);
  }

  /**
   * Recupera a quantidade de carros adicionados
   * @return integer
   */
  public function count()
  {
    return count($this->cars);
  }

}
