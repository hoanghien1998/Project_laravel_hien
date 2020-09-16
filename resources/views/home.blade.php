@extends('layouts.layouts')
@section('content')

    <div class="container">
        @include('users.profile')
        @include('users.login')
        @include('users.register')
        @include('cars.search')
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

                $("#btnPro").show();
                $("#btnLogout").show();

            }).fail(function () {
                $("#btnLogin").show();
                $("#btnRegister").show();
            });
        });

        $("#search").click(function (){
            $(".formSearch").show();

        });
        // Show profile user
        $("#btnPro").click(function () {
            $(".profile").show();
            $("#btnLogout").show();
            $("#btnPro").hide();

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

        $("#btnLogin").click(function () {
            $(".login-sec").show();
        });

        // Login page after submit
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
                $("#btnLogout").show();
                $(".login-sec").hide();
                $("#btnLogin").hide();
                $("#btnRegister").hide();
            }).fail(function () {
                $(".register").show();
                $(".login-sec").hide();
            });
        });

        $("#btnRegister").click(function () {
            $(".register").show();
        });

        // When user submit form register
        $('#registerFrm').submit(function (event) {
            event.preventDefault();
            const url = "http://hien-web.service.docker/api/auth/register";

            var form_data = new FormData(this);

            $.ajax({
                url: url,
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false
            }).done(function (response) {
                alert(response['message']);
                $(".login-sec").show();
                $(".register").hide();

            });
        });

        // When onclick into btn logout
        $("#btnLogout").click(function () {

            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;


            $("#btnLogin").show();
            $("#btnRegister").show();
            $("#btnLogout").hide();
            $("#btnPro").hide();
            $(".profile").hide();

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
