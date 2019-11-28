<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Language\LanguageRepositoryInterface as LanguageRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public funtion getLanguage()
    // {
    //     $locale = config('app.locale');
    //     $getlanguage = LanguageRepository->find('acronym', $locale);

    //     return $getlanguage;
    // }
}
