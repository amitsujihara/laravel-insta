<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
    
    public function show($id){
        $user = $this->user->findOrFail($id);
        
        return view('users.profile.show')
            ->with('user', $user);

    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user', $user);
    }

#Update
    public function update(Request $request){
        #Validtion
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email,'. Auth::user()->id,
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'introduction' => 'max:100'
        ]);

        #2: Update
        $user  = $this->user->findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;
           
            if($request->avatar){
                $user->avatar  = 'data:image/'. $request->avatar->extension(). ';base64,'.base64_encode(file_get_contents($request->avatar));
            }

        #3: Save 
        $user->save();
        return redirect()->route('profile.show',Auth::user()->id);

    }
    // To show all followers
    public function followers($user_id){
        $user = $this->user->findOrFail($user_id);
        return view('users.profile.followers')
                ->with('user', $user);
    }

    // To show following users
    public function following($user_id){
        $user = $this->user->findOrFail($user_id);
        return view('users.profile.following')
                ->with('user', $user);
    }
}