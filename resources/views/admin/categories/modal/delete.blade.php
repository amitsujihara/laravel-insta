<div class="modal fade" id="delete-category-{{ $category->id }}">

    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h1 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-trash-can"></i> Delete Category
                </h1>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <p>Are you sure you want to delete   <strong>{{ $category->name }}</strong> category?</p>
                <p class="text-muted">This action will affect all the posts under this category. Posts without a category will fall under Uncategorized.</p>
            </div>
        
            <!-- Footer -->
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    
                    <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                </form>

            </div>
        </div>
        
    </div>
</div>