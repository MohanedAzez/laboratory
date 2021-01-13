@extends('admin.layout.layout-admin')
@section('content-backend')

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">




        <div class="container">
            <h2>{{__('site.Staff')}}
                <button class="btn btn-warning add-btn" style="float: right" data-toggle="modal" data-target="#basicExampleModal">{{__('site.Add')}}</button>
            </h2>

            @include('admin.error')


            <table class="table table-striped">
                <thead>
                <tr>

                    <th scope="col">{{__('site.Name')}}</th>
                    <th scope="col">{{__('site.Picture')}}</th>
                    <th scope="col">{{__('site.specialization')}}</th>
                    <th style="width: 160px;" scope="col">{{__('site.Action')}}</th>

                </tr>
                </thead>
                <tbody>
                @foreach($staff as $key=>$row)
                    <tr>

                        <td>{{$row->name}} </td>
                        <td> <img height="50px" width="50px" src="{{URL::to($row->picture) }}"> </td>
                        <td>{{$row->specialization}} </td>
                        <td>
                            <a href="{{route('admin.staff.edit', $row->id)}}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                            <a href="" class="btn btn-sm btn-danger" title="delete" data-toggle="modal" data-target="#exampleModal{{$row->id}}" ><i class="fa fa-trash"></i></a>

                    </tr>


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
                                    <form action="{{route('admin.staff.delete', $row->id)}}" method="post">
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
                 aria-hidden="true" style="text-align: right">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('site.addNews')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('staff.store')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__('site.Name')}} <span class="tx-danger">*</span></label>
                                            <input type="text" style="text-align: right" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__('site.tittle')}}" required>
                                        </div>
                                    </div>


                                </div>

                                <div class="row" style="margin-top: 20px">
                                    <div class="col-lg-12">

                                        <div class="custom-file"><span class="tx-danger">*</span>
                                            <input type="file" onchange="readURL(this);" class="custom-file-input" id="file" aria-describedby="inputGroupFileAddon01" name="img">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose</label>
                                        </div>
                                        <img id="one">
                                    </div><!-- col-4 -->
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea3">{{__('site.specialization')}} <span class="tx-danger">*</span></label>
                                    <textarea class="form-control" style="text-align: right" name="spec" id="exampleFormControlTextarea3" rows="3"></textarea>
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
            {{$staff->links("pagination::bootstrap-4")}}
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection


