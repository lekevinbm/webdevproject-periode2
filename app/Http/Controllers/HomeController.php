<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Redirect;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function setLanguage (Request $request, $locale) {
        App::setLocale($locale);
        $request->session()->put('locale',$locale);
        return Redirect::back();
    }
}
