<?php

namespace Crawler\data\layer\storage\maria;

use Crawler\data\Car;
use Crawler\data\Brand;

use Crawler\data\layer\storage\BrandDataAccess;
use Crawler\data\layer\storage\maria\AbstractMariaDBDataAccess;

use PDO;
use Exception;

class MariaDBBrandDataAccess extends AbstractMariaDBDataAccess implements BrandDataAccess
{
  
  /**
   * Armazena informações do veículo
   * 
   * @param Car $car veículo
   * @param integer $brand código da marca
   * @return boolean
   */
  private function storeCar(Car $car, $brand)
  {
    $stm = $this->dbh->prepare('INSERT INTO `cars`(`name`, `brand_id`) VALUES (:name, :brand);');
    $stm->bindValue(':name', $car->getName());
    $stm->bindValue(':brand', $brand, PDO::PARAM_INT);
    
    return $stm->execute();
  }

  /**
   * Grava as informaçoes da marca no banco de dados
   * 
   * @throws Exception se não for possível iniciar uma transação para guardar os veículos
   * @param Brand $brand marca
   * @return integer
   */
  public function insert(Brand $brand)
  {
    $manager = $this->getTransactionManager();
    
    if ($manager->inTransaction() == false) 
      $manager->startTransaction();

    $stmt = $this->dbh->prepare('INSERT INTO `brands`(`name`) VALUES (:name);');
    $stmt->bindValue(':name', $brand->getName());

    if ($stmt->execute()) {
      $id = $this->dbh->lastInsertId();

      foreach ($brand->getCars() AS $car) {
        try {
          // armazena as informações do veículo
          $this->storeCar($car, $id);

        } catch (Exception $e) {
          $manager->rollBack();
          throw $e;
        }
      }
      
      $manager->commit();
      return $id;
    }

    return 0;
  }

}
