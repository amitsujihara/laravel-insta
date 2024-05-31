@if($post->trashed())
<!-- Unhide modal -->
    <div class="modal fade" id="unhide-post-{{ $post->id }}">

        <div class="modal-dialog">
            <div class="modal-content border-primary">
                <div class="modal-header border-primary">
                    <h1 class="h5 modal-title text-primary">
                        <i class="fa-solid fa-eye"></i> Unhide Post
                    </h1>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <p>Are you sure you want to unhide the post?</p>
                    <img src="{{ $post->image }}" alt="Post id {{ $post->id }}" class="image-lg">
                    <p>{{$post->description }}</p>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.unhide' ,$post->id) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <button class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-primary btn-sm">Unhide</button>
                    </form>

                </div>
            </div>
            
        </div>
    </div>

@else

<!-- Hide modal -->
    <div class="modal fade" id="hide-post-{{ $post->id }}">

        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h1 class="h5 modal-title text-danger">
                        <i class="fa-solid fa-eye-slash"></i> Hide Post
                    </h1>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <p>Are you sure you want to hide this post?</p>
                    <img src="{{ $post->image }}" alt="Post id {{ $post->id }}" class="image-lg">
                    <p>{{$post->description }}</p>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
@endif