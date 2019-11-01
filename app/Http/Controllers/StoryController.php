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
<<<<<<< HEAD
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
=======
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
>>>>>>> 030fbe1c24e310a24b61a38df81a7649c27e3f24
    }
}
