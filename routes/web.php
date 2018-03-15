<?php

Route::get('/', 'PostsController@index')->name('home');

Auth::routes();

/** 用户的路由 */
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
Route::get('users/{user}/edit_avatar', 'UsersController@editAvatar')->name('users.edit_avatar');
Route::get('users/{user}/edit_password', 'UsersController@editPassword')->name('users.edit_password');
Route::get('users/{user}/follows', 'UsersController@follows')->name('users.follows');
Route::get('users/{user}/comments', 'UsersController@comments')->name('users.comments');

/** 博客路由，前台只提供列表和文章显示，所以暂时只配置这两个方法 */
Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);
Route::post('posts/{post}/follow', 'PostsController@follow')->name('posts.follow'); // 关注
Route::post('posts/{post}/unfollow', 'PostsController@unfollow')->name('posts.unfollow'); // 关注
Route::post('posts/{post}/comment', 'PostsController@comment')->name('posts.comment'); // 关注

/** 技能分类 */
Route::resource('skills', 'SkillsController', ['only' => ['show']]);

/** 消息通知 */
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

/** 搜索路由 */
Route::post('search/posts', 'SearchController@posts')->name('search.posts');
