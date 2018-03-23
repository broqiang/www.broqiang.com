<?php

Route::get('', 'HomesController@index')->name('admins.index');

// 博客后台
Route::resource('posts', 'PostsController', [
    'names'  => 'admins.posts',
    'except' => ['show'],
]);

// 技能分类管理
Route::resource('skills', 'SkillsController', ['names' => 'admins.skills']);

// 评论管理
Route::resource('comments', 'CommentsController', [
    'names'  => 'admins.comments',
    'except' => ['show', 'create', 'store'],
]);

Route::resource('users', 'UsersController', [
    'names'  => 'admins.users',
    'except' => ['show', 'create', 'store'],
]);

/** 教程分类 */
Route::resource('categories', 'CategoriesController', [
    'names' => 'admins.categories',
]);

/** 教程 */
Route::resource('tutorials', 'TutorialsController', [
    'names' => 'admins.tutorials',
]);
// 上传封面
Route::post('tutorials/{tutorial}/upload', 'TutorialsController@upload')->name('admins.tutorials.upload');

// 创建文章
Route::resource('tutorials/{tutorial}/articles', 'ArticlesController', [
    'names' => 'admins.articles',
]);
// 编辑文章标题
Route::get('tutorials/{tutorial}/articles/{article}/edit_title', 'ArticlesController@edit_title')->name('admins.articles.edit_title');
