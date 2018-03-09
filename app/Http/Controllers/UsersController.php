<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use BroQiang\LaravelImage\BroImage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show','follows','comments']]);
    }

    public function follows(User $user)
    {
        $posts = $user->followsAll()->paginate(20);
        return view('users.follows', compact('posts', 'user'));
    }

    public function comments(User $user)
    {
        $comments = $user->comments()->paginate(20);

        return view('users.comments', compact('comments', 'user'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function editAvatar(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit_avatar', compact('user'));
    }

    public function editPassword(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit_password', compact('user'));
    }

    public function update(UserRequest $request, BroImage $image, User $user)
    {
        $this->authorize('update', $user);

        // 判断提交数据表单的 url ，根据不同表单做不同的处理
        $previous = basename(parse_url(url()->previous(), PHP_URL_PATH));
        $message  = '个人资料更新成功';
        switch ($previous) {
            case 'edit':
                $user    = $this->updateEdit($request, $user);
                $message = '个人资料更新成功';
                break;
            case 'edit_avatar':
                $info = $image->upload($request->avatar, [
                    'folder'      => 'avatar',
                    'file_prefix' => 'avatar_' . $user->id,
                    'max_width'   => 260,
                ]);

                if (isset($info['success']) && $info['success']) {
                    $user->avatar = $info['url'];
                    $message      = '头像上传成功';
                } else {
                    $message = $info['message'];
                }
                break;
            case 'edit_password':
                $user->password = bcrypt($request->password);
                $message        = '密码修改成功，新的密码是：' . $request->password . ' ，请将它牢记。';
                break;
        }

        $user->update();

        return redirect()->back()->with('success', $message);
    }

    protected function updateEdit(UserRequest $request, User $user)
    {
        $user->github       = $request->get('github') ?: '';
        $user->weibo        = $request->get('weibo') ?: '';
        $user->homepage     = $request->get('homepage') ?: '';
        $user->introduction = $request->get('introduction') ?: '';

        return $user;
    }
}
