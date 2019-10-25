<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage($language)
    {
        // dd($language);
        \Session::put('website_language', $language);
    // dd(\Session::get('website_language'));

        return redirect()->back();
    }
}
