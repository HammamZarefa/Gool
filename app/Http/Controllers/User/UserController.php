<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $users = User::where('parent', $user)->get();
        return view('user.users.index', compact('users'));
    }

    public function create()
    {
        return view('user.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'balance' => 'required',
        ]);
        $parent = auth()->user();
        if ($request->balance > $parent->balance || $parent = auth()->user()->is_admin == 0) {
            session()->flash('Danger', 'Your balance is not enough');
            return back();
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->balance = $request->balance;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->parent = $parent->id;
        $user->save();
        $parent->balance -= $request->balance;
        $parent->save();

        session()->flash('success', 'Created Successfully');
        return redirect(route('user.users'));
    }

    public function edit($id)
    {
        $user = User::findorfail($id);
        if ($user->parent != auth()->id())
            return back()->with('Access Denied');
        else
            return view('user.users.edit', compact('user'));

    }

    public function update($id,Request $request )
    {
        $user = User::findorfail($id);
        $parent=auth()->user();
        if ($parent->id!=$user->parent || $parent->balance < $request->added_balance) {
            session()->flash('danger', 'Your balance is not enough');
            return back();
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->balance +=$request->added_balance;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status=$request->status;
        $user->save();
        $parent->balance -=$request->added_balance;
        $parent->save();
        session()->flash('success', 'Updated Successfully');
        return redirect(route('user.users'));
    }

    public function status($id)
    {
        $user=User::findorfail($id)->where('parent', auth()->id());
        $user->status==1? $user->status=0 : $user->status=1;
        session()->flash('success', 'Updated Successfully');
        return back();
    }
}

