@extends('layouts.app')

@section('title','Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            @forelse($home_posts as $post)
                <div class="card mb-4">
                    <!-- titile -->
                    @include('users.posts.contents.title')
                    <!-- body comments, img...-->
                    @include('users.posts.contents.body')

                </div>
                
        <!-- If all post are empty, the text below will be shown -->
            @empty
                <div class="text-center">
                    <h2>Share photos</h2>
                    <p class="text-muted">When you share photos, they'll apper on your profile.</p>
                    <a href="{{ route('post.create')}}" class="text-decoratopn-none">Share your first photos.</a>
                </div>
            @endforelse
        </div>

        <div class="col-4">
            <!-- Profile over view -->
            <div class="row align-items-center mb-5 bg-white shadow rounded-3 py-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-md">

                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">{{Auth::user()->name }}
                    </a>
                    <p class="text-secondary mb-0">{{Auth::user()->email }}</p>
                </div>
            </div>


            <!-- SUGGESTIONS -->
            @if($suggested_users)
                <div class="row">
                    <div class="col-auto">
                        <p class="fw-bold text-secondary">Suggestions for you </p>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('suggestions') }}" class="fw-bold text-dark text-decoration-none">See all</a>
                    </div>
                </div>

                @foreach(array_slice($suggested_users, 0,5) as $user)
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show',$user->id) }}">
                            @if($user->avatar)
                            <img src="{{ $user->avatar}}" alt="{{ $user->name}}" class="rounded-circle avatar-sm">
                            @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                    </div>

                    <div class="col ps-0 truncate">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $user->name }}
                        </a>
                    </div>

                    <div class="col-auto">
                        <form action="{{ route('follow.store',$user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
@endsection
