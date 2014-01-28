<?php

namespace Crawler\data\layer\storage;

use PDO;

class PDOTransactionManager implements TransactionManager
{

  /**
   * PHP Data Object
   * @var PDO
   */
  private $dbh;

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  /**
   * @see TransactionManager::commit()
   * @return boolean
   */
  public function commit()
  {
    return $this->dbh->commit();
  }

  /**
   * @see TransactionManager::rollBack()
   * @return boolean
   */
  public function rollBack()
  {
    return $this->dbh->rollBack();
  }

  /**
   * @see TransactionManager::startTransaction()
   * @return boolean
   */
  public function startTransaction()
  {
    return $this->dbh->beginTransaction();
  }

}
