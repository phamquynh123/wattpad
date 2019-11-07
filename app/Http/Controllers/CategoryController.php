<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use Yajra\Datatables\Datatables;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $Category;
    protected $Langage;

    public function __construct( 
        CategoryRepositoryInterface $Category,
        LanguageRepositoryInterface $Language
    ){
        $this->Category = $Category;
        $this->Language = $Language;
    }

    public function index()
    {
        $languages = $this->Language->getAll();
        // dd($languages);

        return view('admin.category', compact('languages'));
    }

    public function categoryDatatable()
    {
        $categories = $this->Category->getAll();
        foreach($categories as $key => $value) {
            foreach($categories as $key1 => $value1) {
                if($value->parent_id != '1') {
                    if($value->parent_id == $value1->id) {
                        $value->parent = $value1->title;
                    }
                } else {
                    $value->parent = 'null';
                }
            }
        }

        return Datatables::of($categories)
            ->addColumn('action', function ($category) {
                if($category->parent_language_id != 0) {
                    return '<a href="' . route('category.detail', $category->id) . '" class="btn btn-sm btn-warning category.detail btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $category->id .'" class="btn btn-sm btn-info category-trans btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '" data-toggle="modal" data-target="#category-trans"><i class="fas fa-exchange-alt"></i></a>';
                } else {
                    return '<a href="' . route('category.detail', $category->id) . '" class="btn btn-sm btn-warning add-student1 btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '"><i class="fa fa-eye"></i></a>';
                }
            })
            ->rawColumns([ 
                'action',
            ])
            ->toJson();
    }

    public function trans($id)
    {
        

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
