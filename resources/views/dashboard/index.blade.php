@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <tasks></tasks>
            </div>
        </div>

        <template id="tasks-template">
            <h1 class="text-center">Your To Do list</h1>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Task
            </button>

            <div class="post" v-for="task in list" >
                <h4 :class="{ 'completed': task.done }" v-on:click="toggleCompletedFor(task)"> @{{ task.name }}</h4>
                <button type="button" class="btn btn-danger" v-on:click="onDelete(task)"><i class="fa fa-times" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></i></button>
            </div>
        </template>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Task</h4>
                </div>
                {!! Form::open(['v-on:submit' => 'onSubmitForm']) !!}
                <div class="modal-body">
                    <span style="color: red" v-if="!tasks.name"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a Title', 'v-model' => 'tasks.name']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_button" class="btn btn-primary" :disabled="errors">Make Task</button>
                </div>
                <input type="hidden" name="user_id" v-model="tasks.user_id" value="{{ Auth::user()->id }}">
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Task</h4>
                </div>
                {!! Form::open(['v-on:submit' => 'onEditForm']) !!}
                <div class="modal-body">
                    <span style="color: red" v-if="!tasks.name"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    {{--{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a Title', 'v-model' => 'tasks.name']) !!}--}}
                    <input type="text" class="form-control" v-model="tasks.name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_button" class="btn btn-primary" :disabled="errors">Make Task</button>
                </div>
                <input type="hidden" name="user_id" v-model="tasks.user_id" value="{{ Auth::user()->id }}">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection