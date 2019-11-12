<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Category::class;
    }

    public function findByLanguage($parent_id, $id, $language, $id2)
    {
        $result = $this->_model->where($parent_id, $id)->where($language, $id2)->get();

        return $result;
    }

}
