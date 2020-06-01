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
use App\Repositories\CategoryStory\CategoryStoryRepositoryInterface as CategoryStory;
use App\Repositories\Vote\VoteRepositoryInterface as Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoryRequest;
use App\Http\Requests\AddChapterRequest;
use App\Http\Requests\CommentRequest;

class StoryController extends Controller
{
    protected $Category;
    protected $Language;
    protected $Story;
    protected $Chapter;
    protected $Comment;
    protected $StoryAuthor;
    protected $CategoryStory;
    protected $Vote;

    public function __construct( 
        CategoryRepositoryInterface $Category,
        LanguageRepositoryInterface $Language,
        StoryRepositoryInterface $Story,
        ChapterRepositoryInterface $Chapter,
        CommentRepositoryInterface $Comment,
        StoryAuthor $StoryAuthor,
        CategoryStory $CategoryStory,
        Vote $Vote
    ) {
        $this->Category = $Category;
        $this->Language = $Language;
        $this->Story = $Story;
        $this->Chapter = $Chapter;
        $this->Comment = $Comment;
        $this->StoryAuthor = $StoryAuthor;
        $this->CategoryStory = $CategoryStory;
        $this->Vote = $Vote;

        $language = config('app.locale');
    }

    public function home()
    {
        $categories = $this->Category->getAll();
        $category_theloai = $this->Category->findByLanguage('parent_id', 0, 'language_id', 1);

        $story = $this->Story->getLimitStory(config('Custom.NormalStory'))->load([
            'authors' => function($item) {
                $item->select('name');
            }
        ]);

        $vip_story = $this->Story->getLimitStory(config('Custom.VipStory'))->load([
            'authors' => function($item) {
                $item->select('name');
            }
        ]);

        return view('user.home', compact(['categories', 'category_theloai', 'story', 'vip_story']));
    }

    public function index()
    {
        return view('admin.story');
    }

    public function storyDatatable($language_id) {
        if(Auth::user()->role_id == config('Custom.roleAdmin')) {
            $stories = $this->Story->findCondition('language_id', $language_id);

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
        $story = $this->Story->find($id)->load([
            // 'chapter' => function($query) {
            //     $query->get();
            // },
            'authors' => function($item) {
                $item->select('name', 'avatar', 'users.id');
            }
        ]);

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
        $selectCategory = $this->Category->findCondition('cate', 1);

        return view('admin.myStory', compact('selectCategory'));
    }

    public function manageMyStoryDatatable()
    {
        $user = Auth::user()->load('story')->toArray();
        $stories = $user['story'];

        return Datatables::of($stories)
            ->addColumn('action', function ($story) {
                if ($story['parent_language_id'] == 0) {
                    return '<a href="' . route('myStory.detailStory', $story['slug']) . '" class="btn btn-sm btn-warning my-story-detail btn-xs" data-id="' . $story['id'] . '" title="' . trans('action.detail') . '"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $story['id'] .'" class="btn bg-lime waves-effect story-fix btn-xs" data-id="' . $story['id'] . '" data-name="' . $story['slug'] . '" title="' . trans('action.edit') . '" data-toggle="modal" data-target="#story-edit" title="' . trans('action.trans') . '"><i class="material-icons">content_cut</i></a> <a href="#" data-id="' . $story['id'] .'" class="btn bg-cyan waves-effect story-add-chapter btn-xs" data-id="' . $story['id'] . '" data-name="' . $story['slug'] . '" title="' . trans('action.addChapter') . '" data-toggle="modal" data-target="#add-chapter" title="' . trans('action.trans') . '"><i class="material-icons">add</i></a>';
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
        if ($data['public_status'] == config('Custom.statusPublic')) {
            $data['public_status'] = config('Custom.statusDraft');
        } else $data['public_status'] = config('Custom.statusPublic');
        // dd($data);
        $response = $this->Story->update($id, $data);

        return response()->json([ 'error' => false, 'success' => trans('action.change.public_status') . trans('action.success') ]);
    }

    public function changUseStatus ($id)
    {
        if(Gate::allows('admin') || Gate::allows('vipAccount')) {

            $data = $this->Story->find($id)->toArray();
            if ($data['use_status'] == config('Custom.VipStory')) {
                $data['use_status'] = config('Custom.NormalStory');
            } else $data['use_status'] = config('Custom.VipStory');
            // dd($data);
            $response = $this->Story->update($id, $data);

            return response()->json([ 'errors' => false, 'success' => trans('action.change.use_status') . trans('action.success') ]);
        } else {
            return response()->json(['errors' => trans('validation.permissionDeny')]);
        }
    }

    public function addStory(StoryRequest $request)
    {
        $data = $request->all();

        $data['slug'] = str_slug($data['title']);
        if ($request->hasFile('file')) {
            $a = $request->file('file')->storeAs('public/story', 'image_' . time() . request()->file->getClientOriginalName());
            $path = 'image_' . time() . request()->file->getClientOriginalName();
            $image = $request->file('file');
            $data['img'] = $path;
        }
        $result = $this->Story->create($data);

        //create author-story
        $author_story['story_id'] = $result->id;
        $author_story['user_id'] = Auth::user()->id;
        $this->StoryAuthor->create($author_story);

        //create category-story
        $category_story['story_id'] = $result->id;
        foreach ($data['category_id'] as $value) {
            $category_story['category_id'] = $value;
            $category_story = $this->CategoryStory->create($category_story);
        }

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
            },
            'chapter' => function($item) {
                $item->take(5);
            }
        ]);

        $data['numChapter'] = $this->Chapter->countChapter('story_id', $data['id']);
        $data['numComment'] = $this->Comment->countComment('story_id', $data['id']);

        return view('admin/mystoryDetail', compact('data'));
        dd($data->toArray());
    }

    //public function edit review Story 
    public function editStory($id)
    {
        $data = $this->Story->find($id);
        if ($data['img'] != '') {
            $data['img'] = asset('/') . config('Custom.linkImgDefaul') . $data['img'];
        }

        return $data;
    }

    public function submitEdit(Request $request, $id) {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $a = $request->file('file')->storeAs('public/story', 'image_' . time() . request()->file->getClientOriginalName());
            $path = 'image_' . time() . request()->file->getClientOriginalName();
            $image = $request->file('file');
            $data['img'] = $path;
        }
         $result = $this->Story->update($id, $data);

        return response()->json(['error' => false, 'success' => trans('action.success')]);
    }

