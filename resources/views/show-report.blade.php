@extends('layouts.app', ['slot' => ""])

@section('content')
<div class="container pt-10">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card card-lg my-5">
                <div class="card-header">
                    <h2>Report Details</h2>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="card" id="headingTwo">
                            <div id="collapseTwo" class="" aria-labelledby=""
                            data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>
                                       {{ $data->report }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
