<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function findByLanguage($parent_id, $id, $language, $id2);
}
