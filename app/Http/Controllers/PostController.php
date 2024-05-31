<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

// Inherit Post and Category models because we will be using posts and categories table in this file.
class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category){
        $this->post = $post;
        $this->category = $category;
    }

    public function create(){
        $all_categories = $this->category->all();

        return view('users.posts.create')->with('all_categories', $all_categories);
    }

#To store post ,Request: all input thorough this form form
    public function store(Request $request){
        // $request = [
        //     'description' => 'sdf sd',
        //     'image'       => 'asddf.img',
        //     'category'    => ['Travel', 'Food']
        // ];

        #1 : Validate all form data
        $request->validate([
            'category' => 'required|array|between:1,3',
            // 1,3 = 1 to 3
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:1048'
        ]);
        
// ??????
        #2 : Save the post
        $this->post->user_id =Auth::user()->id;
        $this->post->image   ='data:image/'. $request->image->extension(). ';base64,'.base64_encode(file_get_contents($request->image));
        $this->post->description = $request->description;

        $this->post->save();

        #3 : Save the categoryies to category_post table
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }

        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');
    }

    
    public function show($id){
        $post = $this->post->findOrFail($id);
        return view('users.posts.show')->with('post', $post);
    }

    #Post Edit
    public function edit($id){

        $post = $this->post->findOrFail($id);
        $all_categories = $this->category->all();

        $selected_categories =[];
        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }
        return view('users.posts.edit')
        ->with('post', $post)
        ->with('all_categories', $all_categories)
        ->with('selected_categories', $selected_categories);
    }

    #post update
    public function update(Request $request, $id){
        #1: Validate the data from form
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image' => 'mimes:png,jpg,jpeg,gif|max:1048'
        ]);

        #2: Update the post
        $post               = $this->post->findOrFail($id);
        $post->description = $request->description;
           
            if($request->image){
                $post->image  = 'data:image/'. $request->image->extension(). ';base64,'.base64_encode(file_get_contents($request->image));
            }

        #3: Save the post
        $post->save();

        #4: Delete all record related this table from category post table
        $post->categorypost()->delete();

        #5: Save the new categories to category_post table
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }

        $post->categoryPost()->createMany($category_post);

        #6: redirect to show post page
        return redirect()->route('post.show' ,$id);

    }

    #Post Delete
    public function destroy($id){
        // $post = $this->post->findOrFail($id);
        // $this->deleteImage($post->image);

        $this->post->destroy($id);
        // return redirect()->back();
        return redirect()->route('index');
    }

}

