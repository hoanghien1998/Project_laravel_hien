@extends('login-api.layouts.index')

@section('content')

    <div class="container">

        <div class="row">

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
                        <button id="btnLogin" type="submit" value="login" class="btn btn-login float-right">Login</button>
                    </div>

                    <div class="form-group">
                        <label style="color: #8b0000">Create an account if you do not have an account??</label>
                        <button id="btnRegister" type="submit" value="register" class="btn btn-login float-right">Register</button>
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

        <div class="row">
            <div class="col-md-6 profile" style="visibility: hidden">
                <h1 style="text-align: center; margin-top: 5px">Your Profile</h1>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">First name</label>
                            <input type="text" class="form-control" placeholder="" name="first_name" id="first_name">

                        </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-uppercase">Last name</label>
                                <input type="text" class="form-control" placeholder="" name="last_name" id="last_name">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-uppercase">Phone number</label>
                                <input type="text" class="form-control" placeholder="" name="phone" id="phone">

                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-uppercase">Birthday</label>
                                <input type="text" class="form-control" placeholder="" name="birthday" id="birthday">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                                <input type="text" class="form-control" placeholder="" name="email" id="email">

                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-uppercase">Gender</label>
                                <input type="text" class="form-control" placeholder="" name="gender" id="gender">

                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="col-md-6 centered-form" style="visibility: hidden">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align: center">Please sign up</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" role="form" id="registerFrm">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="firstname" id="firstname" class="form-control input-sm" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Phone number">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="gender" id="gender" class="form-control input-sm" placeholder="Male or female">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="date" name="birthday" id="birthday" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Register" class="btn btn-info btn-block" id="btnRegister">

                            </form>
                        </div>
                </div>
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

                $(window).on('load', function () {
                    const url = "http://hien-web.service.docker/api/auth/user-profile";
                    const cookie = getCookie('access_token');
                    const token = "Bearer " + cookie;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json",
                        headers: {"Authorization": token}
                    }).done(function (response) { //

                        $(".profile").css("visibility", "visible");
                        $("#btnLogout").css("visibility", "visible");

                        $("#first_name").val(response['firstname']);
                        $("#last_name").val(response['lastname']);
                        $("#phone").val(response['phone']);
                        $("#birthday").val(response['birthday']);
                        $("#gender").val(response['gender']);
                        $("#email").val(response['email']);

                    }).fail(function () {
                        $(".login-sec").css("visibility", "visible");
                    });
                });

                $(function () {
                    $("#btnPro").click(function () {
                        $(".profile").css("visibility", "visible");
                        $("#btnLogout").css("visibility", "visible");
                        $("#btnPro").css("visibility", "hidden");

                        const url = "http://hien-web.service.docker/api/auth/user-profile";
                        const cookie = getCookie('access_token');
                        const token = "Bearer " + cookie;

                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'json',
                            contentType: "application/json",
                            headers: {"Authorization": token}
                        }).done(function (response) { //

                            console.log(response['']);
                            $("#first_name").val(response['firstname']);
                            $("#last_name").val(response['lastname']);
                            $("#phone").val(response['phone']);
                            $("#birthday").val(response['birthday']);
                            $("#gender").val(response['gender']);
                            $("#email").val(response['email']);

                        });
                    });

                    $('#registerFrm').submit(function (event){
                        event.preventDefault();
                        const url ="http://hien-web.service.docker/api/auth/register";

                        var request_method = $(this).attr("method");
                        var form_data = new FormData(this);

                        $.ajax({
                            url: url,
                            type: request_method,
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false
                        }).done(function (response) {
                            alert(response['message']);
                            $(".login-sec").css("visibility", "visible");
                            $(".centered-form").css("visibility", "hidden");

                        });
                    });

                    $("#btnRegister").click( function (){

                    });

                    $("#loginFr").submit(function (event) {

                        event.preventDefault(); //prevent default action
                        const url = "http://hien-web.service.docker/api/auth/login";

                        var form_data = new FormData(this); //Creates new FormData object

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false
                        }).done(function (response) {

                            var token = response['access_token'];
                            setCookie('access_token', token, 1);
                            $("#btnPro").css("visibility", "visible");
                            $(".login-sec").css("visibility", "hidden");

                        }).fail(function () {
                            $(".centered-form").css("visibility", "visible");
                            $(".login-sec").css("visibility", "hidden");
                        });
                    });

                    $("#btnLogout").click(function () {

                        var cookie = getCookie('access_token');
                        var token = "Bearer " + cookie;


                        $(".login-sec").css("visibility", "visible");
                        $(".profile").css("visibility", "hidden");
                        $("#btnLogout").css("visibility", "hidden");
                        $("#inEmail").val("");
                        $("#inPass").val("");

                        const url = "http://hien-web.service.docker/api/auth/logout";

                        $.ajax({
                            url: url,
                            type: 'POST',
                            headers: {"Authorization": token},
                            contentType: false,
                            cache: false,
                            processData: false
                        }).done(function (response) { //

                            alert(response['message']);

                        });

                        deleteCookie('access_token');
                    })
                });

                // get cookie to save token
                function getCookie(name) {
                    const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
                    return v ? v[2] : null;
                }

                function setCookie(name, value, days) {
                    const d = new Date;
                    d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
                    document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
                }

                function deleteCookie(name) {
                    setCookie(name, '', -1);
                }
            </script>
@endsection


