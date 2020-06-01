<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Repositories\Permission\PermissionRepositoryInterface as PermissionRepo;
use  App\Repositories\Role\RoleRepositoryInterface as RoleRepo;
use  App\Repositories\PermissionRole\PermissionRoleRepositoryInterface as PerRoleRepo;
use  App\Repositories\User\UserRepositoryInterface as UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\Datatables\Datatables;
use \App\Models\RoleUser as RoleUser;

class PermissionController extends Controller
{
    protected $permissionrepo;
    protected $rolerepo;
    protected $perrolerepo;
    protected $userrepo;

    public function __construct(
        PermissionRepo $permissionrepo,
        RoleRepo $rolerepo,
        PerRoleRepo $perrolerepo,
        UserRepo $userrepo
    ) {
        $this->permission = $permissionrepo;
        $this->role = $rolerepo;
        $this->perrolerepo = $perrolerepo;
        $this->userrepo = $userrepo;
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
            $dataes = $this->permission->getAll();
            // dd($data);
            return Datatables::of($dataes)
            ->addColumn('action', function ($data) {
                return ' <a href="#" data-id="' . $data['id'] .'" class="btn bg-lime waves-effect data-fix btn-xs permission-edit" data-id="' . $data['id'] . '" title="' . trans('action.edit') . '" data-toggle="modal" data-target="#permission-edit" title="' . trans('action.trans') . '"><i class="material-icons">content_cut</i></a> ';
            })
            ->rawColumns([
                'action',
            ])
            ->make(true);
        }
    }

    public function datatableRole($language_id)
    {
        if(Auth::user()->role_id == config('Custom.roleAdmin')) {
            $dataes = $this->role->getAll();
            // dd($data);
            return Datatables::of($dataes)
            ->addColumn('action', function ($data) {
                return '<a href="#" data-id="' . $data['id'] .'" class="btn bg-lime waves-effect data-fix btn-xs role-edit" data-id="' . $data['id'] . '" data-name="' . $data['slug'] . '" title="' . trans('action.edit') . '" data-toggle="modal" data-target="#role-edit" title="' . trans('action.trans') . '"><i class="material-icons">content_cut</i></a> ';

            })
            ->rawColumns([
                'action',
            ])
            ->make(true);
        }
    }

    public function datatablePermissionRole($lang_id)
    {
        $dataa = $this->role->getAll()->load('permission')->toArray();
        return Datatables::of($dataa)
            ->addColumn('action', function ($data) {
                return '<a href="#" data-id="' . $data['id'] .'" class="btn bg-lime waves-effect data-fix btn-xs permission-role-edit" data-id="' . $data['id'] . '" data-name="" title="' . trans('action.edit') . '" data-toggle="modal" data-target="#permissionrole-edit" title="' . trans('action.trans') . '"><i class="material-icons">content_cut</i></a> ';

            })
            ->editColumn('permission', function($data) {
                $val = '';
                if($data['permission'] == 'null'){
                    $val = $val . '';
                }else {
                    foreach ($data['permission'] as $value) {
                        $val = $value['display_name'] . ',' . $val;
                    }
                }

                $val = rtrim($val, ',');
                return $val;
            })
            ->rawColumns([
                'action', 'permission'
            ])
            ->make(true);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if ($data['type'] == 'permission') {
            $response = $this->permission->create($data);

            return response()->json(['success' => trans('action.success') ]); 
        } else if ($data['type'] == 'role') {
            $this->role->create($data);

            return response()->json(['success' => trans('action.success') ]); 
        } else {
            return response()->json(['error' => trans('acction.error')]); 
        }
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
// <a href="#" data-id="' . $data['id'] .'" class="btn bg-lime waves-effect data-fix btn-xs permission-role-edit" data-id="' . $data['id'] . '" data-name="" title="' . trans('action.edit') . '" data-toggle="modal" data-target="#permissionrole-edit" title="' . trans('action.trans') . '"><i class="material-icons">content_cut</i></a>
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->permission->find($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $this->permission->update($data['id'], $data);

        return response()->json(['success' => trans('action.success') ]); 
    }

    public function roleEdit($id)
    {
        $data = $this->role->find($id);

        return $data;
    }

    public function roleUpdate(Request $request)
    {
        $data = $request->all();
        $this->role->update($data['id'], $data);

        return response()->json(['success' => trans('action.success') ]); 
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

    public function permissionRoleEdit($role_id)
    {
        $permissiones = $this->permission->getAll();
        $roles = $this->role->find($role_id)->load(['permission'])->toArray();
        //  => function($item) {
        //     return $item->select(['display_name', 'name', 'id']);
        // }])->toArray();
        foreach ($permissiones as$key1 => $permission) {
            foreach ($roles['permission'] as $key => $value) {
                if($value['name'] == $permission['name'])
                {
                    unset($permissiones[$key1]);
                }
            }
        }
        $roles['permissionToAdd'] = $permissiones;

        return $roles;
    }

    public function permissionRoleUpdatee(Request $request) {
        $data = $request->all();
        $this->perrolerepo->create($data);

        return response()->json(['success' => trans('message.success')]);
    }

    public function addVip()
    {
        return view('admin.addVip');
    }

    public function addVipDatatable()
    {
        if (Gate::allows('vipAccount')) {
            $useres = $this->userrepo->getUser()->load('role')->toArray();
            return Datatables::of($useres)
            ->addColumn('action', function ($user) {
                $user_id = $user['id'];

                return view('admin.returnFile.selectRole', compact('user_id'));
            })
            ->editColumn('avatar', function($user) {
                if ($user['avatar'] == null) {
                    $img = asset('/') . config('Custom.ImgDefaul');
                } else {
                    $img = asset('/') . $user['avatar'];
                }

                return '<img src=' . $img .' style="width:80px"/>';
            })
            ->editColumn('role', function($user) {
                return $user['role']['display_name'];
            })
            ->rawColumns([
                'action', 'avatar', 'role',
            ])
            ->make(true);
        }
    }

    public function changeRole(Request $request)
    {
        $data = $request->all();
        $response = $this->userrepo->update($data['id'], $data);

        return response()->json(['success' => trans('message.success')]);
    }
}
