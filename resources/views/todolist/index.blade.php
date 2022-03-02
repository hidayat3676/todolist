@extends('layouts.app')
@push('head')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <script type="text/javascript">
        function showDateInClientSideFormat(dValue, id) {
            let d = new Date()
            let n = d.getTimezoneOffset();
            let dateClientSide = new Date(dValue + n);
            let hour = dateClientSide.getHours();
            let suffix = hour >= 12 ? "PM" : "AM";
            hour = ((hour + 11) % 12 + 1) + ":" + dateClientSide.getMinutes() + " " + suffix;
            const deadline = hour + "  " + dateClientSide.getDate() + " " + getMonthName(dateClientSide.getMonth()) + " (" + dateClientSide.toTimeString().match(/\((.+)\)/)[1] + ")";
            document.getElementById('deadline' + id).textContent =  deadline;
        }

        function getMonthName(month) {
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            return monthNames[month];
        }
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="text-center">TODO LIST</div>
                <div class="card-body">
                    <a href="{{ url('todolist/create') }}" class="btn btn-primary">Add New Todo</a>
                    <table class="table table-bordered table-responsive" id="customer-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task</th>
                            <th>DeadLine</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($todoList as $list)
                            <tr>
                                <td>{{ $list->id }}</td>
                                <td>{{ $list->task }}</td>
                                <td id="deadline{{ $list->id }}" style="font-weight: bold;">
                                    <script>showDateInClientSideFormat("{{ $list->deadline }}", "{{ $list->id }}")</script>
                                </td>
                                <td>{{ $list->created_at }}</td>
                                <td><a href="{{ url('todolist/delete/' . $list->id) }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data Found!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $todoList->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

