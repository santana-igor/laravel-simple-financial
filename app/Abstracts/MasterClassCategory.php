<?php

namespace App\Abstracts;

use App\Models\Category;

abstract class MasterClassCategory
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    abstract public function store($data);
    abstract public function update();
    abstract public function destroy();
}
