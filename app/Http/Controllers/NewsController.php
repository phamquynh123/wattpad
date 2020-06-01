<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\NewsRepositoryInterface;

class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository
    ) {
        $this->newsRepository = $newsRepository;
    }

    public function listNews()
    {
        return view('admin.news.blade.php');
    }
}
