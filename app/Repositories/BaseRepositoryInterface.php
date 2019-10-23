<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function findCondition($attr, $id);

    public function findConditionClass($attr, $id, $attr2, $id2);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

}