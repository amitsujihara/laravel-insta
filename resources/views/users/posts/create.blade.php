@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                Category <span class="text-secondary">(up to 3)</span>
            </label>
<!-- ???? -->
            @foreach($all_categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id}}" class="form-chech-input"></input:type>
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
           <textarea name="description" id="description" class="form-control" placeholder="What's on your mind?">{{ old('description') }}</textarea>

            <!-- Error -->
            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <div class="form-text" id="image-info">
                <p class="mb-0">Acceptable formats are jpeg, jpg, png and gif only.</p>
                <p class="mt-0">Maximum file size is 1048kb.</p>
            </div>

            <!-- Error -->
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">
            Post
        </button>
    </form>

@endsection