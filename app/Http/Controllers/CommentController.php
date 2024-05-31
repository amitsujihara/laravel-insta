<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    private $comment;
    private $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;
    }

    public function store(Request $request, $post_id){


        $request->validate(
            [
                'comment_body' . $post_id => 'required|max:150'
            ],
            [
                'comment_body' . $post_id . '.required' => 'You cannot submit an empty comment.',
                'comment_body' . $post_id . '.max' => 'The comment must not be greater than 150 characters.'
            ]
    
    );

        $this->comment->body = $request->input('comment_body' . $post_id);
        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $post_id;
        $this->comment->save();


        // The information inside this array will be used in the email body.


        $post = Post::findOrFail($post_id);
        $user = $post->user;

        $details = ['name' => $user->name,
                    'commented_user' =>  Auth::user()->name,
                    'comment_body'=> $this->comment->body,
                    'user' => $user
                ];

        // Send an email to the user.


        Mail::send('users.emails.comment', $details, function($message) use ($user){
            $message
                ->from(config('mail.from.address'), config('app.name'))
                ->to($user->email, $user->name)
                ->subject('You got a comment!');
        });

        return redirect()->back();
    }

    public function destroy($id){

        $this->comment->destroy($id);

        return redirect()->back();
    }
}

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\Comment;
// use App\Models\User;
// use App\Models\Post;
// use Illuminate\Support\Facades\Mail;

// class CommentController extends Controller
// {
//     private $comment;

//     public function __construct(Comment $comment)
//     {
//         $this->comment = $comment;
//     }

//     public function store(Request $request, $post_id, User $user, Post $post){
//         $request->validate(
//             [
//                 'comment_body' . $post_id => 'required|max:150'
//             ],
//             [
//                 'comment_body' . $post_id . '.required' => 'You cannot submit an empty comment.',
//                 'comment_body' . $post_id . '.max' => 'The comment must not be greater than 150 characters.'
//             ]
    
//     );

//         $comment = new Comment();
//         $comment->body = $request->input('comment_body' . $post_id);
//         $comment->user_id = Auth::user()->id;
//         $comment->post_id = $post_id;
//         $comment->save();

    

//         // The information inside this array will be used in the email body.
//         $details = ['name' => $comment->post->user->name,
//                     'commented_user' =>$comment->user->name,
//                     'comment_body'=> $comment->body,
//                     'comment' => $comment
//                 ];

//         // Send an email to the owner of the post.
//         Mail::send('users.emails.comment', $details, function($message) use ($user, $comment){
//             $message
//                 ->from(config('mail.from.address'), config('app.name'))
//                 ->to($comment->user->email, $comment->user->name)
//                 ->subject('You got a comment!');
//         });

//         return redirect()->back();
//     }

//     public function destroy($id){
//         $this->comment->destroy($id);

//         return redirect()->back();
//     }
// }
