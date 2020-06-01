<?php 

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\NewsRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\News;
use Config;
use Carbon\Carbon;
use DB;

class NewsRepository extends EloquentRepository implements NewsRepositoryInterface
{
	/**
     * get model
     * @return string
     */
    public function getModel()
    {
        return News::class;
    }
}

?>