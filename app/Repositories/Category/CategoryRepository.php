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

    public function findMenuCategory($cate, $attr1, $parent_id, $attr2, $language, $attr3)
    {
        $result = $this->_model->where($cate, $attr1)->where($parent_id, $attr2)->where($language, $attr3)->get();
    }

    public function listMenu()
    {
        return Category::where('cate', '!=', '1')->get();
    }

    public function listCategory()
    {
        return Category::where('cate', '1')->get();
    }

}
