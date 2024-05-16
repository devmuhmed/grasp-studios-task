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
                        <form action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.task-form')
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
