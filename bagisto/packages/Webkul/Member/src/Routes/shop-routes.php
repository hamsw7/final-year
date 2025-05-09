<?php

use Illuminate\Support\Facades\Route;
use Webkul\Member\Http\Controllers\Shop\MemberController;

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency'], 'prefix' => 'member'], function () {
    Route::get('', [MemberController::class, 'index'])->name('shop.member.index');
});