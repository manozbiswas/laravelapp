<?php
use \App\User;
use \App\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', 'HomeController@index');

Route::get('/insert', function () {
    $user = User::find(1);
//    $user = new User(['name' => 'manoz', 'email' => 'mkbiitdu@gmail.com', 'password' => bcrypt('manoz')]);
//    $user->save();
    $post = new Post(['name' => 'first user first post']);
    $user->post()->save($post);
});

Route::get('/update', function(){
    $post = Post::whereUserId(2)->first();
    $post->name = 'Second user first post midified';
    $post->save();

});

Route::get('/read', function(){
  $user = User::findOrFail(2);
    echo $user->post->name;
});

Route::get('/delete', function(){
   $user = User::findOrFail(1);
    $user->post()->delete();
});

