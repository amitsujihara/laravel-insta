<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    // Since the model name is CategoryPost, Laravel will assume th etable name is category_posts, which is wrong. do this aviod that error.
    protected $table = "category_post";

    // because we will user create(array) later. we dont't have to this for save()
    protected $fillable = ['category_id', 'post_id'];

    // disable the automatic timestamps created_at and updated_at
    public $timestamps = false;

    // To get the name of the category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
