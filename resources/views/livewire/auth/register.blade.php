<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card card-lg my-5">
                    <div class="card-body">
                        <h1 class="display-4 text-center">Register</h1>
                        <p>
                            Already has an account?
                            <a class="underline-link" href="{{ route('login') }}">Login</a>
                        </p>
                        {{--  <form action="" method="POST">  --}}
                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="department" class="input-label">Role</label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <select wire:model.defer='desgnationId' id="department" class="custom-select @error('desgnationId') is-invalid @enderror">
                                        <option selected disabled>Register As:</option>
                                        @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <!-- End Input Group -->
                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="register" class="input-label">Full name</label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <input wire:model.defer='name' type="text" class="form-control @error('name') is-invalid @enderror" id="register" value="{{ old('name') }}" placeholder="Mark Williams" />
                                </div>
                            </div>
                            <!-- End Input Group -->

                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="inputGroupHoverLightEmail" class="input-label">Email</label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <input wire:model.defer='email' type="text" class="form-control @error('email') is-invalid @enderror" id="inputGroupHoverLightEmail"
                                    value="{{ old('email') }}" required autocomplete="email"  placeholder="mark@example.com" />
                                </div>
                            </div>
                            <!-- End Input Group -->

                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="password" class="input-label">Password </label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <input wire:model.defer='password' type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" />
                                </div>
                            </div>
                            <!-- End Input Group -->

                            <!-- Input Group -->
                            <div class="form-group">
                                <label for="department" class="input-label">Department</label>

                                <div class="
                        input-group input-group-merge input-group-hover-light
                      ">
                                    <select wire:model.defer='departmentId' id="department" class="custom-select @error('departmentId') is-invalid @enderror" value="{{ old('departmentId') }}">
                                        <option selected disabled>
                                            Choose your department
                                        </option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- End Input Group -->
                            <div class="form-group">
                                <button wire:click='store'  type="button" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        {{--  </form>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
