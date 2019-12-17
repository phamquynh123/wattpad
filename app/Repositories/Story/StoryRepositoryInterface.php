<?php

namespace App\Repositories\Story;

interface StoryRepositoryInterface
{
    public function detailStory($attr, $value);

    public function getLimitStory($use_status);
}
