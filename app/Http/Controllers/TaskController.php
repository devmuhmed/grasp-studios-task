<?php

namespace App\Http\Controllers;

use App\Http\Requests\dashboard\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TaskController extends Controller
{
    private $status = [
        'all' => 'All',
        'open' => 'Open',
        'in_progress' => 'In Progress',
        'completed' => 'Completed'
    ];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $status = $this->status;
        $userTasks = auth()->user()->tasks()->latest()->get();
        $assignedTasks = auth()->user()->assignedTasks()->latest()->get();
        $tasks = $userTasks->merge($assignedTasks);

        return view('dashboard.task', compact('status','tasks'));
    }

    public function show(Task $task)
    {
        return view('dashboard.task-show', compact('task'));
    }
    public function create()
    {
        $status = $this->status;
        $users = User::all();
        return view('dashboard.task-create', compact('status', 'users'));
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $assignedUsers = Arr::pull($validated, 'assigned_users');
        $file = Arr::pull($validated, 'attachment');
        $task = auth()->user()->tasks()->create($validated);

        if ($assignedUsers) {
            $task->assignedUsers()->sync($assignedUsers);
        }

        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachments'), $fileName);
            $task->attachments()->create([
                'attachment' => $file,
                'file_path' => $fileName
            ]);
        }

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        $status = $this->status;
        $users = User::all();
        $assignedUsers = $task->assignedUsers->pluck('id','name')->toArray();
        return view('dashboard.task-edit', compact('status', 'users', 'task', 'assignedUsers'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $assignedUsers = Arr::pull($validated, 'assigned_users');
        $file = Arr::pull($validated, 'attachment');
        $task->update($validated);

        if ($assignedUsers) {
            $task->assignedUsers()->sync($assignedUsers);
        }

        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachments'), $fileName);
            $task->attachments()->create([
                'attachment' => $file,
                'file_path' => $fileName
            ]);
        }

        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }

    public function filter(Request $request)
    {
        $status = $this->status;
        if($request->status !== 'all'){
            $userTasks = auth()->user()->tasks()->where('status', request('status'))->latest()->get();
            $assignedTasks = auth()->user()->assignedTasks()->where('status', request('status'))->latest()->get();
            $tasks = $userTasks->merge($assignedTasks);
        }else{
            $userTasks = auth()->user()->tasks()->latest()->get();
            $assignedTasks = auth()->user()->assignedTasks()->latest()->get();
            $tasks = $userTasks->merge($assignedTasks);
        }


        return view('dashboard.task-list', compact('status','tasks'));
    }
}
