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
        $tasks = Task::with('creator.assignedTasks')
            ->filter(request()->only(['status']))
            ->paginate();

        return view('dashboard.task', compact('status', 'tasks'));
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
        $this->uploadImage($file, $task);

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        $status = $this->status;
        $users = User::all();
        $assignedUsers = $task->assignedUsers->pluck('id', 'name')->toArray();
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
        $this->uploadImage($file, $task);

        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }

    private function uploadImage($file, $task)
    {
        if (!$file) {
            return;
        }
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('attachments'), $fileName);
        $task->attachments()->create([
            'attachment' => $file,
            'file_path' => $fileName
        ]);
    }
}
