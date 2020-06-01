<?php

namespace App\Repositories\Story;

use App\Models\Story;
use App\Repositories\Story\StoryRepositoryInterface;
use App\Repositories\BaseRepository;

class StoryRepository extends BaseRepository implements StoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Story::class;
    }

    public function detailStory($attr, $value)
    {
        $result = $this->_model::where($attr, $value)->first();

        return $result;
    }

    public function getLimitStory($use_status)
    {
        // dd(config('Custom.limitRecord'));
        return $this->_model::where('use_status', $use_status)->orderBy('id', 'DESC')->limit(config('Custom.limitRecord'))->get();
    }

    public function selectCustom($slug)
    {
        return $this->_model::where('slug', $slug)->select(['id', 'title', 'img', 'total_vote', 'view_count', 'public_status'])->first();
    }

    public function getLimit()
    {
        return $this->_model::select(['id', 'title', 'img', 'slug', 'use_status'])->orderBy('id', 'desc')->limit(config('Custom.limitRecord'))->get();
    }

    public function getVote($id)
    {
        return $this->_model::where('id', $id)->select(['id', 'total_vote'])->first();
        // return $this->_model::find($id)->select(['id', 'total_vote'])->first();
    }

    public function getStoryClient()
    {
        return $this->_model::orderBy('id', 'DESC');
    }

}
