<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('prueba', function(){
    return Inertia::render('admin/adminhome');
})->name('prueba');