<?php
use \App\User;
use \App\Post;
use \App\Address;

Route::get(/**
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
    '/', function () {
    return view('welcome');
});

Route::get('/about', 'HomeController@index');

/**
 * One to one relationship between user and address
 */

Route::get('user/add', function () {
    $user = new User(['name' => 'manoz', 'email' => 'mkbiitdu@gmail.com', 'password' => bcrypt('manoz')]);
    $user->save();
});

Route::get('/address/insert', function () {
    $user = User::find(1);

//    $address = new Address(['name' => 'B-4/5, Bangladesh Colony']);
//    $user->address()->save($address);
    return $user;
});

Route::get('/address/update', function () {
    $address = Address::whereUserId(1)->first();
    $address->name = 'B-4/5, bankcolony';
    $address->save();

});

Route::get('/address/read', function () {
    $user = User::findOrFail(1);
    echo $user->address->name;
});

Route::get('/address/delete', function () {
    $user = User::findOrFail(1);
    $user->address()->delete();
});

/**
 * One to many relationship between user and posts
 */
Route::get('/post/create', function () {
    $user = User::findOrFail(2);
    $post = new Post(['title' => 'First post 2nd user', 'body' => 'Body of my first post']);
    $user->posts()->save($post);
});

Route::get('/post/read', function () {
    $user = User::findOrFail(1);
    foreach ($user->posts as $post) {
        echo $post->title . '<br>';
    }
});

Route::get('/post/update', function () {
    $user = User::findOrFail(1);
//    $user->posts()->whereId(4)->update(['title'=> 'new title', 'body'=> 'Faka body']);
    $user->posts()->where('id', '=', 3)->update(['title' => 'fdsfsf title', 'body' => 'Faka body']);
});

Route::get('/post/delete', function () {
    $user = User::find(1);
    $user->posts()->whereId(4)->delete();
});

/**
 * Inverse relationship of one to many for user and post
 */
Route::get('post/user', function () {
    $post = Post::find(6);
    return $post->user->name;
});

