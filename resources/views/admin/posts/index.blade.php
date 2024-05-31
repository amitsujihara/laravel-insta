@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
<table class="table table-hover align-middle bg-white border">
    <thead class="small table-primary">
        <tr>
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <!-- from Admin PostsController -->
        @foreach($all_posts as $post)
        <tr>
            <td>{{$post->id }}</td>
            <td>
                <a href="{{ route('post.show', $post->id) }}">
                    <img src="{{ $post->image }}" alt="Post id {{ $post->id }}" class="image-lg">
                </a>
            </td>

            <td>
                @forelse($post->categoryPost as $category_post)
                 <span class="badge bg-secondary bg-opacity-50">{{$category_post->category->name }}</span>

                @empty
                    <div class="badge bg-dark text-wrap ">Uncategorized</div>
                @endforelse
            </td>

            <td>
                <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
            </td>

            <td>{{$post->created_at }}</td>

            <td>
                @if($post->trashed())
                    <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp; Hidden
                @else
                    <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
                @endif
            </td>

            <td>
                <div class="dropdown">
                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>

                    <div class="dropdown-menu">
                        @if($post->trashed())
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target = "#unhide-post-{{ $post->id }}">
                                <i class="fa-solid fa-eye"></i> Unhide Post{{ $post->id}}
                            </button>
                        @else
                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target = "#hide-post-{{ $post->id }}">
                                <i class="fa-solid fa-eye-slash"></i> Hide Post{{ $post->id}}
                            </button>
                        @endif
                    </div>
                </div>
                <!-- Include modal here -->
                @include('admin.posts.modal.status')

                
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

<!-- This page/link is for Pagination -->
{{ $all_posts->links() }}
@endsection