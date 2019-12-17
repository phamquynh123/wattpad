<?php

namespace App\http\ViewComposers;

use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\View\View;


class RoleViewComposer
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $getRole = [];

    public function __construct(RoleRepositoryInterface $Role)
    {
        $this->getRole = $Role;
    }

    //this function get languge in precence
    public function compose(View $view)
    {
        $data = $this->getRole->getAll();
        // dd($getlanguage[0]->id);
        $view->with('allRole', $data);
    }
}

