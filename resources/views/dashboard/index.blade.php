@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <tasks list="{{ json_encode($tasks) }}"></tasks>
            </div>
        </div>

        <template id="tasks-template">
            <h1 class="text-center">Your ToDo list</h1>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Create Task
            </button>

            <div class="post" v-for="task in list">
                {{ Form::open() }} {{--['method' => 'PATCH', 'action' => ['DashboardController@update', $task->id]]--}}
                {{--{{ Form::checkbox('task', $task->id, $task->done ? true : false, ['onClick' => 'this.form.submit()'] ) }}--}}
                <input type="checkbox" name="task" value="@{{ task.id }}" >
                <h4> @{{ task.name }}</h4>
                {{ Form::close() }}
            </div>
        </template>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Task</h4>
                </div>
                {!! Form::open(['v-on:submit' => 'onSubmitForm']) !!}
                <div class="modal-body">
                    <span style="color: red" v-if="!newTask"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a Title', 'v-model' => 'newTask.name']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_button" class="btn btn-primary" :disabled="errors">Make Task</button>
                </div>
                <input type="hidden" name="user_id" v-model="newTask.user_id" value="{{ Auth::user()->id }}">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection