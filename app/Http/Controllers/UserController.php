<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Role;
use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = User::with('role')->where('role_id', '!=', 1)->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }


    public function store(StoreUser $request)
    {
        $validate = $request->validated();
        $validate['password'] = Hash::make($request->password);
        User::create($validate);
        session()->flash('success', 'User berhasil dibuat');

        return redirect()->route('user.index');
        //
    }



    public function edit(User $user)
    {
        $roles = $this->user->getRole();

        return view('dashboard.users.edit', compact('user', 'roles'));
        //
    }


    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        if ($request->password != null){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password)
            ]);
        } else {
            $user->update($validate);
        }

        session()->flash('success', 'User berhasil diperbaruhi');
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User Berhasil dihapus');

        return redirect()->route('user.index');
    }
}
