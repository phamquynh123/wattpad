<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Repositories\Permission\PermissionRepositoryInterface as PermissionRepo;

class PermissionController extends Controller
{
    protected $permissionrepo;

    public function __construct(
        PermissionRepo $permissionrepo
    ) {
        $this->permission = $permissionrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/permission');
    }

    public function datatable($language_id)
    {
        if(Auth::user()->role_id == config('Custom.roleAdmin')) {
            $data = $this->permission->getAll();
            return Datatable::of($data)
            ->addColumn('action', function ($story) {
                if($story->parent_language_id == 0) {
                        return '<a href="#" class="btn btn-sm btn-warning story_detail btn-xs" data-id="' . $story->id . '" data-name="' . $story->slug . '" data-toggle="modal" data-target="#story-detail"><i class="fa fa-eye"></i></a> <a href="#" data-id="' . $story->id .'" class="btn btn-sm btn-info story-tran btn-xs" data-id="' . $story->id . '" data-name="' . $story->slug . '" data-toggle="modal" data-target="#story-trans" title="' . trans('action.trans') . '"><i class="fas fa-exchange-alt"></i></a> ';
                        // <a href="#" data-id="' . $story->id .'" class="btn btn-sm btn-info story-tran btn-xs" data-id="' . $story->id . '" data-name="' . $story->slug . '" data-toggle="modal" data-target="#story-trans" title="' . trans('action.trans') . '"><i class="fas fa-exchange-alt"></i></a>  // translate
                    }
            })
            ->make(true);
        } else {
            // return 
        }
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
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
