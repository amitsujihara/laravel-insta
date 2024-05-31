<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class HomeController extends Controller
{
    #For show all post index file
    private $post;
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;

        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $all_posts = $this->post->latest()->get();
        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();

        // you can see all posts in homepage dashbord
        return view('users.home')
            // ->with('all_posts', $all_posts);
            ->with('home_posts', $home_posts)
            ->with('suggested_users', $suggested_users);
    }

    # GET the posts of the USERS that the AUTH USER is FOLLOWING
    private function getHomePosts()
    {
        $all_posts = $this->post->latest()->get();
        $home_posts = []; // pre-defined empty array

        foreach($all_posts as $post){
            if($post->user->isFollowed() || $post->user->id === Auth::user()->id){
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }

    #Get the suers that the Auth user is not Following
    private function getSuggestedUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }

        return $suggested_users;
    }
    
   #Suggested
    public function suggestions(){
        $suggested_users = $this->getSuggestedUsers();
        return view('users.suggestions')
                ->with('suggested_users', $suggested_users);
    }

    public function search(Request $request){
        $users = $this->user->where('name', 'like', '%'. $request->search. '%')->get();

        return view('users.search')->with('users', $users)->with('search', $request->search);

        //Ex  Where name LIKE %ab -gab,stab
        // Where name LIKE re% -reace, rey, reinforce
        // Where name LIKE %e% -ley, queen, rechel 
    }
}
