<?php

namespace Crawler\data;

use Crawler\data\Identifiable;

abstract class AbstractEntity implements Identifiable
{

  /**
   * Identificador
   *
   * @var mixed
   */
  protected $id;

  /**
   * @see Identifiable::getId()
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @see Identifiable::setId()
   * @param mixed $id identificador
   */
  public function setId($id)
  {
    $this->id = $id;
  }

}
