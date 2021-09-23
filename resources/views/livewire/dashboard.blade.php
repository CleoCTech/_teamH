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
                                    <a href="{{ route('generate-report',[$depRpt->report->id]) }}" class="btn btn-outline-info">Export to PDF</a>
                                    <div class="card-body">
                                        <div class="text-muted mb-3">
                                            {{$depRpt->report->report}} <span class="timestamp-right">{{ $depRpt->report->created_at }}</span>
                                        </div>
                                        <div class="text-muted mb-3">
                                            Owner: <span class="timestamp-right">{{ $depRpt->report->user->name }}</span>
                                        </div>
                                        @foreach ($this->loadComments($depRpt->report->id) as $item)
                                        <div class="my-3"> Comment : {{ $item->comment }}
                                            <span class="timestamp-right" >{{ $item->created_at }}</span>
                                        </div>
                                        @endforeach

                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlTextarea1">Comment</label>
                                            <textarea wire:model.defer='comment' id="exampleFormControlTextarea1" class="form-control" placeholder="Write a comment" rows="4"></textarea>
                                        </div>
                                        <div>
                                            <ul>
                                                @foreach ($this->loadFiles($depRpt->report->id) as $item)
                                                   <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a>
                                                    <span wire:click="dropFile('{{ $item->id }}', '{{ $item->folder}}', '{{$item->filename }}')"><i class="fas fa-trash-alt icon-hover"></i></span>
                                                    </li>
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

                                        <div class="form-group pt-lg-5 outline-info" x-data="{}">
                                            <label class="input-label" for="exampleFormControlTextarea1">Merge Report To</label>
                                            <select wire:change="merge($event.target.value, {{ $depRpt->report->id }})" class="custom-select">
                                                <option selected>Category</option>
                                                @foreach ($mergeCategories as $mergeCategory)
                                                <option value="{{ $mergeCategory->id }}">{{ $mergeCategory->name }}</option>
                                                @endforeach
                                            </select>
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
                                    <a href="{{ route('generate-report',[$sentToMe->report->id]) }}" class="btn btn-outline-info">Export to PDF</a>
                                    <div class="card-body">
                                        <div class="text-muted mb-3">
                                            {{$sentToMe->report->report}} <span class="timestamp-right" >{{ $sentToMe->report->created_at }}</span>
                                        </div>
                                        @foreach ($this->loadComments($sentToMe->report->id) as $item)
                                        <div class="my-3"> Comment : {{ $item->comment }}
                                            <span class="timestamp-right" >{{ $item->created_at }}</span>
                                        </div>
                                        @endforeach
                                        <div>
                                            <ul>
                                                @foreach ($this->loadFiles($sentToMe->report->id) as $item)
                                                   <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a>
                                                    <span wire:click="dropFile('{{ $item->id }}', '{{ $item->folder}}', '{{$item->filename }}')"><i class="fas fa-trash-alt icon-hover"></i></span>
                                                  </li>
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
                                    <a href="{{ route('generate-report',[$myRpt->id]) }}" class="btn btn-outline-info">Export to PDF</a>
                                    <div class="card-body">
                                        <div class="text-muted mb-3">
                                            {{$myRpt->report}} <span class="timestamp-right" >{{ $myRpt->created_at }}</span>
                                        </div>
                                        @foreach ($this->loadComments($myRpt->id) as $item)
                                        <div class="my-3"> Comment : {{ $item->comment }}
                                            <span class="timestamp-right" >{{ $item->created_at }}</span>
                                        </div>
                                        @endforeach
                                        <div>
                                            <ul>
                                                @foreach ($this->loadFiles($myRpt->id) as $item)
                                                   <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a>
                                                    <span wire:click="dropFile('{{ $item->id }}', '{{ $item->folder}}', '{{$item->filename }}')"><i class="fas fa-trash-alt icon-hover"></i></span>
                                                   </li>
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

                                        <div class="form-group pt-lg-5 outline-info" x-data="{}">
                                            <label class="input-label" for="exampleFormControlTextarea1">Merge Report To</label>
                                            <select wire:change="merge($event.target.value)" class="custom-select">
                                                <option selected>Category</option>
                                                @foreach ($mergeCategories as $mergeCategory)
                                                <option value="{{ $mergeCategory->id }}">{{ $mergeCategory->name }}</option>
                                                @endforeach
                                            </select>
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

            @if ($designation->designation->name == 'Supervisor')

                @foreach ($mergeCategories as $item)
                <div class="col-lg-7">
                    <div class="card card-lg my-5">
                        <div class="card-header">
                            <h2>{{ $item->name }} Reports</h2>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                @php
                                $a=1;
                                @endphp
                                @foreach ($this->merged( $item->id ) as $myRpt)


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
                                        <a href="{{ route('generate-report',[$myRpt->report->id]) }}" class="btn btn-outline-info">Export to PDF</a>
                                        <div class="card-body">
                                            <div class="text-muted mb-3">
                                                {{$myRpt->report->report}} <span class="timestamp-right" >{{ $myRpt->report->created_at }}</span>
                                            </div>
                                            <div class="text-muted mb-3">
                                                Owner: <span class="timestamp-right">{{ $myRpt->report->user->name }}</span>
                                            </div>
                                            @foreach ($this->loadComments($myRpt->report->id) as $item)
                                            <div class="my-3"> Comment : {{ $item->comment }}
                                                <span class="timestamp-right" >{{ $item->created_at }}</span>
                                            </div>
                                            @endforeach
                                            <div>
                                                <ul>
                                                    @foreach ($this->loadFiles($myRpt->report->id) as $item)
                                                       <li> <a wire:click="getDownload('{{$item->folder}}/{{$item->filename}}')" class="underline-link" href="#">{{ $item->filename }}</a>
                                                        <span wire:click="dropFile('{{ $item->id }}', '{{ $item->folder}}', '{{$item->filename }}')"><i class="fas fa-trash-alt icon-hover"></i></span>
                                                       </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                            @if ($designation->designation->name == 'Supervisor')

                                            <div class="form-group">
                                                <label class="input-label" for="exampleFormControlTextarea1">Comment</label>
                                                <textarea wire:model.defer='comment' id="exampleFormControlTextarea1" class="form-control" placeholder="Write a comment" rows="4"></textarea>
                                            </div>
                                            <button wire:click='comment({{ $myRpt->report->id  }})' type="button" class="btn btn-primary">
                                                Comment
                                            </button>
                                            <div class="w-full d-flex justify-content-between">
                                                <button wire:click='delete({{ $myRpt->report->id }})' type="button" class="btn btn-danger">
                                                    Delete Report
                                                </button>
                                                <a wire:click='showEdit({{ $myRpt->report->id }})' href="#" class="btn btn-outline-info">Edit Report</a>
                                            </div>

                                            <div class="form-group pt-lg-5 outline-info" x-data="{}">
                                                <a wire:click="unmerge('{{ $myRpt->id }}')" href="#" class="btn btn-outline-info">Unmerge</a>
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
                @endforeach

            @endif
        </div>
        @elseif($varView == "create-report")
        @livewire('create-report', ['userType' => $designation->designation->name , 'dept' => $getDept->department->name
        ])
        @elseif($varView == "edit-report")
        @livewire('edit-report', ['id' => $reportIdE])
        @endif
    </div>

    <style>
        .icon-hover:hover{
            color:red;
        }
        .timestamp-right{
            float: right;
        }
    </style>
</div>
