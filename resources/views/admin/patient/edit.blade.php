@extends('admin.layout.layout-admin')
@section('content-backend')


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">


        <div class="container">
            <h2>{{ __('site.editP') }}

            </h2>


            @include('admin.error')


            <form method="post" action="{{route('patient.update',$patInfo->id )}}" >
                @csrf

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('site.Name') }}<span class="tx-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$patInfo->name}}" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('site.Email') }}<span class="tx-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$patInfo->email}}" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('site.Password') }}<span class="tx-danger"></span></label>
                        <input type="text" class="form-control" name="password" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__('site.Password')}}">
                        <input type="hidden" class="form-control" name="old_password" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$patInfo->password}}" required>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('site.Age') }}<span class="tx-danger">*</span></label>
                        <input type="number" class="form-control" name="age" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$patInfo->age}}" required>
                    </div>
                </div>

                <div class="col-md-12">

                    <label for="exampleInputEmail1">{{ __('site.Gender') }}<span class="tx-danger">*</span></label>

                    <select class="custom-select" required name="gender" >
                        <option @if($patInfo->gender == "Male") selected  @endif value="Male">{{__('site.male')}}</option>
                        <option @if($patInfo->gender == "Female") selected  @endif value="Female">{{__('site.female')}}</option>

                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">{{__('site.edit')}}</button>
                </div>
            </form>



        </div>
    </div>


@endsection

