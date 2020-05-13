<?php

Route::group(['prefix' => config('knowledge-base.routes_prefix')], function () {

    // Web related routes
    Route::group(['prefix' => 'view'], function () {
        Route::get('/categories', 'FrontendController@categories')->name('kb.view-categories');
        Route::get('/articles', 'FrontendController@articles')->name('kb.view-articles');
        Route::get('/article/create', 'FrontendController@createArticle')->name('kb.create-article');
        Route::get('/article/edit/{slug}', 'FrontendController@editArticle')->name('kb.edit-article');
        Route::get('/article/view/{slug}', 'FrontendController@viewArticle')->name('kb.view-article');
    });

    // Api related routes
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/all', 'CategoryController@getAll')->name('categories.get-all');
        Route::get('/paginate', 'CategoryController@paginate')->name('categories.paginate');
        Route::get('/{category}', 'CategoryController@get')->name('categories.get');
        Route::put('/{category}', 'CategoryController@update')->name('category.update');
        Route::put('/{category}/copy', 'CategoryController@copy')->name('category.copy');
        Route::post('/create', 'CategoryController@create')->name('category.create');
        Route::delete('/{category}', 'CategoryController@delete')->name('category.delete');
    });

    Route::group(['prefix' => 'field'], function () {
        Route::get('/{field}', 'FieldController@get')->name('field.get');
        Route::delete('/{field}', 'FieldController@delete')->name('field.delete');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::put('/field/{field}', 'FieldController@update')->name('field.update');
        Route::post('/{category}/field', 'FieldController@create')->name('field.create');
    });

    Route::group(['prefix' => 'articles'], function () {
        Route::get('/all', 'ArticleController@getAll')->name('articles.get-all');
        Route::get('/paginate', 'ArticleController@paginate')->name('articles.paginate');
        Route::post('/create', 'ArticleController@create')->name('article.create');
        Route::put('/{article}', 'ArticleController@update')->name('articles.update');
        Route::get('/{article}', 'ArticleController@get')->name('article.get');
        Route::delete('/{article}', 'ArticleController@delete')->name('article.delete');
    });

    Route::group(['prefix' => 'files'], function () {
        Route::post('/upload-file', 'ArticleController@uploadFile')->name('article.upload-file');
    });
});


