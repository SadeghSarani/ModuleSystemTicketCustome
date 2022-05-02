<?php

namespace supportSystem\Repositories;

include_once __DIR__ . '/../Model/ProductGroup.php';

use supportSystem\Model\ProductGroup;

class ProductGroupRepository
{
    private ProductGroup $model;

    public function __construct()
    {
        $this->model = new ProductGroup();
    }

    public function getProductAll()
    {
        return $this->model->all();
    }
}