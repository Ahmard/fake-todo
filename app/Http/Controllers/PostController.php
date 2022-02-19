<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Create new post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:3|max:200',
            'userId' => 'required|int|exists:users,id',
        ]);

        return JsonResponse::success(
            Post::query()->create($validated)
        );
    }

    /**
     * Update the entire post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->json()->set('id', $request['id']);    // Let's put the id in json body to validate it too

        $validated = $this->validate($request, [
            'id' => 'required|int|exists:posts,id',
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:3|max:200',
            'userId' => 'required|int|exists:users,id',
        ]);

        $request->json()->remove('id'); // We remove it now

        $post = Post::query()->find($validated['id']);
        $post->update($validated);

        return JsonResponse::success($post);
    }

    /**
     * Update specific value from post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function patch(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->json()->set('id', $request['id']);    // Let's put the id in json body to validate it too

        $validated = $this->validate($request, [
            'id' => 'required|int|exists:posts,id',
            'title' => 'min:3|max:100',
            'body' => 'min:3|max:200',
            'userId' => 'int|exists:users,id',
        ]);

        $request->json()->remove('id'); // We remove it now

        $post = Post::query()->find($validated['id']);
        $post->update($validated);

        return JsonResponse::success($post);
    }

    /**
     * Delete specific post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->json()->set('id', $request['id']);    // Let's put the id in json body to validate it too

        $validated = $this->validate($request, [
            'id' => 'required|int|exists:posts,id',
        ]);

        $request->json()->remove('id'); // We remove it now

        $post = Post::query()->find($validated['id']);
        $post->delete();

        return JsonResponse::success(['message' => 'Post deleted successfully']);
    }

    /**
     * Find specific post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(Request $request): \Illuminate\Http\JsonResponse
    {
        $post = Post::query()->find($request['id']);

        if (empty($post)) {
            return JsonResponse::error(['message' => 'Such post does not exists'], 404);
        }

        return JsonResponse::success($post);
    }

    public function postComments(Request $request): \Illuminate\Http\JsonResponse
    {
        $post = PostComment::query()
            ->select('id')
            ->where('id', $request['id'])
            ->first();

        if (empty($post)) {
            return JsonResponse::error(['message' => 'Such post does not exists'], 404);
        }

        return JsonResponse::success(
            PostComment::query()
                ->where('postId', $request['id'])
                ->get()
        );
    }

    /**
     * List all posts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->has('userId')) {
            return JsonResponse::success(
                Post::query()
                    ->where('userId', $request['userId'])
                    ->get()
            );
        }


        return JsonResponse::success(Post::all());
    }
}
