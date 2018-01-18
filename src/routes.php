<?php

Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Acr\Acr_blog\Controllers', 'prefix' => 'acr/blog'], function () {
        Route::get('/get_file/{acr_file_id}/{file_name}/{loc}', 'FlController@get_file');
        Route::group(['middleware' => ['auth']], function () {
            Route::group(['middleware' => ['admin']], function () {
                Route::get('/', 'BlogController@blog');
                Route::get('/yeni', 'BlogController@yeni');
                Route::get('/oku', 'BlogController@blog_oku');
                Route::post('/create', 'BlogController@create');
                Route::post('/delete', 'BlogController@delete');
                Route::post('/file/delete', 'BlogController@file_delete');
            });
        });
    });
});