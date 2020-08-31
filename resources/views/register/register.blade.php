@extends('register.layouts.index')

@section('content')
    <div class="container">

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
                    $("#name").val(response['name']);
                    $("#email").val(response['email']);

                });
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
