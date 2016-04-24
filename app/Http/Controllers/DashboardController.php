<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    /**
     * Only allow registered users to access this functionality
     *
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return Users to do list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('dashboard.index', compact('tasks'));
    }

    public function create()
    {

    }

    /**
     * Store newly created Task
     *
     * @param TaskRequest $request
     * @return static
     */
    public function store(TaskRequest $request)
    {
        if($request->user_id == Auth::user()->id)
        {
            return Task::create($request->all());
        }
    }

    public function edit()
    {

    }

    /**
     * Mark task on the to do list
     *
     * @param $id
     * @param TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, TaskRequest $request)
    {
        $input = $request->all();
        $task = Task::findOrFail($id);
        $task->update($input);
    }

    /**
     * Delete selected Task
     *
     * @param $id
     */
    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
