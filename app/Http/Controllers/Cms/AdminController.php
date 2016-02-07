<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\User;
use Illuminate\Http\Request;
use App\Events\UserWasRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $users;

    public function __construct(User $user) 
    {
        $this->middleware('auth');
        $this->users = $user;

        parent::__construct();    
    }

    public function index() 
    {
        $users = $this->users->where('admin', true)->paginate();

        return view('cms.admin.index', compact('users'));
    }

    public function create() 
    {
        return view('cms.admin.create');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = $this->users->fill($request->all());
        $user->admin = 1;
        $user->save();

        event(new UserWasRegistered($user, $request->password));

        flash()->success('Created!', "$user->name has been created.");

        return redirect()->route('cms.admin.index');
    }

    public function edit($id) 
    {
        $user = $this->users->findOrFail($id);

        return view('cms.admin.edit', compact('user'));
    }

    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $user =$this->users->findOrFail($id);
        $user->update($request->all());

        flash()->success('Update!', "$user->name has been updated.");

        return redirect()->route('cms.admin.index');
    }

    public function destroy($id) 
    {
        $user = $this->users->findOrFail($id);
        $user->delete();

        flash()->success('Deleted!', "$user->name has been deleted.");

        return redirect()->route('cms.admin.index');
    }
}
