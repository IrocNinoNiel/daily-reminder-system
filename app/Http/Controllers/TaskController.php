<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'color'=>'required'
        ]);

        $task = new Task;

        $task->name = $request->name;
        $task->user_id = Auth::user()->id;
        $task->due_time = $request->due_time;
        $task->color = $request->color;

        $task->save();

        return Redirect::route('home')->with('success','Task Created');

    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if(is_null($task)) return abort(404);

        $task->delete();

        return Redirect::route('home')->with('error','Task Deleted');
    }
}
