<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card card-lg my-5">
                <div class="card-body">
                    {{--  <form action="" method="POST">  --}}
                        <form>
                            <p>Please select your preferred report reciever:</p>
                            <div>
                              <input wire:click='reporTo' type="radio" id="contactChoice1"
                               name="contact" value="email" {{$reportTo? '':'checked'}}>
                              <label for="contactChoice1">Department</label>

                              <input wire:click='reporTo' type="radio" id="contactChoice2"
                               name="contact" value="phone" {{$reportTo? 'checked':''}}>
                              <label for="contactChoice2">Specific Employee</label>
                            </div>
                          </form>
                        @if ($reportTo)
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlTextarea1">Choose Employee</label>
                            <select class="custom-select">
                                <option selected disabled>Employee Name</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlTextarea1">Edit or Create Report</label>
                            <textarea id="exampleFormControlTextarea1" class="form-control"
                                placeholder="Write your report Here" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    {{--  </form>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
