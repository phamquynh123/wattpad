<?php

namespace App\Repositories\Language;

use App\Models\Language;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\BaseRepository;

class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Language::class;
    }

}
