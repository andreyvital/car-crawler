<?php

namespace Crawler;

interface CarIndustryAggregator
{

  /**
   * Recupera todas as marcas de fabricantes de automóveis
   * @return CarIndustry
   */
  public function getBrands();

  /**
   * Recupera a marca pelo nome
   * 
   * @throws BrandNotFoundException se não encontrar informações para uma determinada marca
   * @param string $name nome da marca
   * @return Brand
   */
  public function getBrand($name);

}
