<?php

Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Acr\Acr_blog\Controllers', 'prefix' => 'acr/blog'], function () {
        Route::get('/', 'BlogController@blog_galery');
        Route::get('/oku', 'BlogController@blog_oku');
        Route::group(['middleware' => ['auth']], function () {
            Route::group(['middleware' => ['admin']], function () {
                Route::post('/sira/update', 'BlogController@sira_update');
                Route::get('/file/select', 'BlogController@file_select');
                Route::post('/file/search', 'BlogController@file_search');
                Route::post('/file/add', 'BlogController@file_add');
                Route::post('/file/delete', 'BlogController@file_delete');
                Route::get('/list', 'BlogController@blog');
                Route::get('/yeni', 'BlogController@yeni');
                Route::post('/create', 'BlogController@create');
                Route::post('/delete', 'BlogController@delete');
                Route::post('/file/delete', 'BlogController@file_delete');
            });
        });
    });
});