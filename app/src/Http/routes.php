<?php

$prefix = 'admin';

Route::group([
    'middleware'    => ['auth', 'theme:admin', 'role:admin'],
    'prefix'        => $prefix,
    'as'            => $prefix.'.'
], function(){

    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::get('/dashboard', 'DashboardController@index');

    Route::post('posts/data', ['as' => 'posts.data', 'uses' => 'PostController@data']);
    Route::post('posts/{id}/comments', ['as' => 'posts.comments', 'uses' => 'PostController@comments']);
    Route::resource('posts', 'PostController');
    
    Route::post('pages/data', ['as' => 'pages.data', 'uses' => 'PageController@data']);
    Route::resource('pages', 'PageController');

    Route::post('categories/data', ['as' => 'categories.data', 'uses' => 'CategoryController@data']);
    Route::resource('categories', 'CategoryController');

    // Route::post('tags/data', ['as' => 'tags.data', 'uses' => 'TagController@data']);
    // Route::resource('tags', 'TagController');

    Route::get('comments/{id}/reply', ['as' => 'comments.reply', 'uses' => 'CommentController@reply']);
    Route::post('comments/{id}/reply', ['as' => 'comments.reply.submit', 'uses' => 'CommentController@replySumbit']);
    Route::post('comments/{id}/approved', ['as' => 'comments.approved', 'uses' => 'CommentController@approved']);
    Route::post('comments/data', ['as' => 'comments.data', 'uses' => 'CommentController@data']);
    Route::resource('comments', 'CommentController');

    Route::resource('media', 'MediaController');
    Route::post('media/items', ['as' => 'media.items', 'uses' => 'MediaController@items']);
    Route::get('media/{id}/img-edit', ['as' => 'media.imgedit', 'uses' => 'MediaController@imgEdit']);
    Route::delete('media/{id}', ['as' => 'media.delete', 'uses' => 'MediaController@destroy']);

    Route::post('users/data', ['as' => 'users.data', 'uses' => 'UserController@data']);
    Route::resource('users', 'UserController');

    Route::post('roles/data', ['as' => 'roles.data', 'uses' => 'RoleController@data']);
    Route::resource('roles', 'RoleController');

    Route::resource('settings', 'SettingController');
    Route::resource('themes', 'ThemeController');

});

Route::group(['prefix' => $prefix , 'as' => $prefix.'.', 'middleware' => 'theme:admin'], function(){
    Route::auth();
});

Route::post('getmedia', ['as' => 'media.getmedia', 'uses' => 'MediaController@getMedia']);
Route::get('media/{id}/detail', ['as' => 'media.detail', 'uses' => 'MediaController@mediaDetail']);
Route::post('media/upload', ['as' => 'media.upload', 'uses' => 'MediaController@upload']);
Route::get('image/{file}', ['as' => 'image', 'uses' => 'MediaController@getImage'])->where('file', '.*');
Route::get('img/theme/{name}', ['as' => 'theme.thumb', 'uses' => 'MediaController@themeThumb']);
