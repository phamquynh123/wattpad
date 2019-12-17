<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function findByLanguage($parent_id, $id, $language, $id2);

    public function findMenuCategory($cate, $attr1, $parent_id, $attr2, $language, $attr3);
}
