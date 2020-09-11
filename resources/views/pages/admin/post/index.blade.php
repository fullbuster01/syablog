@extends('layouts.admin')
@section('title')
    <h1>Post</h1>
@endsection
@section('content')
        <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Tambah Post</a>
        <div class="table-reponsive">
            <table class="table table-hover" id="example-post">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Thumbnail</th>
                    <th>Penulis</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    @role('author')
                    @if (Auth::user()->id == $post->user->id)
                    <tr class="py-1">
                        <td>{{ $loop->iteration + ($posts->currentPage() * 10 - 10) }}</td>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            @foreach ($post->thumbnail as $item)
                            <img src="{{ url('storage/'.$item->s) }}" alt="" class="img-fluid">
                            @endforeach
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            
                            <form action="{{ route('post.destroy', $post->id) }}"method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @else
                    <tr class="py-1">
                        <td>{{ $loop->iteration + ($posts->currentPage() * 10 - 10) }}</td>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            @foreach ($post->thumbnail as $item)
                            <img src="{{ url('storage/'.$item->s) }}" alt="" class="img-fluid">
                            @endforeach
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            
                            <form action="{{ route('post.destroy', $post->id) }}"method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endrole
                    @empty
                        <td colspan="6" class="text-center">Data Tidak ada </td>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
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
            $('#example-post').DataTable({
                processing: true,
                // serverSider: true,
                // ajax : {
                //     url: "{{ route('post.ajax') }}",
                //     type: 'GET'
                // },
                // columns : [
                //     {data: 'id', name: 'id'} ,
                //     {data: 'title', name: 'title'}, 
                //     {data: 'category', name: 'category_name'} ,
                //     {data: 'thumbnail', name: 'thumbnail'}, 
                //     {data: 'user', name: 'user'}, 
                //     {data: 'action', name: 'action'} ,
                // ],
                order : [[0, 'desc']] //ini untuk mengurutkan berdasarkan nama dari a-z
            });
        } );
    </script>
@endpush