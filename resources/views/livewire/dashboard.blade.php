<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container pt-10">
        <div >
            @livewire('inc.dash-nav')
        </div>

        @if ($varView == "")
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card card-lg my-5">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="card" id="headingTwo">
                                <a class="card-header card-btn btn-block collapsed" href="javascript:;"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Report Details

                                    <span class="card-btn-toggle">
                                        <span class="card-btn-toggle-default">
                                            <i class="tio-add"></i>
                                        </span>
                                        <span class="card-btn-toggle-active">
                                            <i class="tio-remove"></i>
                                        </span>
                                    </span>
                                </a>

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="text-muted mb-3">
                                            Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Vitae officia praesentium dicta voluptates
                                            molestiae quaerat minus inventore nisi velit sit vel,
                                            sed placeat laudantium nulla, quod, asperiores dolorem
                                            repudiandae nobis!
                                        </div>
                                        <div class="my-3">1. Comment from supervisor</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" id="headingTwo">
                                <a class="card-header card-btn btn-block collapsed" href="javascript:;"
                                    data-toggle="collapse" data-target="#collapse3" aria-expanded="false"
                                    aria-controls="collapse3">
                                    Report Details 2

                                    <span class="card-btn-toggle">
                                        <span class="card-btn-toggle-default">
                                            <i class="tio-add"></i>
                                        </span>
                                        <span class="card-btn-toggle-active">
                                            <i class="tio-remove"></i>
                                        </span>
                                    </span>
                                </a>

                                <div id="collapse3" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="text-muted mb-3">
                                            Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Vitae officia praesentium dicta voluptates
                                            molestiae quaerat minus inventore nisi velit sit vel,
                                            sed placeat laudantium nulla, quod, asperiores dolorem
                                            repudiandae nobis!
                                        </div>
                                        <div class="my-3">1. Comment from supervisor</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($varView == "create-report")
        @livewire('create-report', ['userType' => $designation->designation->name , 'dept' =>  $getDept->department->name ])
        @endif
    </div>

</div>
