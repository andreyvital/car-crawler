#!/usr/bin/env php

<?php
require 'config/bootstrap.php';

const DB_NAME = 'test';
const DB_PSWD = '1234';

use \PDO;
use Crawler\WebMotors;
use Crawler\data\layer\storage\maria\MariaDBBrandDataAccess as BrandDataAccess;

try {
  $wb = new WebMotors();

  $instance = new BrandDataAccess(
    new PDO(
      'mysql:host=localhost;dbname='. DB_NAME, 
      'root', 
      DB_PSWD,
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      )
    )
  );


  foreach ($wb->getBrands() as $brand) {
    printf('Adicionando em %s' . PHP_EOL, $brand->getName());
    $instance->insert($brand);
  }

  echo 'Finished!';
} catch (Exception $e) {
  echo $e->getMessage(), PHP_EOL;
}