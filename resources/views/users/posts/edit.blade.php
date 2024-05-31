@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                Category <span class="text-secondary">(up to 3)</span>
            </label>

<!-- ???? -->
            @foreach($all_categories as $category)
                <div class="form-check form-check-inline">
                    @if(in_array($category->id, $selected_categories))
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>

                    @else
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-chech-input">
                    @endif

                    <label for="{{ $category->name }}" class="form-chech-label">{{ $category->name}}</label>
                </div>
            @endforeach

             <!-- Error -->
            @error('category')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
           <textarea name="description" id="description" class="form-control" placeholder="What's on your mind?">{{ old('description', $post->description) }}</textarea>

            <!-- Error -->
            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 row">
            <div class="col-6">
                <label for="image" class="form-label fw-bold">Image</label>
                <img src="{{ $post->image }}" alt="Post id" class="img-thumbnail w-100">
                <input type="file" name="image" id="image" class="form-control mt-1" aria-describedby="image-info">
                <div class="form-text" id="image-info">
                    <p class="mb-0">Acceptable formats are jpeg, jpg, png and gif only.</p>
                    <p class="mt-0">Maximum file size is 1048kb.</p>
                </div>

                <!-- Error -->
                @error('image')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-warning px-5">
            Save
        </button>
    </form>
@endsection