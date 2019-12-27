<?php

namespace App\http\ViewComposers;

// use Illuminate\Support\Facades\View;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\View\View;
// use View;

class CategoryViewComposer
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $getCategory = [];
    protected $Category;

    public function __construct(CategoryRepositoryInterface $Category)
    {
        $this->Category = $Category;
        $this->getCategory = $Category->getAll();
    }

    public function compose(View $view)
    {
        $selectCategory = $this->Category->findCondition('cate', 1);
        // dd($selectCategory);
        $view->with('getCategories', $this->getCategory);
        $view->with('selectCategory', $selectCategory);
    }
}