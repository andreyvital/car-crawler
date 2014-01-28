<?php

namespace Crawler\data\layer\storage;

use Crawler\data\Brand;

interface BrandDataAccess
{

  /**
   * Armazena as informações da marca
   * 
   * @param Brand $brand marca que será armazenada
   * @return integer
   */
  public function insert(Brand $brand);

}
