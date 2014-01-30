<?php

namespace Crawler\data\layer\storage;

interface TransactionManager
{

  /**
   * Inicia uma transação
   * @return boolean
   */
  public function startTransaction();

  /**
   * Faz o commit da transação
   * @return boolean
   */
  public function commit();

  /**
   * Faz o rollback da transação
   * @return boolean
   */
  public function rollBack();
  
  /**
   * Determina se está em uma transação
   * @return boolean
   */
  public function inTransaction();

}
