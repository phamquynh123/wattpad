<?php

namespace App\Repositories\Story;

interface StoryRepositoryInterface
{
    public function detailStory($attr, $value);

    public function getLimitStory($use_status);

    public function selectCustom($slug);

    public function getLimit();

    public function getVote($id);

    public function getStoryClient();
}
