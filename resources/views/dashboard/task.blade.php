@extends('layout')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Task</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dt-buttons btn-group flex-wrap">
                                <label for="status">
                                    Status
                                    <form action="{{ route('task.index') }}" method="get">
                                        <select class="form-action form-select-lg mb-3" id="status" name="status" onchange="this.form.submit();">
                                            @foreach($status as $key=>$item)
                                                <option value="{{$key}}" {{ request()->get('status') == $key ? 'selected' : '' }}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter">
                                <a class="btn btn-info" type="button" href="{{ route('task.create') }}">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @include('dashboard.task-list')
                        </div>
                    </div>
                    <div class="row">
                        {{ $tasks?->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
