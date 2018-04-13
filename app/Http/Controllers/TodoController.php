<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Category;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoResource::collection(
            Todo::with('category', 'priority')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = Todo::create(
            [
            'title' => $request->title,
            'description' => $request->description ?? null,
            'priority_id' => $request->priority,
            'category_id' => $request->category ?? null,
            'due_at' => new Carbon($request->dueAt)
            ]
        );

        return new TodoResource($todo->load(['category', 'priority']));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Todo  $todo
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        // return $todo->load('category');
        // return new TodoResource($todo);
        return new TodoResource($todo->load('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Todo  $todo
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        // $rules = [];
        // $request->validate($rules);
        $todo->update(
            [
            'title' => $request->title,
            'description' => $request->description,
            'priority_id' => $request->input('priority.id'),
            'category_id' => $request->input('category.id'),
            'due_at' => $request->dueAt,
            'isComplete' => $request->isComplete
            ]
        );

        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Todo $todo
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $removedTodo = $todo;
        try {
            $todo->delete();
            return new TodoResource($removedTodo);
        } catch(Exception $e) {
            return (new TodoResource($removedTodo))->additional(
                [
                    'meta' => ['message' => $e->message]
                ]
            );
        }
    }
}
