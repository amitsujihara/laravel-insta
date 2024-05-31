@extends('layouts.app')

@section('title','Suggestions')

@section('content')
<div class="row justify-content-center">
    <div class="col-5">
        <h3 class="text-start my-3 fw-bold">Suggested</h3>

        <!-- Suggested users -->
        @forelse($suggested_users as $user)
            <div class="row align-items-center mb-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show',$user->id) }}">
                        @if($user->avatar)
                        <img src="{{ $user->avatar}}" alt="{{ $user->name}}" class="rounded-circle avatar-md">
                        @else
                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>

                <div class="col ps-0 truncate">
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                        {{ $user->name }}
                    </a>

                    <p class="text-muted mb-0">{{ $user->email }}</p>
                    <!-- Need to modify here -->
                    <p class="text-muted xsmall">
                        @if($user->isFollowingMe())
                            Follows you
                        @elseif($user->followers->count() == 0)
                            No followers yet.
                        @else
                            {{ $user->followers->count()}}
                            {{ $user->followers->count() == 1 ? 'follower': 'followers'}}
                        @endif
                    </p>
                </div>

                <div class="col-auto">
                    <form action="{{ route('follow.store',$user->id) }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="border-0 btn btn-primary btn-sm">Follow</button>
                    </form>
                </div>
            </div>

        @empty
            <p class="text-muted">No followers yet.</p>
        @endforelse


    </div>
</div>
@endsection