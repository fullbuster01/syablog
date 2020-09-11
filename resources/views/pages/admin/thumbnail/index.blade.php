@extends('layouts.admin')
@section('title')
    <h1>Thumbnail</h1>
@endsection
@section('content')
        <a href="{{ route('thumbnail.create') }}" class="btn btn-primary mb-3">Tambah Thumbnail</a>
        <div class="table-responsive">
            <table class="table table-hover" id="example-thumb">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Post Title </th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($thumbnails as $thumbnail)
                    @role('author')
                    @if ( $thumbnail->post->id == $thumbnail->post_id && Auth::user()->id == $thumbnail->post->user_id )
                    <tr>
                        <td>{{ $loop->iteration + ($thumbnails->currentPage() * 10 - 10) }}</td>
                        <td>{{ $thumbnail->id }}</td>
                        <td>{{ $thumbnail->post->title }}</td>
                        <td><img src="{{ asset('storage/'.$thumbnail->s) }}" alt="thumbnail - s"></td>
                        <td>
                            
                            <form action="{{ route('thumbnail.destroy', $thumbnail->id) }}"method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @else
                    <tr>
                        <td>{{ $loop->iteration + ($thumbnails->currentPage() * 10 - 10) }}</td>
                        <td>{{ $thumbnail->id }}</td>
                        <td>{{ $thumbnail->post->title }}</td>
                        <td><img src="{{ asset('storage/'.$thumbnail->s) }}" alt="thumbnail s"></td>
                        <td>
                            
                            <form action="{{ route('thumbnail.destroy', $thumbnail->id) }}"method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endrole
                    @empty
                        <td colspan="5" class="text-center">Data Tidak ada </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    <div class="d-flex justify-content-center">
        {{ $thumbnails->links() }}
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
            $('#example-thumb').DataTable({
                processing: true,
                // serverSider: true,
                // ajax : {
                //     url: "{{ route('thumb.ajax') }}",
                //     type: 'GET'
                // },
                // columns : [
                //     {data: 'id', name: 'id'} ,
                //     {data: 'title', name: 'title'}, 
                //     {data: 'thumb', name: 'thumbnail'}, 
                //     {data: 'action', name: 'action'} ,
                // ],
                order : [[0, 'desc']] //ini untuk mengurutkan berdasarkan nama dari a-z
            });
        } );
    </script>
@endpush