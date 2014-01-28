<?php

require 'config/bootstrap.php';

use Crawler\WebMotors;

$wb = new WebMotors();

var_dump($wb->getBrand('Ford'));
