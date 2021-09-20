<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div wire:loading>
        @livewire('general.loader')
    </div>
    <div class="container pt-10">
        <div>
            @livewire('inc.dash-nav')
        </div>

        @if ($varView == "")
        <div class="row justify-content-center">
            <div class="col-lg-7">
                @if ($designation->designation->name == 'Supervisor')
                <div class="card card-lg my-5">
                    <div class="card-header">
                        <h2>Department Reports</h2>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @php
                            $a=1;
                            @endphp
                            @foreach ($depRpts as $depRpt)
                            <div class="card" id="headingTwo">
                                <a class="card-header card-btn btn-block collapsed" href="javascript:;"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Report {{ $a }}

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
                                            {{$depRpt->report->report}}
                                        </div>
                                        <div class="my-3">1. Comment : {{ $depRpt->report->comment }}</div>
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlTextarea1">Comment</label>
                                            <textarea wire:model.defer='comment' id="exampleFormControlTextarea1" class="form-control" placeholder="Write a comment" rows="4"></textarea>
                                        </div>
                                        <div>
                                            <ul>
                                                @foreach ($this->loadFiles($depRpt->report->id) as $item)
                                                   <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <button wire:click='comment({{ $depRpt->report->id  }})' type="button" class="btn btn-primary">
                                            Comment
                                        </button>
                                        <div class="w-full d-flex justify-content-between">
                                            <button wire:click='delete({{ $depRpt->report->id }})' type="button" class="btn btn-danger">
                                                Delete Report
                                            </button>
                                            <a wire:click='showEdit({{ $depRpt->report->id }})' href="#" class="btn btn-outline-info">Edit Report</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @php
                            $a++;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif( $designation->designation->name == 'Employee')
                <div class="card card-lg my-5">
                    <div class="card-header">
                        <h2>My Supervisor Report</h2>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @php
                            $a=1;
                            @endphp
                            @foreach ($sentToMes as $sentToMe)
                            <div class="card" id="headingTwo">
                                <a class="card-header card-btn btn-block collapsed" href="javascript:;"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Report {{ $a }}

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
                                            {{$sentToMe->report->report}}
                                        </div>
                                        <div class="my-3">1. Comment: {{ $sentToMe->report->comment }}</div>
                                        <div>
                                            <ul>
                                                @foreach ($this->loadFiles($sentToMe->report->id) as $item)
                                                   <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @php
                            $a++;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-7">
                <div class="card card-lg my-5">
                    <div class="card-header">
                        <h2>My Reports</h2>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @php
                            $a=1;
                            @endphp
                            @foreach ($myRpts as $myRpt)


                            <div class="card" id="headingTwo">
                                <a class="card-header card-btn btn-block collapsed" href="javascript:;"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Report {{ $a }}

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
                                            {{$myRpt->report}}
                                        </div>
                                        <div class="my-3">1. Comment : {{ $myRpt->comment }}</div>
                                        <div>
                                            <ul>
                                                @foreach ($this->loadFiles($myRpt->id) as $item)
                                                   <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        @if ($designation->designation->name == 'Supervisor')

                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlTextarea1">Comment</label>
                                            <textarea wire:model.defer='comment' id="exampleFormControlTextarea1" class="form-control" placeholder="Write a comment" rows="4"></textarea>
                                        </div>
                                        <button wire:click='comment({{ $myRpt->id  }})' type="button" class="btn btn-primary">
                                            Comment
                                        </button>
                                        <div class="w-full d-flex justify-content-between">
                                            <button wire:click='delete({{ $myRpt->id }})' type="button" class="btn btn-danger">
                                                Delete Report
                                            </button>
                                            <a wire:click='showEdit({{ $myRpt->id }})' href="#" class="btn btn-outline-info">Edit Report</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @php
                            $a++;
                            @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($varView == "create-report")
        @livewire('create-report', ['userType' => $designation->designation->name , 'dept' => $getDept->department->name
        ])
        @elseif($varView == "edit-report")
        @livewire('edit-report', ['id' => $reportIdE])
        @endif
    </div>

</div>
