<?php

namespace App\http\ViewComposers;

// use Illuminate\Support\Facades\View;
use App\Repositories\Language\LanguageRepositoryInterface;
use Illuminate\View\View;
// use View;

class LanguageViewComposer
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $getLanguage = [];

    public function __construct(LanguageRepositoryInterface $Language)
    {
        $this->getLanguage = $Language;
    }

    //this function get languge in precence
    public function compose(View $view)
    {
        $locale = config('app.locale');
        $getlanguage = $this->getLanguage->findCondition('acronym', $locale);

        $view->with('nowLanguage', $getlanguage);
    }
}