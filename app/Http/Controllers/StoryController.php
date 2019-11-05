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
        $categories = $this->Category->getAll();
            // dd($cate)
        return view('user.home', compact('categories'));
    }

    public function index()
    {
        dd('story');
    }

    public function getCategory(Request $request)
    {
        dd($request->all());
    }
}
