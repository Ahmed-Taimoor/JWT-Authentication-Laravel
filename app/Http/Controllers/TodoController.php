<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Routing\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        //  (auth('api')->check())
        $todos = Todo::all();


        $fullTodos = [];
        foreach ($todos as $todo) {
            $fullTodos[] = $todo->getFullTodo();
        }
        $message = "Todos retrieved successfully";

        return $this->success($message, $todos->toArray());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $message = "Todo created successfully";
        return $this->success($message, $todo->toArray());


    }

    public function show($id)
    {
        $todo = Todo::find($id);
        $message = "Todo found successfully";
        return $this->success($message, $todo->toArray());

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();

        $message = "Todo updated successfully";
        return $this->success($message, $todo->toArray());
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        $message = "Todo deleted successfully";
        return $this->success($message, $todo->toArray());
    }
}
