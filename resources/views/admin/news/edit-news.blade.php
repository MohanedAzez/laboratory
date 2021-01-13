@extends('admin.layout.layout-admin')
@section('content-backend')

    <div id="content" class="p-4 p-md-5">




        <div class="container">

           @include('admin.error')

            <form method="post" action="{{route('news.update', $news->id)}}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('site.tittle')}} <span class="tx-danger">*</span></label>
                            <input type="text" style="text-align: right" class="form-control" name="tittle_news" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$news->tittle}}" required>
                        </div>
                    </div>


                </div>

                <div class="row" style="margin-top: 20px">
                    <div class="col-lg-12">

                        <div class="custom-file"><span class="tx-danger">*</span>
                            <input type="hidden" value="{{$news->picture}}"  class="custom-file-input"  aria-describedby="inputGroupFileAddon01" name="old_pic">

                            <input type="file" onchange="readURL(this);" class="custom-file-input" id="file" aria-describedby="inputGroupFileAddon01" name="img_news">
                            <label class="custom-file-label" for="inputGroupFile01">Choose</label>
                        </div>
                        <img id="one">
                    </div><!-- col-4 -->
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea3">{{__('site.desc')}} <span class="tx-danger">*</span></label>
                    <textarea class="form-control" style="text-align: right" name="details_news" id="exampleFormControlTextarea3" rows="3">{{$news->desc}}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">{{__('site.edit')}}</button>                </div>

            </form>

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
