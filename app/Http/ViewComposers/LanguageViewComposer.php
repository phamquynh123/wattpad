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
        $this->getLanguage = $Language->getAll();
    }

    //this function get languge in precence
    public function compose(View $view)
    {
        $locale = config('app.locale');
        $languages = $this->getLanguage;
        $language = [];
        foreach ($languages as $value) {
            if ($value['acronym'] == $locale){
                $language['id'] = $value['id']; 
                $language['name'] = $value['name'];
            }
        }
        $view->with('nowLanguage', $language);
    }
}