@extends('layouts.layouts')
@section('content')

    <div class="container">
        @include('users.profile')
        @include('users.login')
        @include('users.register')
        @include('cars.search')
        @include('cars.view-cars')
        @include('cars.details')
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
                $("#viewCars").hide();
                $(".formSearch").hide();

            }).fail(function () {
                $("#btnLogin").show();
                $("#btnRegister").show();
            });
        });

        // Search car
        $("#search").click(function () {
            $(".formSearch").show();
            $("#keyword").val('');
            $("#startYear").val('');
            $("#endYear").val('');
            $("#viewCars").hide();
            $(".profile").hide();
            $(".login-sec").hide();
            $(".register").hide();
            $("#details").hide();

        });
        $("#searchFrm").submit(function (event) {
            event.preventDefault();
            $("#details").hide();
            const url = "http://hien-web.service.docker/api/car/search";
            var form_data = new FormData(this);
            $.ajax({
                url: url,
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false
            }).done(function (response) {

                var data = "";
                for (var i = 0; i < response['search'].length; i++) {
                    //alert(response['search']);
                    var obj = response['search'][i];
                    var trimmedString = obj.description.substring(0, 30);
                    var image = response['search'][i]['default_image'];

                    data += "<div class=\"media col-lg-4\" style='margin-top: 20px'>" +
                        "<div class=\"media-left\">" +
                        "<img src='storage/uploads/" + image.photo + "' onclick='showCarDetail(this)' class=\"media-object media-img\" style=\"width:100px; height: 100px; border-radius: 3%\" + data-id='" + obj.id + "'>" +
                        "</div>" +
                        "<div class=\"media-body\">" +
                        "<h4 class=\"media-heading\" id=\"title\"><a href=''>" + obj.model + " - " + obj.body + "</a></h4>" +
                        "<p> " + trimmedString + "</p>" +
                        "</div>" +
                        "</div>"
                }
                $('#ResultSearch').html(data);
                $('#ResultSearch').show();
            });
        });

        // Show view cars
        $("#view-cars").click(function () {
            $("#viewCars").show();
            $(".formSearch").hide();
            $(".profile").hide();
            $(".login-sec").hide();
            $(".register").hide();
            $("#details").hide();
            $('#ResultSearch').hide();
            ViewCars();
        });

        // Get all cars to show
        function ViewCars() {
            const url = "http://hien-web.service.docker/api/car/list-car";
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
            }).done(function (response) {
                var data = "";
                // Append data car
                for (var i = 0; i < response['cars'].length; i++) {

                    var obj = response['cars'][i];
                    var image = response['cars'][i]['default_image'];
                    var link = "http://hien-web.service.docker/detail-cars/".concat(obj.id);

                    data += "<div class=\"media col-lg-6\" style='margin-top: 20px;'>" +
                        "<div class=\"media-left\">" +
                        "<img src='storage/uploads/" + image.photo + "' onclick='showCarDetail(this)' class=\"media-object media-img\" style=\"width:150px; height: 150px; border-radius: 3%\" + data-id='" + obj.id + "'>" +
                        "</div>" +
                        "<div class=\"media-body\">" +
                        "<h4 class=\"media-heading\" id=\"title\"><a href= 'javascript:void(0)' onclick='showCarDetail(this)'>" + obj.model + " - " + obj.body + "</a></h4>" +
                        "<p>" + obj.description + "</p>" +
                        "</div>" +
                        "</div>"
                }

                $('#viewCars').html(data);
            });
        }

        // Show car detail
        function showCarDetail(obj) {
            var id = $(obj).attr('data-id');
            $("#details").show();
            $("#viewCars").hide();
            // $(".formSearch").hide();
            // $('#ResultSearch').hide();

            const url = "http://hien-web.service.docker/api/car/details/";
            $.ajax({
                url: url + id,
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
            }).done(function (response) {
                var data = "";
                var data1 = "";
                var $item = response['car'];
                data += "<tr>"
                    + "<td>" + $item.id + "</td>"
                    + "<td>" + $item.status + "</td>"
                    + "<td>" + $item.seat + "</td>"
                    + "<td>" + $item.model + "</td>"
                    + "<td>" + $item.body + "</td>"
                    + "<td>" + $item.year + "</td>"
                    + "<td>" + $item.price + "</td>"
                    + "<td>" + $item.dueDate + "</td>"
                    + "<td>" + $item.startBid + "</td>"
                    + "<td>" + $item.endBid + "</td>"
                    + "<td>" + $item.description + "</td></tr>"

                for (var i = 0; i < response['car-image'].length; i++) {

                    if (i == 0) {
                        data1 += "<div class=\"item active\" >" +
                            "<img src='" + "storage/uploads/" + response['car-image'][i]['photo'] + "' alt=\"Los Angeles\" style=\"width: 800px; height: 300px\">" +
                            "</div>";
                    } else {
                        data1 += "<div class=\"item\" >" +
                            "<img src='" + "storage/uploads/" + response['car-image'][i]['photo'] + "' alt=\"Los Angeles\" style=\"width: 800px; height: 300px\">" +
                            "</div>";
                    }
                }

                $('#tbodyDetails').html(data);
                $('#images').html(data1);

            });
        }

        // Show profile user
        $("#btnPro").click(function () {
            $(".profile").show();
            $("#btnLogout").show();
            $("#btnPro").hide();
            $("#viewCars").hide();
            $("#details").hide();

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
            $(".register").hide();
            $("#details").hide();
            $("#ResultSearch").hide();
            $(".formSearch").hide();
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
                $("#viewCars").hide();
            }).fail(function () {
                alert("Don't you have an account. Please register account!!! ");
                $(".register").show();
                $(".login-sec").hide();
            });
        });

        // Register account user
        $("#btnRegister").click(function () {
            $(".register").show();
            $(".login-sec").hide();
            $("#viewCars").hide();
            $("#details").hide();
            $("#ResultSearch").hide();
            $(".formSearch").hide();
        });
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
                $("#inEmail").val('');
                $("#inPass").val('');
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
            $("#viewCars").hide();
            $("#details").hide();

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
