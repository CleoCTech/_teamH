<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div  class="row">
        <div class="col-lg-8 d-flex justify-content-center">
            <a class="btn btn-primary" wire:click='showCreateRpt'>Create Report</a>
        </div>
        <div class="col-lg-4">
            <span class="card-title h5">{{ $user->name }}</span>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 d-flex justify-content-center">
            <span class="card-title h5">Department:</span>
            <a class="ml-4" href="">{{ $getDept->department->name }}</a>
        </div>
        <div class="col-lg-4">
            <span class="card-title h5">Role</span>
            <a href="">{{ $designation->designation->name }}</a>
        </div>
    </div>
</div>
