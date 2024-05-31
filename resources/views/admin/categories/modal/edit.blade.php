<div class="modal fade" id="edit-category-{{ $category->id }}">

    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h1 class="h5 modal-title">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Category
                </h1>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form action="{{route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data" class="row mb-3">
                    @csrf
                    @method('PATCH')
                        <input type="text" name="new_name" id="new_name" class="form-control" value="{{old('name', $category->name) }}" >
                        <!-- Error -->
                        @error('new_name')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
            </div>
        
            <!-- Footer -->
            <div class="modal-footer border-0">
                        <button class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-warning btn-sm text-dark">Update</button>
                </form>

            </div>
        </div>
        
    </div>
</div>