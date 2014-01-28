<?php

namespace Crawler\data;

use PHPUnit_Framework_TestCase;

class CarTest extends PHPUnit_Framework_TestCase
{
  
  /**
   * @test
   * @testdox É possível instânciar
   */
  public function testInstantiationWithValidArgumentsShouldWork()
  {
    $car = new Car($id = 2200, $name = 'CRV');

    $this->assertAttributeEquals($id, 'id', $car);
    $this->assertAttributeEquals($name, 'name', $car);

    return $car;
  }

  /**
   * @test
   * @testdox É possível recuperar o identificador do veículo
   * @depends testInstantiationWithValidArgumentsShouldWork
   */
  public function testGetIdShouldReturnTheDefinedId(Car $car)
  {
    $this->assertSame(2200, $car->getId());
  }

  /**
   * @test
   * @testdox É possível recuperar o nome do veículo
   * @depends testInstantiationWithValidArgumentsShouldWork
   */
  public function testGetNameShouldReturnTheDefinedBrandName(Car $car)
  {
    $this->assertEquals('CRV', $car->getName());
  }
  
}
