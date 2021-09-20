<div>
    {{-- In work, do what you enjoy. --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card card-lg my-5">
                    <div class="card-body">
                        <h1 class="display-4 text-center">Login</h1>
                        <p>
                            Don't have an account yet?
                            <a class="underline-link" href="{{ route('register') }}">Sign up here</a>
                        </p>
                        {{--  <form action="" method="POST">  --}}
                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="inputGroupHoverLightEmail" class="input-label">Email</label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <input wire:model.defer='email' type="text" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" id="inputGroupHoverLightEmail"
                                        placeholder="mark@example.com" />
                                </div>
                            </div>
                            <!-- End Input Group -->

                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="password" class="input-label">Password </label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <input wire:model.defer='password' type="password" class="form-control @error('password') is-invalid @enderror"  value="{{ old('password') }}" id="password" />
                                </div>
                            </div>
                            <!-- End Input Group -->
                            <div class="form-group">
                                <button wire:click='login' type="button" class="btn btn-primary">Login</button>
                            </div>
                        {{--  </form>  --}}
                    </div>
                </div>
            </div>
        </div>
        <div wire:loading>
            @livewire('general.loader')
        </div>
    </div>


</div>
