@extends('layouts.admin')
@section('title')
    <h1>Kategori</h1>
@endsection
@section('content')
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
        <div class="table-responsive">
            <table class="table table-hover" id="example-category">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
@endsection

@push('add-on-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush
@push('add-on-script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example-category').DataTable({
                processing: true,
                serverSider: true,
                ajax : {
                    url: "{{ route('category.ajax') }}",
                    type: 'GET'
                },
                columns : [
                    {data: 'DT_RowIndex', name: 'DT_Row_Index' },
                    {data: 'name', name: 'name'}, 
                    {data: 'action', name: 'action'} ,
                ],
                order : [[0, 'asc']] 
            });
        } );
    </script>
@endpush