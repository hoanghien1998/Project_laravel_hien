@extends('layouts.layouts')
@section('content')
    <div class="container-fluid">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://hien-web.service.docker/">WebSite Bid Cars</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="http://hien-web.service.docker/car">List cars</a></li>
                    <li><a href="#">View Cars</a></li>
                    <li><a href="#">My Bid</a></li>
                </ul>
                <form class="navbar-form navbar-left" action="/action_page.php">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>

                <ul class="nav navbar-nav navbar-right" style="margin-left: 10px">
                    <li>
                        <button style="margin-top: 10px" id="btnRegister">
                            <span class="glyphicon glyphicon-user" style="margin-right: 8px"></span>Sign Up
                        </button>
                        <button id="btnLogin" style="margin-top: 10px">
                            <span class="glyphicon glyphicon-log-in" style="margin-right: 8px"></span>Login
                        </button>
                    </li>
                </ul>
            </div>
        </nav>

        @include('users.profile');
        @include('users.login');
        @include('users.register');
    </div>
@endsection

@section('script')
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

                $(".profile").show();
                $("#btnLogout").show();

                $("#first_name").val(response['firstname']);
                $("#last_name").val(response['lastname']);
                $("#phone").val(response['phone']);
                $("#birthday").val(response['birthday']);
                $("#gender").val(response['gender']);
                $("#email").val(response['email']);

            }).fail(function () {
                $(".login-sec").show();
            });
        });

        $("#btnLogin").click(function () {
            $("#loginFr").show();
        });
        // login page
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
                $("#btnPro").show();
                $(".login-sec").hide();

            }).fail(function () {
                $(".centered-form").show();
                $(".login-sec").hide();
            });
        });


        // get cookie to save token
        function getCookie(name) {
            const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? v[2] : null;
        }

        // Create cookie.
        function setCookie(name, value, days) {
            const d = new Date;
            d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
            document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
        }

        // Set again new cookie.
        function deleteCookie(name) {
            setCookie(name, '', -1);
        }
    </script>

@endsection
