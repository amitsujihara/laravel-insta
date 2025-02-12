<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h1 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>delete Post
                </h1>
            </div>
<!-- Body -->
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="image-lg">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
<!-- Footer -->
            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy',$post) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

            </div>
        </div>
        
    </div>
</div>