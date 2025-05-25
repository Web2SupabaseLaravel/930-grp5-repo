<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    //...

public function boot()
{
    \Illuminate\Support\Facades\Route::model('dataQuiz', \App\Models\Quizzes::class);
}

}
