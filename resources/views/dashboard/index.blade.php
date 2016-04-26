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
            <div class="form-group">
                <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#createModal">
                    Create Task
                </button>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-xs" v-on:click="done = ''">
                    All Tasks
                </button>
                <button type="button" class="btn btn-success btn-xs" v-on:click="done = 1">
                    Tasks Done
                </button>
                <button type="button" class="btn btn-warning btn-xs" v-on:click="done = 0">
                    Tasks Not Done
                </button>
            </div>

            <div class="form-group">
                <button v-if="ordertype === 'updated_at'" type="button" class="btn btn-primary btn-xs" v-on:click="ordertype = 'created_at'">
                    Order By Creation
                </button>
                <button v-if="ordertype === 'created_at'" type="button" class="btn btn-primary btn-xs" v-on:click="ordertype = 'updated_at'">
                    Order By Update
                </button>
                <button v-if="direction === -1" type="button" class="btn btn-warning btn-xs" v-on:click="direction = direction * -1">
                    Display in Ascending Order
                </button>
                <button v-if="direction === 1" type="button" class="btn btn-warning btn-xs" v-on:click="direction = direction * -1">
                    Display in Descending Order
                </button>
            </div>

            <div class="post" v-for="task in list | filterBy done in 'done' | orderBy ordertype direction">
                <p v-if="ordertype === 'created_at'">Created at: @{{ task.created_at | moment }}</p>
                <p v-if="ordertype === 'updated_at'">Updated at: @{{ task.updated_at | moment }}</p>
                <h4 :class="{ 'completed': task.done }" v-on:click="toggleCompletedFor(task)"> @{{ task.name }}</h4>
                <button type="button" class="btn btn-danger btn-xs" v-on:click="onDelete(task)"><i class="fa fa-times" aria-hidden="true"></i></button>
                <button type="button" v-on:click="toggleEditInput(task.id)" class="btn btn-primary btn-xs" value="@{{ task.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                <div class="form-group" v-if="show === task.id">
                    <input class="form-control" type="text" name="name" value="@{{ task.name }}" v-model="task.name" v-on:keyup.enter="editTask(task)">
                    <button class="btn btn-warning btn-xs" v-on:click="toggleEditInput('')">Close</button>
                </div>
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
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a Title', 'v-model' => 'tasks.name', 'autofocus']) !!}
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