<?php

// Making resource controller for home page of the website and renaming the route from index to home.
Route::resource('/', 'IndexController', ['only' => ['index'], 'names' => ['index'=>'home']]);




