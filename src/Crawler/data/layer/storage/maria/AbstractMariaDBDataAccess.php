<?php

namespace Crawler\data\layer\storage\maria;

use Crawler\data\layer\storage\PDOTransactionManager;
use PDO;

abstract class AbstractMariaDBDataAccess
{

  /**
   * PHP Data Object
   * @var PDO
   */
  protected $dbh;

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  /**
   * Recupera o gerenciador de transação
   * @return TransactionManager
   */
  protected function getTransactionManager()
  {
    return new PDOTransactionManager($this->dbh);
  }

}
