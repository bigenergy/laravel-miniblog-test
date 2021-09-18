<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Requests\Profile\UploadAdminAvatarRequest;
use App\Http\Requests\Profile\UploadAvatarRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\Post\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::all();

        return view('admin.profile.edit', compact('users'));
    }

    /**
     * @param UploadAdminAvatarRequest $request
     * @return RedirectResponse
     */
    public function avatarUpload(UploadAdminAvatarRequest $request): RedirectResponse
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $hashFileName = md5($filename.time()).'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('images', $hashFileName, 'public');

            User::find($request->get('user_id'))->update(['avatar' => $hashFileName]);

            return redirect()->back()->with('status', 'Аватар загружен!');
        }
        return redirect()->back()->with('status', 'Ошибка загрузки');
    }

}
