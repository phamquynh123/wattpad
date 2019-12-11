<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Story\StoryRepositoryInterface;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface as User;
use App\Repositories\StoryAuthor\StoryAuthorRepositoryInterface as StoryAuthor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoryRequest;

class StoryController extends Controller
{
    protected $Category;
    protected $Language;
    protected $Story;
    protected $Chapter;
    protected $Comment;
    protected $StoryAuthor;

    public function __construct( 
        CategoryRepositoryInterface $Category,
        LanguageRepositoryInterface $Language,
        StoryRepositoryInterface $Story,
        ChapterRepositoryInterface $Chapter,
        CommentRepositoryInterface $Comment,
        StoryAuthor $StoryAuthor
    ) {
        $this->Category = $Category;
        $this->Language = $Language;
        $this->Story = $Story;
        $this->Chapter = $Chapter;
        $this->Comment = $Comment;
        $this->StoryAuthor = $StoryAuthor;

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
                if ($story['img'] == null) {
                    $image = asset('') . config('Custom.ImgDefaul');
                } else {
                    $image = asset(config('Custom.linkImgDefaul')) . '/' . $story['img'];
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
        if ($story->img == "") {
            $story->img = asset('') . config('Custom.ImgDefaul');
        } else {
            $story->img = asset('') . config('Custom.linkImgDefaul') . '/' .$story->img;
        }

        $story['numChapter'] = $this->Chapter->countChapter('story_id', $id);
        $story['numComment'] = $this->Comment->countComment('story_id', $id);

        return $story;
    }

    public function manageMyStory()
    {
        return view('admin.myStory');
    }

    public function manageMyStoryDatatable()
    {
        $user = Auth::user()->load('story')->toArray();
        $stories = $user['story'];
        // dd($stories);
        return Datatables::of($stories)
            ->addColumn('action', function ($story) {
                // dd($story);
                if ($story['parent_language_id'] == 0) {
                    return '<a href="' . route('myStory.detailStory', $story['slug']) . '" class="btn btn-sm btn-warning my-story-detail btn-xs" data-id="' . $story['id'] . '" title="' . trans('action.detail') . '"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $story['id'] .'" class="btn btn-sm btn-info story-tran btn-xs" data-id="' . $story['id'] . '" data-name="' . $story['slug'] . '" data-toggle="modal" data-target="#story-trans" title="' . trans('action.trans') . '"><i class="fas fa-exchange-alt"></i></a> <a href="#" data-id="' . $story['id'] .'" class="btn bg-lime waves-effect story-fix btn-xs" data-id="' . $story['id'] . '" data-name="' . $story['slug'] . '" title="' . trans('action.edit') . '" data-toggle="modal" data-target="#story-edit" title="' . trans('action.trans') . '"><i class="material-icons">content_cut</i></a>';
                    }
            })
            ->editColumn('img', function($story) {
                if ($story['img'] == null) {
                    $image = asset('') . config('Custom.ImgDefaul');
                } else {
                    $image = asset(config('Custom.linkImgDefaul')) . '/' . $story['img'];
                }

                return '<img class="img-avatar" src=" ' . $image . ' "/>';
            })
            ->editColumn('public_status', function($story) {
                if($story['public_status'] == config('Custom.statusPublic')) {
                    return '<select value="' . trans('message.stories.public') . '" class="btn bg-purple waves-effect public-status" data-id="' . $story['id'] . '"><option class="btn btn-default waves-effect">' . trans('message.stories.public') . '</option><option class="btn btn-default waves-effect">' . trans('message.stories.draft') . '</option></select>';
                //     return '<button type="button" class="btn bg-purple waves-effect public-status" data-id="' . $story['id'] . '">' . trans('message.stories.public') . '</button>';
                } else {
                     return '<select value="' . trans('message.stories.draft') . '" class="btn bg-purple waves-effect public-status" data-id="' . $story['id'] . '"><option class="btn btn-default waves-effect">' . trans('message.stories.draft') . '</option><option class="btn btn-default waves-effect">' . trans('message.stories.public') . '</option></select>';
                }
            })
            ->editColumn('use_status', function($story) {
                if($story['use_status'] == config('Custom.normalAcconut')) {
                    return '<button type="button" class="btn bg-indigo waves-effect use-status"   data-id="' . $story['id'] . '">' . trans('message.stories.Vip') . '</button>';
                } else {
                    return '<button type="button" class="btn bg-indigo waves-effect use-status" data-id="' . $story['id'] . '">' . trans('message.stories.Normal') . '</button>';
                }
            })
            ->rawColumns([ 
                'action', 'img', 'public_status', 'use_status'
            ])
            ->make(true);
    }

    public function changPublicStatus($id)
    {
        $data = $this->Story->find($id)->toArray();
        if($data['public_status'] == config('Custom.statusPublic')) {
            $data['public_status'] = config('Custom.statusDraft');
        } else $data['public_status'] = config('Custom.statusPublic');
        // dd($data);
        $response = $this->Story->update($id, $data);

        return response()->json([ 'error' => false, 'success' => trans('action.change.public_status') . trans('action.success') ]);
    }

    public function changUseStatus ($id)
    {
        $data = $this->Story->find($id)->toArray();
        if ($data['use_status'] == config('Custom.VipStory')) {
            $data['use_status'] = config('Custom.NormalStory');
        } else $data['use_status'] = config('Custom.VipStory');
        // dd($data);
        $response = $this->Story->update($id, $data);

        return response()->json([ 'error' => false, 'success' => trans('action.change.use_status') . trans('action.success') ]);
    }

    public function addStory(StoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        if ($request->hasFile('file')) {
            $a = $request->file('file')->storeAs('public/story', 'image_' . time() . request()->file->getClientOriginalName());
            // dd($a);
            $path = time() . request()->file->getClientOriginalName();
            $image = $request->file('file');
            $data['img'] = $path;
        }


        $result = $this->Story->create($data);

        $author_story['story_id'] = $result->id;
        $author_story['user_id'] = Auth::user()->id;

        $this->StoryAuthor->create($author_story);

        return response()->json(['error' => false, 'success' => trans('action.success')]);
    }

    // admin view show detail Story
    public function detailStory($slug)
    {
        $data = $this->Story->detailStory('slug', $slug)->load([
            'authors' => function($item) {
                return $item->select(['name', 'avatar']);
            },
            'comment.user'=> function($item){
                $item->take(5);
                // $item->select(['content']);
            }
        ]);

        $data['numChapter'] = $this->Chapter->countChapter('story_id', $data['id']);
        $data['numComment'] = $this->Comment->countComment('story_id', $data['id']);

        return view('admin/mystoryDetail', compact('data'));
        dd($data->toArray());
    }
}
