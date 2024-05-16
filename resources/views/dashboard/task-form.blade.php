@if(Route::is('task.edit'))
    <div class="row">
        <div class="col-6">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ $task->title }}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="due_date">Due Date</label>
            <input class="form-control" type="date" name="due_date" id="due_date" value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}">
            @error('due_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                @foreach($status as $key=>$item)
                    <option value="{{ $key }}" {{ $key == $task->status ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="assigned_users">Assigned</label>
            <select class="form-control" name="assigned_users[]" id="assigned_users" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->assignedUsers->contains($user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="attachment">Attachment</label>
            <input class="form-control" type="file" name="attachment" id="attachment" >
            @error('attachment')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
            <div class="col-6">
                <label for="attachment">Attachment</label>
                @if ($task->attachments)
                    @foreach($task->attachments as $attachment)
                        <div style="display: inline-block; margin: 5px auto">
                            <a href="{{ asset('attachments/' . $attachment->file_path) }}" target="_blank">
                                <img src="{{ asset('attachments/' . $attachment->file_path) }}" alt="image-{{$loop->iteration}}" style="max-width: 50px; max-height: 50px;">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div>No attachment</div>
                @endif
            </div>
    </div>

    <div class="col-12">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description">{{ $task->description ?? old('description') }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
@else
    <div class="row">
        <div class="col-6">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="due_date">Due Date</label>
            <input class="form-control" type="date" name="due_date" id="due_date" value="{{ old('due_date') }}">
            @error('due_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                @foreach($status as $key=>$item)
                    <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="user_id">Assigned</label>
            <select class="form-control" name="assigned_users[]" id="assigned_users" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="attachment">Attachment</label>
            <input class="form-control" type="file" name="attachment" id="attachment">
            @error('attachment')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
@endif
