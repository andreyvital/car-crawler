<?php

namespace Crawler;

use Crawler\CarIndustryAggregator;
use Crawler\http\CURL;
use Crawler\data\Brand;
use Crawler\data\Car;
use DOMDocument;
use DOMXPath;

class WebMotors implements CarIndustryAggregator
{

  /**
   * Endpoint que será usado para extraír a informação
   * @const string
   */
  const ENDPOINT = 'http://www.webmotors.com.br';

  public function __construct()
  {
    libxml_use_internal_errors(true);
  }

  /**
   * Recupera todas as marcas
   * 
   * @return array
   */
  public function getBrands()
  {
    // ---------------------------------------
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = true;

    $dom->loadHTMLFile(WebMotors::ENDPOINT);
    $xpath = new DOMXPath($dom);
    // ---------------------------------------

    $brands = array();

    foreach ($xpath->query('//*[@id="IdMarca"]/option[number(@value) > 0]') as $node) {
      $brand = new Brand(
        $node->getAttribute('value'), 
        $node->nodeValue
      );


      foreach ($this->getCars($brand) AS $vehicle) {
        $car = new Car($vehicle->Nome, $brand);
        $car->setId($vehicle->Id);

        $brand->addCar($car);
      }
    }

    return $brands;
  }

  /**
   * Recupera todos os carros de uma determinada marca
   * 
   * @param Brand $brand marca
   * @return array
   */
  private function getCars(Brand $brand)
  {
    $curl = new CURL('http://www.webmotors.com.br/carro/modelos');
    $curl->setMethod('POST');
    $curl->setFields(array('marca' => $brand->getId()));

    $response = json_decode($curl->getResponse());
    $curl->close();

    return $response;
  }

}
