<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use Yajra\Datatables\Datatables;
use Session;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;

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
        // getLanguage();

    }

    public function index()
    {
        $language = config('app.locale');
        $languages = $this->Language->getAll();
        foreach ($languages as $value) {
            if ($value['acronym'] == $language){
                $language_id = $value['id']; 
            }
        }
        $parentCategories = $this->Category->findByLanguage('parent_id', config('Custom.categoryParentId'), 'language_id', $language_id);

        return view('admin.menu', compact(['languages', 'parentCategories']));
    }

    public function menuDatatable()
    {
        $categories = $this->Category->listMenu();
        foreach ($categories as $key => $value) {
            foreach ($categories as $key1 => $value1) {
                if ($value->parent_id != '1') {
                    if ($value->parent_id == $value1->id) {
                        $value->parent = $value1->title; // lấy ra title của category cha 
                    }
                } else {
                    $value->parent = 'null';
                }
                if ($value->id == $value1->parent_language_id){
                    $value['trans'] = '1'; // kiem tra bản ghi đã dc dịch hay chưa.
                }
            }
        }
        // dd($categories);

        return Datatables::of($categories)
            ->addColumn('action', function ($category) {
                if($category->parent_language_id == '0') {
                    if ($category->trans == true){
                        return '<a href="' . route('category.detail', $category->id) . '" class="btn btn-sm btn-warning category.detail btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $category->id .'" class="btn btn-sm btn-info category-tran btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '" data-parent-id="' . $category->parent_id . '" data-toggle="modal" data-target="#category-trans" title="' . trans('action.trans') . '"><i class="fas fa-exchange-alt"></i></a> <a href="#" class="btn btn-sm btn-success btn-xs" data-id="' . $category->id . '" title="' . trans('validation.exist') . '"><i class="fas fa-check-square"></i></a>';
                    } else {
                        return '<a href="' . route('category.detail', $category->id) . '" class="btn btn-sm btn-warning category.detail btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $category->id .'" class="btn btn-sm btn-info category-tran btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '" data-toggle="modal" data-target="#category-trans"><i class="fas fa-exchange-alt"></i></a>';
                    }
                    
                } else {
                    return '<a href="' . route('category.detail', $category->id) . '" class="btn btn-sm btn-warning add-student1 btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '"><i class="fa fa-eye"></i></a>';
                }
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    public function getDataTrans($id)
    {
        $languages = $this->Language->getAll();
        $translatedCategories = $this->Category->findCondition('parent_language_id', $id);

        foreach ($translatedCategories as $value) {
            foreach ($languages as $value1) {
                if($value['language_id'] == $value1['id']){
                    $value['language'] = $value1['name'];
                }
            }
        }
        return response()->json([ $translatedCategories ]);
    }

    public function trans(CategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        $reponse = $this->Category->create($data);

        return response()->json([ 'error' => false, 'success' => trans('action.success') ]);
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
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);

        $create = $this->Category->create($data);

        return response()->json([ 'error' => false, 'success' => trans('action.success') ]);
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
    // category
    public function listCategory()
    {
        $languages = $this->Language->getAll();

        return view('admin.category', ['languages' => $languages]);
    }

    public function categoryDatatable()
    {
        $categories = $this->Category->listCategory();

        return Datatables::of($categories)
            ->addColumn('action', function ($category) {
                return '<a href="' . route('category.detail', $category->id) . '" class="btn btn-sm btn-warning category-detail btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $category->id .'" class="btn btn-sm btn-info category-edit btn-xs" data-id="' . $category->id . '" data-name="' . $category->slug . '" data-toggle="modal" data-target="#category-edit"><i class="fa fa-edit"></i></a>';
            })
            ->editColumn('created_at', function ($item) {
                return Carbon::parse($item->created_at)->format('d-m-Y');
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    public function storeCategory(Request $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        $data['parent_id'] = 0;
        $data['cate'] = 1;
        $this->Category->create($data);

        return response()->json([ 'error' => false, 'success' => trans('action.success') ]);
    }

    public function editCategory($id)
    {
        $data = $this->Category->find($id);

        return response()->json([$data]);
    }

    public function updateCategory(Request $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        $this->Category->update($data['id'], $data);

        return response()->json([ 'error' => false, 'success' => trans('action.success') ]);
    }
}
