@if($user->trashed())
<!-- Activate modal -->
    <div class="modal fade" id="activate-user-{{ $user->id }}">

        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header border-success">
                    <h1 class="h5 modal-title text-success">
                        <i class="fa-solid fa-user-check"></i>Activate User
                    </h1>
                </div>

    <!-- Body -->
                <div class="modal-body">
                    <p>Are you sure you want to activate <strong>{{ $user->name }}</strong>?</p>
                </div>

    <!-- Footer -->
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.users.activate' ,$user->id) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <button class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-success btn-sm">Activate</button>
                    </form>

                </div>
            </div>
            
        </div>
    </div>

@else

<!-- Deactivate modal -->
    <div class="modal fade" id="deactivate-user-{{ $user->id }}">

        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h1 class="h5 modal-title text-danger">
                        <i class="fa-solid fa-user-slash"></i>Deactivate User
                    </h1>
                </div>

    <!-- Body -->
                <div class="modal-body">
                    <p>Are you sure you want to deactivate <strong>{{ $user->name }}</strong>?</p>
                </div>

    <!-- Footer -->
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.users.deactivate', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
@endif