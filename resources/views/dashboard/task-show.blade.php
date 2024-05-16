@extends('layout')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Task Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="mb-3">
                    <h5>Title</h5>
                    <p>{{ $task->title }}</p>
                </div>
                <div class="mb-3">
                    <h5>Description</h5>
                    <p>{{ $task->description }}</p>
                </div>
                <div class="mb-3">
                    <h5>Due Date</h5>
                    <p>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : 'Not specified' }}</p>
                </div>
                <div class="mb-3">
                    <h5>Status</h5>
                    <p>{{ $task->status }}</p>
                </div>
                <div class="mb-3">
                    <h5>Assigned Users</h5>
                    <ul>
                        @foreach($task->assignedUsers as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-3">
                    <h5>Attachments</h5>
                    @if($task->attachments->isNotEmpty())
                        @foreach($task->attachments as $attachment)
                            <a href="{{ asset('attachments/' . $attachment->file_path) }}" target="_blank">
                                <img src="{{ asset('attachments/' . $attachment->file_path) }}" alt="{{ $attachment->name }}" class="attachment-img">
                            </a>
                        @endforeach
                    @else
                        <p>No attachments</p>
                    @endif
                </div>
                <div class="mb-3">
                    <h5>Add Comment</h5>
                    <form action="{{ route('comment.store', $task) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div>
                    <h5>Comments</h5>
                    @foreach($task->comments as $comment)
                        <div class="comment">
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
