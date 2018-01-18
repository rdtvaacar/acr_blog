<?php

Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Acr\Acr_blog\Controllers', 'prefix' => 'acr/blog'], function () {
        Route::get('/', 'BlogController@blog_galery');
        Route::get('/oku', 'BlogController@blog_oku');
        Route::group(['middleware' => ['auth']], function () {
            Route::group(['middleware' => ['admin']], function () {
                Route::get('/list', 'BlogController@blog');
                Route::get('/yeni', 'BlogController@yeni');
                Route::post('/create', 'BlogController@create');
                Route::post('/delete', 'BlogController@delete');
                Route::post('/file/delete', 'BlogController@file_delete');
            });
        });
    });
});