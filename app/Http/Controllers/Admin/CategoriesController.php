<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;



class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category,Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    // To get all categories records 
    public function index(){
        $all_categories = $this->category->withCount('posts')->orderBy('updated_at', 'desc')->get();
        // Uncategorized categoryPost: form post.php
        $uncategorized_count = 0;
        $all_posts = $this->post->all();
        foreach($all_posts as $post){
            if($post->categoryPost->count() == 0){
                $uncategorized_count++;
            }
        }

        return view('admin.categories.index')
            ->with('all_categories', $all_categories)
            ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
        ]);
        
        $this->category->name = ucwords(strtolower($request->name));
        $this->category->save();

        return redirect()->route('admin.categories');
    }

    public function update(Request $request, $id){
        $request->validate([
            'new_name' => 'required|max:50|unique:categories,name,' . $id,
        ]);
        
        $category= $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->new_name));
        $category->save();

        return redirect()->back();
    }

    public function destroy($id){

        $this->category->destroy($id);
        return redirect()->back();
    }
}
