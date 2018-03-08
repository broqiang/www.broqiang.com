<?php 

Route::get('','HomesController@index')->name('admins.index');

Route::resource('posts','PostsController',['names'=>'admins.posts']);