<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use App\Services\Post\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    private $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->middleware('auth');
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::with('user')->where('user_id', Auth::user()->id)->get();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostCreateRequest $request
     * @return RedirectResponse
     */
    public function store(PostCreateRequest $request): RedirectResponse
    {
        $attributes = $request->all();
        $attributes['user_id'] = Auth::user()->id;

        $savePost = $this->postService->add($attributes);

        if ($savePost)
        {
            return redirect()->route('posts.create')->with('status', 'Пост создан успешно!');
        }

        return redirect()->route('posts.create')->with('status', 'Ошибка в создании поста');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit(int $id)
    {
        $postForEdit = Post::findOrFail($id);

        if ($postForEdit && $postForEdit->user_id === Auth::user()->id)
        {
            return view('post.edit', compact('postForEdit'));
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PostUpdateRequest $request, int $id): RedirectResponse
    {
        $attributes = $request->all();
        $updatePost = $this->postService->update($id, $attributes);

        if ($updatePost)
        {
            return redirect()->route('posts.index')->with('status', 'Пост отредактирован!');
        }

        return redirect()->route('posts.index')->with('status', 'Ошибка редактирования поста');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $deletePost = $this->postService->delete($id);

        if ($deletePost)
        {
            return redirect()->route('posts.index')->with('status', 'Пост удалён!');
        }

        return redirect()->route('posts.index')->with('status', 'Ошибка удаления поста');
    }
}
