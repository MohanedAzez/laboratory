<!doctype html>
<html lang="en">
<head>
    <title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">



    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/css/style.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    @if(config('app.locale') == 'ar')

        <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/css/style-rtl.css') }}">

    @endif

</head>
<body>


@include('admin.main.header-navbar')



@yield('content-backend')

</div>



<script src="{{asset('assets/backend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/backend/js/popper.js')}}"></script>
<script src="{{asset('assets/backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/js/main.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type', 'info')}}";
    switch (type){
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }

    @endif
</script>

<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("action");
        swal({
            title: "Are you Want to delete?",
            text: "It Will Never Show Again",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });
</script>

</body>
</html>
