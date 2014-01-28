<?php

namespace Crawler;

interface CarIndustryAggregator
{

  /**
   * Recupera todas as marcas de fabricantes de automóveis
   * @return CarIndustry
   */
  public function getBrands();

}
