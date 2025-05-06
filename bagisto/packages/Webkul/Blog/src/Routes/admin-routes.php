<?php

use Illuminate\Support\Facades\Route;
use Webkul\Blog\Http\Controllers\Admin\BlogController;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin/blog'], function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('', 'index')->name('admin.blog.index');
        Route::get('create', 'create')->name('admin.blog.create');
        Route::post('', 'store')->name('admin.blog.store');
        Route::get('{id}/edit', 'edit')->name('admin.blog.edit');
        Route::put('{id}', 'update')->name('admin.blog.update');
        Route::delete('{id}', 'destroy')->name('admin.blog.destroy');
    });
});