    public function addChapter(AddChapterRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        $data['story_id'] = $id;
        // dd($data);
        $result = $this->Chapter->create($data);

        return response()->json(['success' => trans('action.success')]);
    }

    //client View Story
    public function viewStory($slug)
    {
        $data = $this->Story->detailStory('slug', $slug)->load([
            'authors' => function($item) {
                return $item->select(['name', 'avatar']);
            },
            'comment.user'=> function($item){
                $item->take(5);
            },
            'comment'=> function($item){
                $item->take(5);
            },
            'chapter' => function($item) {
                $item->take(5);
            }
        ]);
        // dd($data->toArray());
        $data['numChapter'] = $this->Chapter->countChapter('story_id', $data['id']);
        $data['numComment'] = $this->Comment->countComment('story_id', $data['id']);

        // UPDATE VIEW_COUNT
        $update['view_count'] = $data['view_count'] + 1;
        $this->Story->update($data['id'], $update);

        //RECOMMENT STORY
        $recomment = $this->Story->getLimit();

        // SHOW VOTE
        if (Auth::check()) {
            $vote = $this->Vote->findCondition('user_id', Auth::user()->id)->toArray();
            if ($vote == null) {
                $data['vote'] = false;
            } else {
                $data['vote'] = true;
            }
        }
        return view('user/detailStory', compact(['data', 'recomment']));
        dd($data->toArray());
    }

    public function viewChapter($story_slug, $story_id, $chapter_slug)
    {
        $story = $this->Story->selectCustom($story_slug)->load([
            'chapter' => function($item) {
                return $item->take('10');
            },
            'comment.user'=> function($item){
                $item->take(5);
            },
        ]);
        $story['numChapter'] = $this->Chapter->countChapter('story_id', $story['id']);
        $story['numComment'] = $this->Comment->countComment('story_id', $story['id']);

        $chapter = $this->Chapter->findConditionClass('story_id', $story_id, 'slug', $chapter_slug)->first();
        $recommentStory = $this->Story->getLimit()->load([
            'authors' => function($item) {
                $item->select('name');
            }
        ]);

        return view('user.viewChapter', compact(['story', 'chapter', 'recommentStory']));
    }

    public function addComment(CommentRequest $request)
    {
        if (Auth::check()) {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $result = $this->Comment->create($data);
            $result['user'] = Auth::user();
            if($result['user']['avatar'] == ''){
                $result['user']['avatar'] = asset('') . config('Custom.imgDefaul');
            } else $result['user']['avatar'] = asset('') . config('Custom.linkImgDefaul') . $result['user']['avatar'];

            return response()->json(['success' => trans('action.success'), 'result' => $result]);
        } else {
            return response()->json(['success' => trans('message.loginToComment')]);
        }
        
    }

    public function vote($story_id)
    {
        $data = $this->Vote->findConditionClass('user_id', Auth::user()->id, 'story_id', $story_id)->toArray();
        $getvote = $this->Story->getVote($story_id)->toArray();
        // dd($getvote->toArray());
        if ($data == null) {
            $getvote['total_vote'] = $getvote['total_vote'] + 1;
            $insert_info['story_id'] = $story_id;
            $insert_info['user_id'] = Auth::user()->id;
            $vote_change = $this->Vote->create($insert_info);
            $this->Story->update($story_id, $getvote);

            return response()->json(['success' => trans('action.vote') . trans('action.success'), 'total_vote' => $getvote, 'status' => 'voted']);
        } else {
            $getvote['total_vote'] = $getvote['total_vote'] - 1;
            $vote_change = $this->Vote->delete($data[0]['id']);
            $this->Story->update($story_id, $getvote);

            return response()->json(['success' => trans('action.unvote') . trans('action.success'), 'total_vote' => $getvote, 'status' => 'unvote']);
        }
    }

    public function getStoryByCategory($slug)
    {
        $data = $this->Category->findCondition('slug', $slug)->load([
            'stories' => function($item) {
                return $item->paginate(10);
            }
        ])->toArray();
        $data = $data[0];
        return view('user.category', compact(['data']));
    }

    public function listStory()
    {
        $story = $this->Story->getStoryClient()->with([
            'authors' => function($item) {
                $item->select('name');
            }
        ])->paginate(config('Custom.list_story_client'));

        return view('user.list_story', ['data' => $story]);
    }
}
