<?php 

Route::get('','HomesController@index')->name('admins.index');

// 博客后台
Route::resource('posts','PostsController',['names'=>'admins.posts']);

// 技能分类管理
Route::resource('skills','SkillsController',['names'=>'admins.skills']);

