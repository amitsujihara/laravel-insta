<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        // withTrashed(): include the soft deleted records.
        $all_users = $this->user->withTrashed()->latest()->paginate(5);
        return view('admin.users.index')
            ->with('all_users', $all_users);
    }

    // This will soft delete user sice we declare Softdeletes in user model
    public function deactivate($id){
        $this->user->destroy($id);
        return redirect()->back();

    }

    // onlyTrashed : Select soft deleted records only.
    //  restore : un-delete a soft deleted record.
    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
