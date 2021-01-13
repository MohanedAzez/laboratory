@extends('admin.layout.layout-admin')
@section('content-backend')


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">


        <div class="container">
            <h2>{{ __('site.edit') }}

            </h2>


            @include('admin.error')


            <form method="post" action="{{route('patient.file.update', $patInfo->id)}}" enctype="multipart/form-data" >
                @csrf

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('site.Name') }}<span class="tx-danger">*</span></label>
                        <select name="name" class="custom-select" required>
                            @foreach($patientName as $rowP)
                                <option @if($rowP->id == $patInfo->patient_id)  selected @endif value="{{$rowP->id}}">{{$rowP->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="custom-file">
                        <input type="hidden"  value="{{$patInfo->file}}" class="custom-file-input" aria-describedby="inputGroupFileAddon01" name="old_file">
                        <input type="file"  class="custom-file-input" aria-describedby="inputGroupFileAddon01" name="picture">
                        <label class="custom-file-label" for="inputGroupFile01">Choose Picture</label>


                    </div>


                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">{{__('site.edit')}}</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">{{__('site.Close')}}</button>
                </div>
            </form>




        </div>
    </div>


@endsection

