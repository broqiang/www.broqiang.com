<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index(User $user)
    {
        $users = $user->with(['followsAll', 'comments'])->orderBy('created_at', 'desc')->paginate(20);

        return view('admins.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('message', '删除成功');
    }
}
