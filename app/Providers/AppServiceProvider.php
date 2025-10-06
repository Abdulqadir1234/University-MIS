<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
  

public function boot()
{
    App::setLocale(Session::get('locale', config('app.locale')));
}

}
