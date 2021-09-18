<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    /**
     * @var Post
     */
    private $postModel;

    /**
     * @param Post $postModel
     */
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function add(array $attributes): bool
    {
        $createdPost = $this->postModel->fill($attributes);

        return $createdPost->save();
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        $updatedPost = $this->postModel->findOrFail($id);

        if ($updatedPost && $updatedPost->user_id === Auth::user()->id || Auth::user()->role === 'admin')
        {
            $updatedPost->fill($attributes);

            return $updatedPost->save();
        }

        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $postToDelete = $this->postModel->findOrFail($id);

        if ($postToDelete && $postToDelete->user_id === Auth::user()->id || Auth::user()->role === 'admin')
        {
            return $postToDelete->delete();
        }

        return false;
    }
}
