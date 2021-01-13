@extends('admin.layout.layout-admin')
@section('content-backend')


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">


        <div class="container">
            <h2>{{ __('site.AddPatient') }}

                <button class="btn btn-warning add-btn" style="float: right" data-toggle="modal" data-target="#basicExampleModal">{{ __('site.AddNewPatient') }}</button>
            </h2>


            @include('admin.error')


            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">{{__('site.Name')}}</th>
                    <th scope="col">{{__('site.Email')}}</th>
                    <th scope="col">{{__('site.Age')}}</th>
                    <th scope="col">{{__('site.Gender')}}</th>
                    <th style="width: 140px;" scope="col">{{__('site.Action')}}</th>

                </tr>
                </thead>
                <tbody>

                @foreach($patient as $row)
                    <tr>
                        <td scope="row">{{$row->name}}</td>
                        <td>{{$row->email}} </td>
                        <td>{{$row->age}}</td>
                        <td>{{$row->gender}} </td>

                        <td>
                            <a href="{{route('admin.patient.edit', $row->id)}}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
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
                                    <form action="{{route('admin.patient.delete', $row->id)}}" method="post">
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
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('site.AddNewPatient') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('patient.store')}}" >
                                @csrf

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('site.Name') }}<span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('site.Name') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('site.Email') }}<span class="tx-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('site.Email') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('site.Password') }}<span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control" name="password" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('site.Password') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('site.Age') }}<span class="tx-danger">*</span></label>
                                        <input type="number" class="form-control" name="age" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('site.Age') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <label for="exampleInputEmail1">{{ __('site.Gender') }}<span class="tx-danger">*</span></label>

                                    <select class="custom-select" required name="gender" >
                                            <option value="Male">{{__('site.male')}}</option>
                                            <option value="Female">{{__('site.female')}}</option>

                                        </select>
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


@endsection

