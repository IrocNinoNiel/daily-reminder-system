@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Task</div>

                <div class="card-body">
                    @include('inc.message')
                    <form method="POST" action="{{ route('task.store') }}">

                        @csrf
                        <div class="form-group">
                            <div class="row">
                            <div class="col-6">
                                <label for="name">Tasks</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Task" name="name">
                            </div>
                            <div class="col">
                                <label for="due_time">Time</label>
                                <input type="time" class="form-control" id="due_time" placeholder="Enter Task" name="due_time">
                            </div>
                            <div class="col">
                                <label for="color">Color</label>
                                <select class="form-control" name="color" id="color">
                                    <option value="border-primary">Blue</option>
                                    <option value="border-secondary">Grey</option>
                                    <option value="border-danger">Red</option>
                                    <option value="border-dark">Dark</option>
                                    <option value="border-warning">Yellow</option>
                                    <option value="border-Success">Green</option>
                                </select>
                            </div>
                        </div>
                           <!--  <div>
                                <label for="name">Tasks</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Task" name="name">
                                <input type="time" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Task" name="name">
                            </div> -->
                        </div>
                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="fa fa-plus"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Current Tasks</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Task</th>
                                <th scope="col">Time</th>
                             </tr>
                        </thead>
                        <tbody>
                            
                            @if(count(Auth::user()->task) > 0)
                                @foreach(Auth::user()->task as $task)
                                    <tr class="border-left border-5 {{$task->color}}">
                                        <td colspan="2" class="">
                                            <div class="">
                                                {{$task->name}}
                                            </div>
                                        </td>
                                        <td>@if(!is_null($task->due_time)) {{\Carbon\Carbon::parse($task->due_time)->format('g:i A')}} @else -- @endif</td>
                                        <td class="text-right">
                                            <form action="{{ route('task.destroy', $task->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
