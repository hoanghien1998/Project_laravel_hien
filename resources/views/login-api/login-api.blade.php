@extends('login-api.layouts.index')

@section('content')

    <div class="container">

        <div class="row" >

            <div class="col-md-4 login-sec" style="visibility: hidden">
                <h2 class="text-center">Login Now</h2>
                @if (count($errors) >0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger"> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session('status'))
                    <ul>
                        <li class="text-danger"> {{ session('status') }}</li>
                    </ul>
                @endif
                <form method="post" id="loginFr" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                        <input type="text" class="form-control" placeholder="" name="email" id="inEmail">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                        <input type="password" class="form-control" placeholder="" name="password" id="inPass">
                    </div>


                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                            <small>Remember Me</small>
                        </label>
                        <button id="btnLogin" type="submit" value="login" class="btn btn-login float-right">Submit
                        </button>
                    </div>

                </form>
                <div class="copy-text">Created with <i class="fa fa-heart"></i> by <a href="http://grafreez.com">Grafreez.com</a>
                </div>
            </div>

            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid"
                                 src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid"
                                 src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-md-4 profile" style="visibility: hidden">
                <h1>Your Profile</h1>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Name</label>
                        <input type="text" class="form-control" placeholder="" name="name" id="name">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                        <input type="text" class="form-control" placeholder="" name="email" id="email">

                    </div>
                </form>
            </div>

        </div>

        <div class="row">
            <button type="button" class="btn btn-success" id="btnPro" style="visibility: hidden">Your Profile</button>
            <button type="button" class="btn btn-danger" id="btnLogout" style="visibility: hidden">Logout</button>
            <button type="button" class="btn btn-success" id="btnLogin" style="visibility: hidden">Login</button>
        </div>
@endsection

@section('script')
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">

                    $(window).on('load', function(){
                        const url = "http://proj1-web.service.docker/api/auth/user-profile";
                        const cookie = getCookie('access_token');
                        const token = "Bearer " +  cookie;

                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'json',
                            contentType: "application/json",
                            headers: {"Authorization": token}
                        }).done(function(response){ //

                            $(".profile").css("visibility","visible");
                            $("#btnLogout").css("visibility","visible");
                            $("#name").val(response['name']);
                            $("#email").val(response['email']);

                        }).fail(function() {
                            $(".login-sec").css("visibility","visible");
                        });
                    });

                    $(function () {
                        $("#btnPro").click(function(){
                            $(".profile").css("visibility","visible");
                            $("#btnLogout").css("visibility","visible");
                            $("#btnPro").css("visibility","hidden");

                            const url = "http://proj1-web.service.docker/api/auth/user-profile";
                            const cookie = getCookie('access_token');
                            const token = "Bearer " +  cookie;

                            $.ajax({
                                url: url,
                                type: 'GET',
                                dataType: 'json',
                                contentType: "application/json",
                                headers: {"Authorization": token}
                            }).done(function(response){ //

                                console.log(response['name']);
                                $("#name").val(response['name']);
                                $("#email").val(response['email']);

                            });
                        });

                        $("#loginFr").submit(function(event){

                            event.preventDefault(); //prevent default action
                            const url = "http://proj1-web.service.docker/api/auth/login";

                            var form_data = new FormData(this); //Creates new FormData object

                            $.ajax({
                                url : url,
                                type: 'POST',
                                data : form_data,
                                contentType: false,
                                cache: false,
                                processData:false
                            }).done(function (response){

                                var token = response['access_token'];
                                setCookie('access_token', token, 1);
                                $("#btnPro").css("visibility","visible");
                                $(".login-sec").css("visibility","hidden");

                            });
                        });

                        $("#btnLogout").click(function () {

                            var cookie = getCookie('access_token');
                            var token = "Bearer " +  cookie;


                            $(".login-sec").css("visibility","visible");
                            $(".profile").css("visibility","hidden");
                            $("#btnLogout").css("visibility","hidden");
                            $("#inEmail").val("");
                            $("#inPass").val("");

                            const url = "http://proj1-web.service.docker/api/auth/logout";

                            $.ajax({
                                url : url,
                                type: 'POST',
                                headers: {"Authorization": token},
                                contentType: false,
                                cache: false,
                                processData:false
                            }).done(function (response){ //

                                alert(response['message']);

                            });

                            deleteCookie('access_token');
                        })
                    });
                    function getCookie(name) {
                        const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
                        return v ? v[2] : null;
                    }
                    function setCookie(name, value, days) {
                        const d = new Date;
                        d.setTime(d.getTime() + 24*60*60*1000*days);
                        document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
                    }
                    function deleteCookie(name) { setCookie(name, '', -1); }
                </script>
@endsection


