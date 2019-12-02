<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Story\StoryRepositoryInterface;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class StoryController extends Controller
{
    protected $Category;
    protected $Language;
    protected $Story;
    protected $chapter;
    public function __construct( 
        CategoryRepositoryInterface $Category,
        LanguageRepositoryInterface $Language,
        StoryRepositoryInterface $Story,
        ChapterRepositoryInterface $Chapter
    ) {
        $this->Category = $Category;
        $this->Language = $Language;
        $this->Story = $Story;
        $this->Chapter = $Chapter;

        $language = config('app.locale');
    }

    public function home()
    {
        $categories = $this->Category->getAll();

        return view('user.home', compact('categories'));
    }

    public function index()
    {
        return view('admin.story');
    }

    public function storyDatatable($language_id) {
        if(Auth::user()->role_id == config('Custom.roleAdmin')) {
            $stories = $this->Story->findCondition('language_id', $language_id);
            // dd($stories);
            return Datatables::of($stories)
            ->addColumn('action', function ($story) {
                if($story->parent_language_id == 0) {
                        return '<a href="#" class="btn btn-sm btn-warning story_detail btn-xs" data-id="' . $story->id . '" data-name="' . $story->slug . '" data-toggle="modal" data-target="#story-detail"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $story->id .'" class="btn btn-sm btn-info story-tran btn-xs" data-id="' . $story->id . '" data-name="' . $story->slug . '" data-toggle="modal" data-target="#story-trans" title="' . trans('action.trans') . '"><i class="fas fa-exchange-alt"></i></a> ';
                        // <a href="#" data-id="' . $story->id .'" class="btn btn-sm btn-info story-tran btn-xs" data-id="' . $story->id . '" data-name="' . $story->slug . '" data-toggle="modal" data-target="#story-trans" title="' . trans('action.trans') . '"><i class="fas fa-exchange-alt"></i></a>  // translate
                    }
            })
            ->editColumn('img', function($story) {
                if ($story->img == null) {
                    $image = asset('') . config('Custom.ImgDefaul');
                } else {
                    $image = asset(config('Custom.linkImgDefaul')) . $story->img;
                }

                return '<img class="img-avatar" src=" ' . $image . ' "/>';
            })
            ->editColumn('public_status', function($story) {
                if($story->public_status == config('Custom.statusPublic')) {
                    return trans('message.stories.public');
                } else {
                    return trans('message.stories.draft');
                }
            })
            ->rawColumns([ 
                'action', 'img', 'public_status'
            ])
            ->make(true);
        }
    }

    public function detail($id)
    {
        $story = $this->Story->find($id)->load('chapter', 'authors');
        // ->map(function($item) {
        //     dd($item);
        // });
        $numChapter = DB::table('chapters')->where('story_id', $id)->count();
        $story['numChapter'] = $numChapter;
        // dd($story);
        return $story;
    }
}
