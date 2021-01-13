@extends('admin.layout.layout-admin')
@section('content-backend')



    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">




        <div class="container">
            <h2>{{ __('site.slider') }}

                <button class="btn btn-warning add-btn" style="float: right" data-toggle="modal" data-target="#basicExampleModal">{{__('site.AddNewPicture')}}</button>
            </h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>{{__('site.Picture')}}</th>
                    <th style="width: 140px;" scope="col">{{__('site.Action')}}</th>

                </tr>
                </thead>
                <tbody>
                @foreach($gallaries as $key=>$row)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td><img style="width: 100px; height: 100px" src="{{asset($row->picture)}}" alt="picture"> </td>

                        <td>
                            <a href="{{route('gallery.edit', $row->id)}}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
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
                                    <form action="{{route('admin.delete.gallery', $row->id)}}" method="post">
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
                            <h5 class="modal-title" id="exampleModalLabel">Add New Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('gallery.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body pd-20">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" onchange="readURL(this);" class="custom-file-input" id="file" aria-describedby="inputGroupFileAddon01" name="picture" required>
                                            <label class="custom-file-label" for="inputGroupFile01">Choose Picture</label>
                                            <br>
                                            <br>
                                            <br>

                                        </div>
                                        <img id="one">
                                    </div>

                                </div><!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20">{{__('site.Add')}}</button>
                                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">{{__('site.Close')}}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{$gallaries->links("pagination::bootstrap-4")}}


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
