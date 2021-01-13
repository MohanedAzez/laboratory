<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="p-4 pt-5">
            <a href="#" class="img logo rounded-circle mb-5" style="background-image: url({{asset('assets/backend/images/logo.jpeg')}});">
            </a>
            <p style="text-align: center;margin-top: -20px;"><span style="color: red;font-weight: 700;">{{\Illuminate\Support\Facades\Auth::user()->name}}</span></p>

            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{__('site.Patient')}}</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu2">

                        <li>
                            <a href="{{route('admin.home')}}" class="active">{{ __('site.AddPatient') }}</a>
                        </li>


                        <li>
                            <a href="{{route('admin.patient.file')}}" class="active">{{ __('site.addFile') }}</a>
                        </li>

                    </ul>

                </li>

                <li>
                    <a href="{{route('gallaries')}}" class="active">{{ __('site.slider') }}</a>
                </li>


                <li>
                    <a href="{{route('news')}}" class="active">{{ __('site.news') }}</a>
                </li>


                <li>
                    <a href="{{route('staff')}}" class="active">{{ __('site.Staff') }}</a>
                </li>


                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{__('site.Language')}}</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">

                        <li>
                            <a href="{{ route('frontend_change_locale', 'en') }}">English</a>
                        </li>

                        <li>
                            <a href="{{ route('frontend_change_locale', 'ar') }}">عربي</a>
                        </li>

                    </ul>

                </li>



                <li>
                    <a href="{{route('admin.logout')}}" class="active">{{ __('site.logout') }}</a>
                </li>
            </ul>

            <div class="footer" style="display: none">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>

        </div>
    </nav>



