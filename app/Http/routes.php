<?php

// Making resource controller for home page of the website and renaming the route from index to home.
Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => ['index'=>'home']
]);

Route::resource('portfolios', 'PortfolioController', [
    'parameters' => ['portfolios' => 'alias']
]);

Route::resource('articles', 'ArticlesController', [
    'parameters' => ['articles' => 'alias']
]);

Route::get('articles/cat/{cat_alias?}', ['uses'=>'ArticlesController@index', 'as'=>'blogCategory']);

Route::resource('comment','CommentController',['only'=>['store']]);


