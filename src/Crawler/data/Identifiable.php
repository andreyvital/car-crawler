<?php

namespace Crawler\data;

interface Identifiable
{

  /**
   * Recupera o identificador definido
   * 
   * @return mixed
   */
  public function getId();

  /**
   * Define o identificador
   * 
   * @param mixed $id identificador
   * @return Identifiable
   */
  public function setId($id);

}
