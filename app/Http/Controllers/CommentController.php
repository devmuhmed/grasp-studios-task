<?php

namespace App\Http\Controllers;

use App\Http\Requests\dashboard\CommentRequest;
use App\Models\Task;

class CommentController extends Controller
{

    public function store(CommentRequest $request, Task $task)
    {
        $task->comments()->create($request->validated()+['user_id' => auth()->id()]);
        return redirect()->back();
    }
}
