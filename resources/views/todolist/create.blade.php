@extends('layouts.app')
@push('head')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="text-center">Add New TODO LIST</div>
                <div class="card-body">
                    <form action="{{ url('todolist/store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" name="task" value="{{ old('task') }}">
                            @error('task')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>DeadLine</label>
                            <input type="datetime-local" class="form-control" name="deadline" value="{{ old('deadline') }}">
                            @error('task')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

