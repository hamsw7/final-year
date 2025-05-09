<?php

use Illuminate\Support\Facades\Route;
use Webkul\Member\Http\Controllers\Admin\MemberController;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin/member'], function () {
    Route::controller(MemberController::class)->group(function () {
        Route::get('', 'index')->name('admin.member.index');
        Route::get('create', 'create')->name('admin.member.create');
        Route::post('store', 'store')->name('admin.member.store');
        Route::get('edit/{id}', 'edit')->name('admin.member.edit');
        Route::put('update/{id}', 'update')->name('admin.member.update');
        Route::delete('delete/{id}', 'destroy')->name('admin.member.delete');
        Route::get('send', 'indexs')->name('admin.member.send');
        Route::post('message', 'stores')->name('admin.member.message');
    });
});
