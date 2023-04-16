 <?php
use App\Models\Post;
use App\Models\Photo;
use App\Models\Country;
use App\Models\User;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return "Hi about page";
});

Route::get('/contact2', function () {
    return "Hi contact";
});
//adding variables to routes
Route::get('/post2/{id}/{name}', function ($id, $name) {
    return "This is post number ".$id." ".$name;
});
//naming routes
Route::get('/admin/posts/example', array('as'=>'admin.home', function(){
    $url = route('admin.home');
    return "this url is ".$url;
}));
//controllers
Route::get('/post3/{id}', '\App\Http\Controllers\PostsController@index');
Route::resource('posts', '\App\Http\Controllers\PostsController');
Route::get('/contact', '\App\Http\Controllers\PostsController@contact');
Route::get('/post/{id}/{name}/{password}', '\App\Http\Controllers\PostsController@show_post');
//Raw SQL CRUD
Route::get('/insert', function(){
    DB::insert('INSERT INTO posts (title, content) VALUES (?,?)', ['PHP with Laravel', 'PHP Laravel is the best thing that has happened']);
});
Route::get('/read2', function(){
    $results = DB::select('SELECT * FROM posts WHERE id=?', [1]);
    foreach($results as $post){
        return $post->title;
    }
});
Route::get('/update2', function(){
    $updated = DB::update('UPDATE posts SET title="Updated Title" WHERE id=?', [1]);
    return $updated;
});
Route::get('/delete2', function(){
    $deleted = DB::delete('DELETE FROM posts WHERE id=?', [1]);
    return $deleted;
});
//Eloquent using custom created Post model
Route::get('/read', function(){
    $posts = Post::all();
    foreach($posts as $post){
        return $post->title;
    }
});
Route::get('/find', function(){
    //2 here is id number
    $post = Post::find(2);
    return $post->content;
});
Route::get('/findwhere', function(){
    $posts = Post::where('id', 2)
    ->orderBy('id', 'desc')
    ->take(1)
    ->get();
    return $posts;

});
Route::get('findmore', function(){
    //$posts = Post::findOrFail(1);
    $posts = Post::where('is_admin', '<', 50)
    ->firstOrFail();
    return $posts;
});
Route::get('/basicinsert', function(){
    $post = new Post;
    $post->title = 'New ORM title insert';
    $post->content = 'Wow eloquent is really cool, look at this';
    $post->save();
});
Route::get('/basicupdate', function(){
    $post = Post::find(2);
    $post->title = 'Updated';
    $post->content = 'Wow eloquent is really cool, look at this';
    $post->save();
});
Route::get('/create', function(){
    Post::create(['title'=>'the create method', 'content'=>'Wow Im learning a lot of PHP']);

});
Route::get('/update', function(){
    Post::where('id', 2)
    ->where('is_admin',0)
    ->update(['title'=>'New PHP title', 'content'=>'I love PHP']);
});
Route::get('/delete', function(){
    $post = Post::find(6);
    $post->delete();

});
Route::get('/delete3', function(){
    //delete more than one
    Post::destroy(5,4);
});
//recoverable delete
Route::get('/softdelete', function(){
    Post::find(4)->delete();
});
Route::get('/readsoftdelete', function(){
    //$post = Post::find(4);
    //return $post;
    //$post = Post::withTrashed()->where('id',4)->get();
    $post = Post::onlyTrashed()->get();
    return $post;
});
Route::get('/restore', function(){
    Post::withTrashed()->where('is_admin',0)->restore();
});
Route::get('/forcedelete', function(){
    Post::onlyTrashed()->find(4)->forceDelete();
});

//relational eloquent
//One to one relationship
Route::get('/user/{id}/post', function($id){
    return User::find($id)->post;
});
//Inverse relation
Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});
//One to many
Route::get('/allposts/{id}', function($id){
    $user =  User::find($id);
    foreach($user->posts as $post){
        echo $post->title.'<br>';
    }
});
//many to many
Route::get('/user/{id}/role', function($id){
    $user =  User::find($id)->roles()->orderBy('id', 'desc')->get();
    return $user;
    //foreach($user->roles as $role){
    //    echo $role->name.'<br>';
    //}
});
//access intermediate table
Route::get('/user/{id}/pivot', function($id){
    $user =  User::find($id);
    foreach($user->roles as $role){
        echo $role->pivot;
    }
});
Route::get('users/{id}/country', function ($id) {
    $country = Country::find($id);
    foreach($country->posts as $post){
        return $post->title;
    }

});
//Polymorphic relations
Route::get('users/{id}/photos', function ($id) {
    $user = User::find($id);
    foreach($user->photos as $photo){
        return $photo;
    }

});
Route::get('posts/{id}/photos', function ($id) {
    $post = Post::find($id);
    foreach($post->photos as $photo){
        echo $photo->path.'<br>';
    }

});
Route::get('photo/{id}', function ($id) {
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});
//Polymorphic many to many
Route::get('post/tag/{id}', function ($id) {
    $post = Post::find($id);
    foreach($post->tags as $tag){
        echo $tag->name;
    }
});
Route::get('/tag/{id}/post', function ($id) {
    $tag = Tag::find($id);
    foreach($tag->posts as $post){
        echo $post;
    }
});
Route::get('/tag/{id}/video', function ($id) {
    $tag = Tag::find($id);
    foreach($tag->videos as $video){
        echo $video;
    }
});
*/
//forms logic crud application
Route::resource('/posts', 'App\Http\Controllers\PostsController');
Route::group(['middleware'=>'web'], function(){
    Route::resource('/posts', 'App\Http\Controllers\PostsController');
    Route::get('/dates', function(){
        $date = new DateTime('+1 week');
        echo $date->format('m-d-Y');
        echo '<br>';
        //Carbon plugin for dates
        echo Carbon::now()->addDays(10)->diffForHumans();
        echo '<br>';
        echo Carbon::now()->subMonths(5)->diffForHumans();
        echo '<br>';
        echo Carbon::now()->yesterday()->diffForHumans();
    });
    Route::get('/getname', function(){
        $user = User::find(1);
        echo $user->name;
    });
    Route::get('/setname', function(){
        $user = User::find(1);
        $user->name = "william";
        $user->save();
    });
});
