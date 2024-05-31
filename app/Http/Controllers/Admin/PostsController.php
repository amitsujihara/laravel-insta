<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post){
        $this->post = $post;
    }

    // To get all posts records 
    // with trashed: you can see deleted redcord/posts 
    public function index(){
        $all_posts = $this->post->withTrashed()->latest()->paginate(5);
        return view('admin.posts.index')
            ->with('all_posts', $all_posts);
    }

    public function hide($id){
        $this->post->destroy($id);
        return redirect()->back();

    }

    // onlyTrashed : Select soft deleted records only.
    //  restore : un-delete a soft deleted record.
    public function unhide($id){
        $this->post->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

}
