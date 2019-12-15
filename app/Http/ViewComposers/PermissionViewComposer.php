<?php

namespace App\http\ViewComposers;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\View\View;


class PermissionViewComposer
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $getPermission = [];

    public function __construct(PermissionRepositoryInterface $Permission)
    {
        $this->getPermission = $Permission;
    }

    //this function get languge in precence
    public function compose(View $view)
    {
        $data = $this->getPermission->getAll();
        // dd($getlanguage[0]->id);
        $view->with('allPermission', $data);
    }
}