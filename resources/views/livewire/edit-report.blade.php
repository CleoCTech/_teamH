<div>
    {{-- In work, do what you enjoy. --}}
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
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlTextarea1">Create Report</label>
                            <textarea wire:model.defer='report' id="exampleFormControlTextarea1" class="form-control"
                                placeholder="" rows="4" ></textarea>
                        </div>
                        <div class="form-group">
                            <button wire:click='store' type="button" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    {{--  </form>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
