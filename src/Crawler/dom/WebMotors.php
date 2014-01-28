<?php

namespace Crawler\dom;

use Crawler\http\CURL;

class WebMotors
{

    private $document;
    private $xpath;
    private $url = 'http://www.webmotors.com.br';

    public function __construct()
    {
        $this->document = new \DomDocument();
        libxml_use_internal_errors(true);
        $this->document->loadHTMLFile($this->url);
        $this->xpath = new \DomXpath($this->document);
    }

    public function getBrands()
    {
        return $this->xpath->query('//*[@id="IdMarca"]/option');
    }

    public function getBrand($id)
    {
        return $this->xpath->query("//*[@id='IdMarca']/option[@value={$id}]")->item(0); 
    }

    public function getCars($brand)
    {
        $brand = $this->getBrand($brand)->getAttribute('value');
        $curl = new CURL('http://www.webmotors.com.br/carro/modelos');
        $curl->setMethod('POST');
        $curl->setFields(array('marca' => $brand));

        $response = $curl->getResponse();
        $curl->close();

        return $response;
    }

}