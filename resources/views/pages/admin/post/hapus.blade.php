@extends('layouts.admin')
@section('title')
    <h1>Post yang sudah dihapus</h1>
@endsection
@section('content')
        <table class="table table-hover">
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
                    <tr>
                    <td>{{ $loop->iteration + ($posts->currentPage() * 10 - 10) }}</td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @foreach ($thumbnail as $item)
                        @if ($item->post_id == $post->id)
                            
                        <img src="{{ url('storage/'.$item->s) }}" alt="" class="img-fluid">
                        @endif
                        @endforeach
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <form action="{{ route('post.kill', $post->id) }}"method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('post.restore', $post->id) }}" class="btn btn-primary btn-sm">Restore</a>
                            <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endif
                @else
                <tr>
                    <td>{{ $loop->iteration + ($posts->currentPage() * 10 - 10) }}</td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @foreach ($thumbnail as $item)
                        @if ($item->post_id == $post->id)
                            
                        <img src="{{ url('storage/'.$item->s) }}" alt="" class="img-fluid">
                        @endif
                        @endforeach
                    </td>
                    <td>
                        {{-- @foreach ($post->user as $item)
                        {{ $item->name }}
                    @endforeach --}}
                    {{-- {{ $post->user->id }} --}}
                    @foreach ($user as $item)
                        
                    @if ($post->user_id == $item->id)
                        {{ $item->name }}
                    @endif
                    @endforeach
                    </td>
                    <td>
                        <form action="{{ route('post.kill', $post->id) }}"method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('post.restore', $post->id) }}" class="btn btn-primary btn-sm">Restore</a>
                            <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endrole
                @empty
                    <td colspan="4" class="text-center">Data Tidak ada </td>
                @endforelse
            </tbody>
        </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection