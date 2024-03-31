<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use domain\Facades\TodoFacade;
use App\Models\Todo;
use Inertia\Inertia;

class TodoController extends ParentController
{

    public function index()
    {
        return Inertia::render('Todo/index');
    }

    public function store(Request $request)
    {
        return TodoFacade::store($request->all());
    }

    public function list()
    {
        $tasks = TodoFacade::all();
        return response()->json($tasks);
    }


    public function edit(Request $request)
    {
        $response['task'] = TodoFacade::get($request['task_id']);
        return view('pages.todo.edit')->with($response);
    }

    public function update(Request $request, $task_id)
    {
        return TodoFacade::update($request->all(), $task_id);
    }

    public function delete($id)
    {
        return TodoFacade::delete($id);
    }

    public function done($id)
    {
        return TodoFacade::done($id);
    }

    public function get($id)
    {
        $task = TodoFacade::get($id);
        return response()->json($task);
    }
}
