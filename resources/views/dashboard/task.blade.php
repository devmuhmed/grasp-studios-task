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
                                    <select class="form-control form-control-sm" id="status">
                                        @foreach($status as $key=>$item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
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
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                to 10 of 57 entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="example1_previous">
                                        <a
                                            href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"
                                            class="page-link">
                                            Previous
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item active">
                                        <a href="#" aria-controls="example1"
                                           data-dt-idx="1" tabindex="0"
                                           class="page-link">
                                            1
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item ">
                                        <a href="#" aria-controls="example1"
                                           data-dt-idx="2" tabindex="0"
                                           class="page-link">
                                            2
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item ">
                                        <a href="#" aria-controls="example1"
                                           data-dt-idx="3" tabindex="0"
                                           class="page-link">
                                            3
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item ">
                                        <a href="#" aria-controls="example1"
                                           data-dt-idx="4" tabindex="0"
                                           class="page-link">
                                            4
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item ">
                                        <a href="#" aria-controls="example1"
                                           data-dt-idx="5" tabindex="0"
                                           class="page-link">
                                            5
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item ">
                                        <a href="#" aria-controls="example1"
                                           data-dt-idx="6" tabindex="0"
                                           class="page-link">6
                                        </a>
                                    </li>
                                    <li class="paginate_button page-item next" id="example1_next">
                                        <a href="#"
                                           aria-controls="example1"
                                           data-dt-idx="7"
                                           tabindex="0"
                                           class="page-link">Next
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#status').on('change', function() {
                var selectedStatus = $(this).val();

                $.ajax({
                    url: "{{ route('tasks.filter') }}",
                    method: 'GET',
                    data: { status: selectedStatus },
                    success: function(response) {
                        $('#task-list').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush
