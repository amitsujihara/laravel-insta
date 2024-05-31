@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
<form action="{{ route('admin.categories.store')}}" method="post" enctype="multipart/form-data" class="row mb-4">
    @csrf
   <div class="col-5 d-flex">
        <input type="text" name="name" id="name" class="form-control d-inline" placeholder="Add a category..." value="{{ old('name') }}" autofocus>
        <!-- Error -->
        @error('name')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn btn-primary btn-md d-inline ms-2">
        +Add
        </button>
    </div>
</form>

<!-- TABLE -->
<div class="row">
<div class="col-7">
<table class="table table-hover align-middle bg-white border table-sm text-center">
    <thead class="small table-warning">
        <tr>
            <th>#</th>
            <th>NAME</th>
            <th>COUNT</th>
            <th>LAST UPDATED</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <!-- from Admin Categories Controller -->
        @forelse($all_categories as $category)
        <tr>
            <td>{{$category->id }}</td>
            <td class="fw-bold">{{$category->name }}</td>
            <!-- count : ?????? -->
            <td>{{$category->posts->count() }}</td>
            <td>{{$category->updated_at }}</td>
            <td>
                <button class="text-warning btn btn-outline-warning" data-bs-toggle="modal" data-bs-target = "#edit-category-{{ $category->id }}" title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <button class="text-danger btn btn-outline-danger" data-bs-toggle="modal" data-bs-target = "#delete-category-{{ $category->id }}" title="Delete">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </td>

            <!-- Include modal here -->
            @include('admin.categories.modal.edit')
            @include('admin.categories.modal.delete')
        </tr>

        @empty
        <tr>
            <td colspan="5" class="lead text-muted text-center">No Categories here.</td>
        </tr>
        @endforelse

        <!-- Uncategorized -->
        <tr>
            <td></td>
            <td>
                Uncategorized 
                <p class="x-small mb-0 text-secondary">Hidden posts are not included.</p>
            </td>
            <td>{{ $uncategorized_count}}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
</div>
</div>

@endsection