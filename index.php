<?php

require 'config/bootstrap.php';

use Crawler\http\CURL;
use Crawler\dom\WebMotors;

$wb = new WebMotors(new \DomDocument());

$pdo = new \PDO('mysql:host=localhost;dbname=boaproposta', 'root', '');

try {
    foreach ($wb->getBrands() as $brand) {
        $id = $brand->getAttribute('value');
        $name = $brand->nodeValue;

        if (trim($name) != "") {
            $pdo->exec(sprintf('INSERT INTO `brands` (`id`, `name`) VALUES ("%s", "%s")', $id, $name));

            if ($id > 0) {
                foreach (json_decode($wb->getCars($id)) as $car) {
                    $model = $car->Nome;

                    $pdo->exec(sprintf('INSERT INTO `cars` (`name`, `brand_id`) VALUES ("%s", "%s")', $model, $id));
               }
            }
        }

    }
} catch (Exception $e) {
    echo $e->getMessage();
}