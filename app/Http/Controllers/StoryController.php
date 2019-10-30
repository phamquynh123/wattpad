<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

class StoryController extends Controller
{
    protected $Category;

 // public function __construct(
 //        CategoryRepository $categoryRepository,
 //        FileRepository $fileRepository
 //    ) {
 //        $this->categoryRepository = $categoryRepository;
 //        $this->fileRepository = $fileRepository;
 //    }
    public function __construct( CategoryRepositoryInterface $Category)
    {
        $this->Category = $Category;
    }

    public function home()
    {
        $category = $this->Category->getAll();
        dd($category);
    }

    public function index()
    {
        dd('story');
    }
}
