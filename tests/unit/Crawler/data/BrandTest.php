<?php

namespace Crawler\data;

use PHPUnit_Framework_TestCase;

class BrandTest extends PHPUnit_Framework_TestCase
{

  /**
   * @test
   * @testdox É possível instânciar fornecendo argumentos válidos
   */
  public function testInstantiationWithValidArgumentsShouldWork()
  {
    $brand = new Brand($id = 10, $name = 'Toyota');

    $this->assertAttributeEquals($id, 'id', $brand);
    $this->assertAttributeEquals($name, 'name', $brand);

    return $brand;
  }

  /**
   * @test
   * @testdox É possível recuperar o id definido
   * @depends testInstantiationWithValidArgumentsShouldWork
   */
  public function testGetIdShouldReturnTheDefinedId(Brand $brand)
  {
    $this->assertSame(10, $brand->getId());
  }

  /**
   * @test
   * @testdox É possível recuperar o nome da marca
   * @depends testInstantiationWithValidArgumentsShouldWork
   */
  public function testGetNameShouldReturnTheDefinedBrandName(Brand $brand)
  {
    $this->assertEquals('Toyota', $brand->getName());
  }

}
