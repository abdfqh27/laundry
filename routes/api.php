<?php

use Illuminate\Support\Facades\Route;
use App\Models\LaundryService;

Route::get('/services', function () {
    return LaundryService::where('is_active', true)->get();
});