@extends('admin.layout.layout-admin')
@section('content-backend')


    <div id="content" class="p-4 p-md-5">




        <div class="container">
            <form method="post" action="{{route('gallery.update',$pic->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pd-20">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="hidden" value="{{$pic->picture}}"  class="custom-file-input"  aria-describedby="inputGroupFileAddon01" name="old_pic">
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
                    <button type="submit" class="btn btn-info pd-x-20">{{__('site.edit')}}</button>
                </div>

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
