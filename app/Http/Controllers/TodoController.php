<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    /**
     * Create new todo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'userId' => 'required|int|exists:users,id',
            'status' => 'int|min:0|max:1',
        ]);

        $validated['status'] ??= 2;

        return JsonResponse::success(
            Todo::query()->create($validated)
        );
    }

    /**
     * Update the entire todo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->json()->set('id', $request['id']);    // Let's put the id in json body to validate it too

        $validated = $this->validate($request, [
            'id' => 'required|int|exists:todos,id',
            'title' => 'required|min:3|max:100',
            'userId' => 'required|int|exists:users,id',
            'status' => 'int|min:0|max:1',
        ]);

        $request->json()->remove('id'); // We remove it now

        $todo = Todo::query()->find($validated['id']);
        $todo->update($validated);

        return JsonResponse::success($todo);
    }

    /**
     * Update specific value from todo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function patch(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->json()->set('id', $request['id']);    // Let's put the id in json body to validate it too

        $validated = $this->validate($request, [
            'id' => 'required|int|exists:todos,id',
            'title' => 'min:3|max:100',
            'userId' => 'int|exists:users,id',
            'status' => 'int|min:0|max:1',
        ]);

        $request->json()->remove('id'); // We remove it now

        $todo = Todo::query()->find($validated['id']);
        $todo->update($validated);

        return JsonResponse::success($todo);
    }

    /**
     * Delete specific todo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->json()->set('id', $request['id']);    // Let's put the id in json body to validate it too

        $validated = $this->validate($request, [
            'id' => 'required|int|exists:todos,id',
        ]);

        $request->json()->remove('id'); // We remove it now

        $todo = Todo::query()->find($validated['id']);
        $todo->delete();

        return JsonResponse::success(['message' => 'Todo deleted successfully']);
    }

    /**
     * Find specific todo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(Request $request): \Illuminate\Http\JsonResponse
    {
        $todo = Todo::query()->find($request['id']);

        if (empty($todo)) {
            return JsonResponse::error(['message' => 'Such todo does not exists'], 404);
        }

        return JsonResponse::success($todo);
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
                Todo::query()
                    ->where('userId', $request['userId'])
                    ->get()
            );
        }


        return JsonResponse::success(Todo::all());
    }
}
