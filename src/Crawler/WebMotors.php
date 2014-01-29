<?php

namespace Crawler;

use Crawler\http\CURL;

use Crawler\BrandNotFoundException;
use Crawler\CarIndustryAggregator;

use Crawler\data\Brand;
use Crawler\data\Car;

use DOMDocument;
use DOMElement;
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
   * Carrega o documento para extração das informações
   * 
   * @return DOMDocument
   */
  private function getDocument()
  {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = true;
    
    $dom->loadHTMLFile(WebMotors::ENDPOINT);
    return $dom;
  }
  
  /**
   * Converte o nó para sua representação
   * 
   * @param DOMElement $node nó
   * @return Brand
   */
  private function node2brand(DOMElement $node)
  {
    return new Brand(
      $node->getAttribute('value'), 
      $node->nodeValue
    );
  }
  
  /**
   * Recupera todos os carros de uma determinada marca
   * 
   * @param Brand $brand marca
   * @return Brand
   */
  private function fetchCarsIntoBrand(Brand & $brand)
  {
    foreach ($this->getCars($brand) AS $vehicle) {
      $car = new Car($vehicle->Id, $vehicle->Nome);
      
      // adiciona o carro para a marca específicada
      $brand->addCar($car);
    }
    
    return $brand;
  }

  /**
   * Recupera todas as marcas
   * 
   * @return array
   */
  public function getBrands()
  {
    $brands = array();

    $xpath = new DOMXPath($this->getDocument());
    
    foreach ($xpath->query('//*[@id="IdMarca"]/option[number(@value) > 0]') as $node) {
      $brand = $this->node2brand($node);
      $this->fetchCarsIntoBrand($brand);
      $brands[] = $brand;
    }

    return $brands;
  }
  
  /**
   * @see CarIndustryAggregator::getBrand()
   * @param string $name nome da marca
   */
  public function getBrand($name)
  {
    $xpath = new DOMXPath($this->getDocument());
    $node = $xpath->query(sprintf('//*[@id="IdMarca"]/option[text() = "%s"]', strtoupper($name)));
    
    if ($node->length >= 1) {
      $brand = $this->node2brand($node->item(0));
      return $this->fetchCarsIntoBrand($brand);
    }
   
    $message = sprintf('Não existem informações para a marca %s', $name);
    throw new BrandNotFoundException($message);
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
