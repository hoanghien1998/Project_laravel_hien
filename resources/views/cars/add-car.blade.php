@extends('layouts.layouts')

@section('content')
    <div class="container">
        <div class="row">
            <button class="btn btn-danger" type="button" id="btnList" style="display: none">Show list car</button>
        </div>
        <div class="row list-car" style="display: none">
            <div class="col-lg-12 col-md-12 listCar">
                <h2 style="text-align:center ">List cars</h2>
                <button class="btn btn-success" value="add" id="btnAdd">Add car</button>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Seat</th>
                        <th>Car Model</th>
                        <th>Car Body</th>
                        <th>Year</th>
                        <th>Car Price</th>
                        <th>Due Date</th>
                        <th>Start Bid Time</th>
                        <th>End Bid</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbbody">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 add" style="display: none">
                <h2>Add car form</h2>
                <form method="post" id="addCarFrm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="carSeat">Car Seat:</label>
                        <input type="number" min="4" class="form-control" placeholder="Enter car_seat" name="seat">
                    </div>
                    <div class="form-group">
                        <label for="carModel">Car Model:</label>
                        <input type="text" class="form-control"
                               placeholder="Enter car_brand and car_model likes Toyota Innova, Toyota Altis,..."
                               name="model">
                    </div>
                    <div class="form-group">
                        <label for="carBody">Car Body:</label>
                        <input type="text" class="form-control"
                               placeholder="Enter car_body likes Sedan, Coupe, Convertible, Hatchback, SUV, Wagon,..."
                               name="body">
                    </div>
                    <div class="form-group">
                        <label for="carBody">Car Year:</label>
                        <input type="text" class="form-control" placeholder="Enter car_year" name="year">
                    </div>
                    <div class="form-group">
                        <label for="price">Car Starting Price:</label>
                        <input type="number" min="0" class="form-control" placeholder="Enter car_price"
                               name="price">
                    </div>
                    <div class="form-group">
                        <label for="dueDate">Due Date:</label>
                        <input type="date" class="form-control" name="dueDate">
                    </div>
                    <div class="form-group">
                        <label for="startBid">Start Bid Date:</label>
                        <input type="datetime-local" class="form-control" name="startBid">
                    </div>
                    <div class="form-group">
                        <label for="endBid">End Bid:</label>
                        <input type="datetime-local" class="form-control" name="endBid">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control ckeditor" id="ckeditor"
                                  placeholder="Enter car_description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="upload">Upload Image:</label>
                        <input type="file" class="form-control" name="image" id="uploadImages" multiple>
                    </div>
                    <div class="form-group">
                        <div id="image-list"></div>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                <ul style="visibility: hidden" class="showErr">

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">@include('cars.details')</div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">@include('cars.update-cars')</div>
        </div>
        @include('cars.search')
        @include('cars.view-cars')
        @include('users.profile')
        @include('users.login')
        @include('users.register')
        @include('cars.details')
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var tempFiles = [];
        var tempFilesEdit = [];
        var uploadedFile = [];
        var imagesRemove = [];

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
        $(".list-car").ready(function () {
            $(".list-car").show();
            const url = "http://hien-web.service.docker/api/car/list-car";
            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
                headers: {"Authorization": token}
            }).done(function (response) { //

                var data = "";

                // Append data car
                for (let i = 0; i < response['cars'].length; i++) {
                    var $item = response['cars'][i];

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
                        + "<td>" + $item.description + "</td>"
                        + "<td>" + "<button type=\"button\" class=\"btn btn-warning\" onclick='updateCar(" + $item.id + ")'> Update</button>" + "</td>"
                }
                $('#tbbody').html(data);
            });
        });

        // Search car
        $("#search").click(function () {
            $(".formSearch").show();
            $("#btnPro").show();
            $("#viewCars").hide();
            $(".login-sec").hide();
            $(".register").hide();
            $(".list-car").hide();
            $(".profile").hide();

        });
        $("#searchFrm").submit(function (event) {
            event.preventDefault();
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
                        "<h4 class=\"media-heading\" id=\"title\">" + obj.model + " - " + obj.body + "</h4>" +
                        "<p> " + trimmedString + "</p>" +
                        "</div>" +
                        "</div>"
                }
                $('#ResultSearch').html(data);

            }).fail(function (error) {
                var obj = JSON.parse(error['responseText']);
                alert(obj);
                var errors = "";

                $.each(obj.errors, function (index, value) {
                    errors += value;
                });

                var errs = "<div class=\"alert alert-danger alert-dismissible\">" +
                    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" + errors +
                    "</div>";
                $("#showErrorSearch").html(errs);
            });
            return false;
        });

        // Show view cars
        $("#view-cars").click(function () {
            $("#viewCars").show();
            $("#btnPro").show();
            $(".formSearch").hide();
            $(".profile").hide();
            $(".login-sec").hide();
            $(".register").hide();
            $(".list-car").hide();
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

                    data += "<div class=\"media col-lg-4\" style='margin-top: 20px;'>" +
                        "<div class=\"media-left\">" +
                        "<img src='storage/uploads/" + image.photo + "' onclick='showCarDetail(this)' class=\"media-object media-img\" style=\"width:150px; height: 150px; border-radius: 3%\" + data-id='" + obj.id + "'>" +
                        "</div>" +
                        "<div class=\"media-body\">" +
                        "<h4 class=\"media-heading\" id=\"title\"><span>Title: </span>" + obj.model + " - " + obj.body + "</h4>" +
                        "<p>" + obj.description + "</p>" +
                        "</div>" +
                        "</div>"
                }

                $('#viewCars').html(data);
            });
        }

        // Show car detail
        function showCarDetail(obj) {
            var id = $(obj).attr('name');
            $("#details").show();
            $("#viewCars").hide();

            const url = "http://hien-web.service.docker/api/car/update/";
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

        // Add new cars
        $("#btnAdd").click(function () {
            $("#details").hide();
            $(".add").show();
            $(".listCar").hide();

            // Remove content added before
            $('input').val('');
            $('#ckeditor').val('').empty();
            tempFiles = [];
            $("#image-list").html('');

        });

        // Add car
        $("#addCarFrm").submit(function (event) {
            event.preventDefault(); //prevent default action

            const url = "http://hien-web.service.docker/api/car/create";
            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;

            var form_data = new FormData(this); //Creates new FormData object
            delete form_data.file;
            form_data.append("uploadedFile", tempFiles.join(','));
            console.log(tempFiles);
            // alert(form_data.uploadedFile);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {"Authorization": token},
                data: form_data,
                contentType: false,
                cache: false,
                processData: false
            }).done(function (response) {
                //alert(response['images']);
                console.log(response);
                alert('Add car information successfully!!!!');
                $(".add").hide();
                $("#btnList").show();

            }).fail(function (error) {

                var $showErr = $(".showErr");
                $showErr.css("visibility", "visible");

                var str = '';

                $.each(error['responseJSON'], function (index, val) {
                    str += "<li class='text-danger'>" + val + "</li>"
                });

                $showErr.html(str);
            });
            return false;
        });

        // upload images into data
        $("#uploadImages").on('change', function (e) {

            url = 'http://hien-web.service.docker/api/car/upload';
            var photo = e.target.files[0];
            var form_data = new FormData();
            form_data.append("image", photo);

            // AJAX request
            $.ajax({
                url: url,
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    tempFiles.push(response.file);

                    var img = '/storage/uploads/' + response.file;
                    $('#image-list').append('<div class="img-box" data-img="' + response.file + '"><img src="' + img + '" width="200" height="200"/><div class="view" onclick="displayImg(this)">View</div><div onclick="deleteImg(this, tempFiles, false)" class="delete">X</div></div>');

                }
            });
        });


        // show list car
        $("#btnList").click(function () {
            $(".listCar").show();
            $("#btnList").hide();
            const url = "http://hien-web.service.docker/api/car/list-car";
            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
                headers: {"Authorization": token}
            }).done(function (response) { //

                var data = "";

                // Append data car
                for (let i = 0; i < response['cars'].length; i++) {
                    var $item = response['cars'][i];

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
                        + "<td>" + $item.description + "</td>"
                        + "<td>" + "<button type=\"button\" class=\"btn btn-warning\" onclick='updateCar(" + $item.id + ")'> Update</button>" + "</td>"
                }
                $('#tbbody').html(data);
            });
        });


        // show information car to update car
        function updateCar(car_id) {
            tempFilesEdit = [];
            imagesRemove = [];
            uploadedFile = [];
            $("#details").hide();
            $("#update").show();
            $("#btnList").hide();
            $(".listCar").hide();
            const url = "http://hien-web.service.docker/api/car/update/";
            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;
            $.ajax({
                url: url + car_id,
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
                headers: {"Authorization": token}
            }).done(function (response) {
                var obj = response['car'];
                $("#seat").val(obj.seat);
                $("#model").val(obj.model);
                $("#body").val(obj.body);
                $("#year").val(obj.year);
                $("#price").val(obj.price);
                $("#dueDate").val(obj.dueDate);
                $("#startBid").val(obj.startBid);
                $("#endBid").val(obj.endBid);
                $("#description").text(obj.description);

                var images = "";
                if (response['car-image'] != null) {
                    for (var i = 0; i < response['car-image'].length; i++) {
                        var objImage = response['car-image'][i];
                        uploadedFile.push(objImage.photo);

                        var img = '/storage/uploads/' + objImage.photo;
                        images += '<div class="img-box" data-img="' + objImage.photo + '"><img src="' + img + '" width="200" height="200"/><div class="view" onclick="displayImg(this)">View</div><div onclick="deleteImg(this, tempFilesEdit, true)" class="delete">X</div></div>';
                        $('#image-list-edit').html(images);
                    }
                }
            });
            id = car_id;
        }

        // Post Edit form
        $("#updateCarFrm").submit(function (event) {
            event.preventDefault(); //prevent default action
            const url = "http://hien-web.service.docker/api/car/update/";
            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;

            //var data = serializeForm(this);
            var form_data = new FormData(this); //Creates new FormData object

            delete form_data.file;
            form_data.append("uploadedFile", tempFiles.join(','));
            form_data.append("removeFile", imagesRemove.join(','));

            $.ajax({
                url: url + id,
                type: 'POST',
                headers: {"Authorization": token},
                data: form_data,
                contentType: false,
                cache: false,
                processData: false
            }).done(function (response) {
                console.log(response['car']);
                alert('Update car information successfully!!!!');
                $("#update").hide();
                $("#btnList").show();
                $("#uploadImageEdit").val('');
            });
        });


        // Upload each image
        $("#uploadImageEdit").change(function (e) {
            var photo = e.target.files[0];

            if (imagesRemove.includes(photo.name)) {
                spliceItem(photo.name, imagesRemove);
            }

            if (!uploadedFile.includes(photo.name)) {
                var form_data = new FormData();
                form_data.append("image", photo);
                $.ajax({
                    url: 'http://hien-web.service.docker/api/car/upload',
                    type: 'post',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        tempFiles.push(response.file);
                        //$("input[name=file]").val(tempFiles);
                        var img = '/storage/uploads/' + response.file;
                        $('#image-list-edit').append('<div class="img-box" data-img="' + response.file + '"><img src="' + img + '" width="200" height="200"/><div class="view" onclick="displayImg(this)">View</div><div onclick="deleteImg(this, tempFilesEdit, true)" class="delete">X</div></div>');
                    }
                });

            }

        });

        // Show profile user
        $("#btnPro").click(function () {
            $(".profile").show();
            $("#btnLogout").show();
            $("#btnPro").hide();
            $(".formSearch").hide();
            $("#viewCars").hide();
            $(".list-car").hide();

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

        function spliceItem(file, arr) {
            const index = arr.indexOf(file);
            arr.splice(index, 1);
        }

        // delete when user want change images
        function deleteImg(obj, tempFiles, isEditForm) {
            var file = $(obj).parent().attr('data-img');

            if (tempFilesEdit.includes(file)) {
                spliceItem(file, tempFilesEdit);
            } else {
                spliceItem(file, uploadedFile);
            }

            $(obj).parent().remove();
            if (isEditForm) {
                imagesRemove.push(file);
            }
        }

        // display images on view
        function displayImg(obj) {
            var file = '/storage/uploads/' + $(obj).parent().attr('data-img');
            var wLocation = window.location;
            console.log(wLocation);
            var baseUrl = wLocation.protocol + "//" + wLocation.host;

            window.open(baseUrl + file);
        }

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
