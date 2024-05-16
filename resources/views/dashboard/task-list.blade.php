<table id="task-list" class="table table-bordered table-striped dataTable dtr-inline text-center"
       role="grid" aria-describedby="example1_info">
    <thead>
    <tr role="row">
        <th width="250" class="sorting" tabindex="0" aria-controls="example1" aria-label="Rendering engine: activate to sort column descending">
            Title
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="Browser: activate to sort column ascending">
            Description
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="Platform(s): activate to sort column ascending">
            Due Date
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="Engine version: activate to sort column ascending">
            Status
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="CSS grade: activate to sort column ascending">
            Creator / Assigned
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="CSS grade: activate to sort column ascending">
            Action
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr role="row" class="even">
            <td>{{ $task->title }}</td>
            <td>{{ Str::limit($task->description,10) }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->status }}</td>
            <td>
                @if($task->assignedUsers->contains(auth()->user()->id))
                    <i class="fa fa-eye">assigned</i>
                @else
                    <i class="fa fa-users">creator</i>
                @endif
            </td>
            <td>
                <a href="{{ route('task.show', $task) }}" class="btn btn-sm btn-success">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('task.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('task.destroy', $task) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
