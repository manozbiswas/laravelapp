<?php
use \App\User;
use \App\Post;
use \App\Address;
use \App\Staff;
use \App\Photo;
use \App\Product;
use \App\Tag;
use App\Video;

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

/**
 * Many to many relationship between user and role
 */

Route::get('role/create', function () {
//    $role = new \App\Role();
//    $role->name = 'Administrator';
//    $role->save();

    $user = User::find(2);

    $role = new \App\Role(['name' => 'Subscriber']);
//    $role = \App\Role::find(2);
    $user->roles()->save($role);
});

Route::get('/role/read', function () {
    $user = User::findOrFail(2);
//    dd($user->roles());
    foreach ($user->roles as $role) {
        echo $role->name . '<br>';
    }
});

Route::get('/role/update', function () {
    $user = User::findOrFail(1);
    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name == 'administrator') {
                $role->name = 'Administrator';
                $role->save();
            }
        }
    }
});

Route::get('/role/delete', function () {
    $user = User::findOrFail(1);

    foreach ($user->roles as $role) {
        $role->whereId(3)->delete();
    }
});
/**
 * attach method inserts a record to the pivot table
 */
Route::get('role/attach', function () {
    $user = User::find(2);
    $user->roles()->attach(4);
});
/**
 * detach method deletes a record from th pivot table
 */
Route::get('role/detach', function () {
    $user = User::find(2);
    $user->roles()->detach(4);
});
/**
 * sync mehtod places the data that are in the array
 */

Route::any('/role/sync', function () {
    $user = User::findOrFail(2);
    $user->roles()->sync([1, 2, 4]);
});

/**
 * Has many through relationship among staff, product and photos
 */

Route::get('staff/create', function () {
    $staff = new \App\Staff(['name' => 'Debnath']);
    $staff->save();
});
Route::get('photo/create', function () {
    $staff = Staff::find(1);
    $staff->photos()->create(['path' => 'example.jpg']);
});
Route::get('photo/read', function () {
    $staff = Staff::find(1);
    foreach ($staff->photos as $photo) {
        echo $photo->path;
    }
});

Route::get('/photo/update', function () {
    $staff = Staff::findOrFail(1);
    $photo = $staff->photos()->whereId(1)->first();
    $photo->path = 'update.jpg';
    $photo->save();
});

Route::get('/photo/delete', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();
});
Route::get('/photo/assign', function () {
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(3);
    $staff->photos()->save($photo);
});

/**
 * Polymorphic relationship among post, tag and video
 */
Route::get('video/create', function () {
    $staff = new Video(['name' => 'bangla.mp3']);
    $staff->save();
});
Route::get('tag/create', function () {
    $post = Post::find(5);
    $post_tag = Tag::find(2);
    $post->tags()->save($post_tag);

    $video = Video::find(1);
    $video_tag = Tag::find(3);
    $video->tags()->save($video_tag);
});

Route::get('/tag/read', function () {
//    $post = Post::findOrFail(5);
    $post = Video::findOrFail(1);
    foreach ($post->tags as $tag) {
        echo $tag->name.'<br/>';
    }
});
Route::get('/tag/update', function () {
    $post = Post::findOrFail(5);
    $video= Video::findOrFail(1);
//    foreach ($post->tags as $tag) {
//        echo $tag->whereId(1)->update(['name'=> 'PHP']);
//    }

    $tag = Tag::find(2);

//   $post->tags()->attach($tag);
//    $video->tags()->attach($tag);
    $video->tags()->sync([1,2,3]);
});

/**
 * this will delte the tag no 3 which relates to the post no 5 in the
 * taggable table
 */
Route::get('/tag/delete', function(){
    $post = Post::findOrFail(5);
    foreach ($post->tags as $tag) {
        echo $tag->whereId(3)->delete();
    }
});