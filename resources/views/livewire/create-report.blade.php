<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div wire:loading>
        @livewire('general.loader')
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card card-lg my-5">
                <div class="card-body">
                    {{--  <form action="" method="POST">  --}}
                        <div class="form-group">
                            <button wire:click='back' type="button" class="btn btn-primary">
                                back
                            </button>
                        </div>
                        @if ($userType == 'Supervisor')
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
                            <select wire:model.defer='userId' class="custom-select">
                                <option selected disabled>Employee Name</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->user->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @endif


                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlTextarea1">Create Report</label>
                            <textarea wire:model.defer='report' id="exampleFormControlTextarea1" class="form-control"
                                placeholder="Write your report Here" rows="4"></textarea>
                        </div>
                        <h4 class="text-blue-400 " style="margin-top: 1rem;">Add Files (Optional)
                            <span
                                class="svg-icon svg-icon-4 ">
                                <i class="bi bi-paperclip text-blue-400"></i>
                            </span>
                        </h4>
                        <div  class="row">

                            <div wire:ignore class="col-lg-6 col-md-12 col-sm-12">
                                <input type="file" name="paperFile"  id="test" multiple>
                                <script type="text/javascript">
                                    const inputElement = document.querySelector('input[id="test"]');
                                    const pond = FilePond.create( inputElement );
                                    FilePond.setOptions({
                                        server:{
                                            url: '/upload',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            }
                                        }
                                    });
                                </script>
                                {{-- <div class="custom-file">
                                    <input type="file" name="paperFile" class="custom-file-input" id="uploadfiles" />
                                </div> --}}
                            </div>

                        </div>
                        <div class="form-group">
                            <button wire:click='store' type="button" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    {{--  </form>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @section('scripts')
<script type="text/javascript">
    const inputElement = document.querySelector('input[id="test"]');
    const pond = FilePond.create( inputElement );
    FilePond.setOptions({
        server:{
            url: '/upload',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>
@endsection --}}
