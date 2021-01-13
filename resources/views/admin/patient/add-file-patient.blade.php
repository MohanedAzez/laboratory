@extends('admin.layout.layout-admin')
@section('content-backend')


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">


        <div class="container">
            <h2>{{ __('site.addFile') }}

                <button class="btn btn-warning add-btn" style="float: right" data-toggle="modal" data-target="#basicExampleModal">{{ __('site.addFile') }}</button>
            </h2>


            @include('admin.error')


            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">{{__('site.Name')}}</th>
                    <th scope="col">{{__('site.state')}}</th>
                    <th scope="col">{{__('site.file')}}</th>
                    <th style="width: 140px;" scope="col">{{__('site.Action')}}</th>

                </tr>
                </thead>
                <tbody>

                @foreach($patient as $row)
                    <tr>
                        <td scope="row">{{$row->name}}</td>
                        <td>
                            @if($row->state == 2)
                                <span class="badge btn-success">{{__('site.stateDone')}}</span>
                            @else
                                <span class="badge btn-danger">{{__('site.stateWait')}}</span>
                            @endif

                        </td>
                        <td>

                            @if($row->file != '')

                                @if (pathinfo($row->file, PATHINFO_EXTENSION) == 'docx' || pathinfo($row->file, PATHINFO_EXTENSION) == 'pdf')
                                    <embed  src="{{asset($row->file)}}" width="100px" height="100px" />
                                    <a href="{{asset($row->file)}}" target="_blank" class="btn btn-sm btn-dark" title="show" ><i class="fa fa-eye"></i></a>

                                @else
                                    <a href="{{asset($row->file)}}" target="_blank"><img style="width: 100px; height: 100px" src="{{asset($row->file)}}" alt="picture"></a>
                                @endif

                            @endif

                        </td>

                        <td>
                            <a href="{{route('admin.patient.file.edit', $row->id)}}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                            <a href="" class="btn btn-sm btn-danger" title="delete" data-toggle="modal" data-target="#exampleModal{{$row->id}}" ><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Delete -->
                    <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{__('site.delete')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{__('site.sureDelete')}}
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('admin.patient.file.delete', $row->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">{{__('site.delete')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach


                </tbody>
            </table>




            <!-- Modal -->
            <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('site.addFile') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('patient.file.store')}}" enctype="multipart/form-data" >
                                @csrf

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('site.Name') }}<span class="tx-danger">*</span></label>
                                        <select name="name" class="custom-select" required>
                                            @foreach($patientName as $rowP)
                                                <option value="{{$rowP->id}}">{{$rowP->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <input type="file"  onchange="readURL(this);"  class="custom-file-input" aria-describedby="inputGroupFileAddon01" name="picture">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose Picture</label>

                                        <br>
                                        <br>
                                        <br>

                                    </div>
                                    <img id="one">


                                </div>


                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20">{{__('site.Add')}}</button>
                                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">{{__('site.Close')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{$patient->links("pagination::bootstrap-4")}}
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);

            }
        }
    </script>

@endsection

