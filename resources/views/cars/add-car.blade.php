@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <button class="btn btn-danger" type="button" id="btnList" style="display: none">Show list car</button>
        </div>
        <div class="row">
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
                        <textarea name="description" class="form-control"
                                  placeholder="Enter car_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">Upload Image:</label>
                        <input type="file" class="form-control" name="images[]" multiple id="images">
                        <div style="clear:both"></div>
                        <br />
                        <br />
                        <div id="uploaded_images"></div>
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
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(window).on('load', function () {
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
                for (let i = 0; i < response.length; i++) {
                    var $item = response[i];

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
                        + "<td>" + "<button type=\"button\" class=\"btn btn-success\" onclick='DetailsCar(" + $item.id + ")'>Details</button>"
                        + "<button type=\"button\" class=\"btn btn-warning\" onclick='updateCar(" + $item.id + ")'> Update</button>" + "</td>"
                }
                $('#tbbody').html(data);
            });
        });

        $(function () {
            $("#btnAdd").click(function () {
                $("#details").hide();
                $(".add").show();
                $(".listCar").hide();
                // Add car
                $("#addCarFrm").submit(function (event) {
                    event.preventDefault(); //prevent default action
                    const url = "http://hien-web.service.docker/api/car/create";
                    var cookie = getCookie('access_token');
                    var token = "Bearer " + cookie;

                    var form_data = new FormData(this); //Creates new FormData object

                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {"Authorization": token},
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false
                    }).done(function (response) {
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

                });

            });

            // upload images into data
            $('#images').change(function(){
                var files = $('#images')[0].images;
                var error = '';
                var form_data = new FormData();

                for(var count = 0; count<images.length; count++)
                {
                    var name = images[count].name;
                    var extension = name.split('.').pop().toLowerCase();

                    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                    {
                        error += "Invalid " + count + " Image File"
                    }
                    else
                    {
                        form_data.append("images[]", files[count]);
                    }
                }
                if(error == '')
                {
                    $.ajax({
                        url:"url",
                        method:"POST",
                        data:form_data,
                        contentType:false,
                        cache:false,
                        processData:false,
                        beforeSend:function()
                        {
                            $('#uploaded_images').html("<label class='text-success'>Uploading...</label>");
                        },
                        success:function(data)
                        {
                            $('#uploaded_images').html(data);
                            $('#images').val('');
                        }
                    })
                }
                else
                {
                    alert(error);
                }
            });
        });

        // show list car
        $("#btnList").click(function () {
            $(".listCar").show();
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
                for (let i = 0; i < response.length; i++) {
                    var $item = response[i];

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
                        + "<td>" + "<button type=\"button\" class=\"btn btn-success\" onclick='DetailsCar(" + $item.id + ")'>Details</button>"
                        + "<button type=\"button\" class=\"btn btn-warning\" onclick='updateCar(" + $item.id + ")'> Update</button>" + "</td>"
                }
                $('#tbbody').html(data);
            });
        });

        // Show all photos carId
        function DetailsCar(carId) {
            $("#details").show();
            const url = "http://hien-web.service.docker/api/car/list-images/";
            var cookie = getCookie('access_token');
            var token = "Bearer " + cookie;

            $.ajax({
                url: url + carId,
                type: 'GET',
                dataType: 'json',
                contentType: "application/json",
                headers: {"Authorization": token}
            }).done(function (response) {
                alert(response);
                var dataImage = "";

                for (var i = 0; i < response.length; i++) {
                    dataImage += "<tr>"
                        + "<td>" + response[i]['carId'] + "</td>"
                        + "<td>" + '<img alt="" src="image/' + response[i]['photo'] + '"/>' + "</td></tr>"

                }
                $('#tbbodyImage').html(dataImage);
                $("#btnList").hide();
            });
        }

        // show car to update car
        function updateCar(car_id) {
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
                $("#seat").val(response['seat']);
                $("#model").val(response['model']);
                $("#body").val(response['body']);
                $("#year").val(response['year']);
                $("#price").val(response['price']);
                $("#dueDate").val(response['dueDate']);
                $("#startBid").val(response['startBid']);
                $("#endBid").val(response['endBid']);
                $("#description").text(response['description']);
                //$("#photo").append("<img alt='' src='/" + response['photo'] + "'>");
                $("#photo").val(response['photo']);

            });

            // Post Edit form
            $("#updateCarFrm").submit(function (event) {

                event.preventDefault(); //prevent default action
                const url = "http://hien-web.service.docker/api/car/update/";
                var cookie = getCookie('access_token');
                var token = "Bearer " + cookie;

                var form_data = new FormData(this); //Creates new FormData object

                $.ajax({
                    url: url + car_id,
                    type: 'POST',
                    headers: {"Authorization": token},
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false
                }).done(function (response) {

                    console.log(response);
                    alert('Update car information successfully!!!!');
                    $("#update").hide();
                    $("#btnList").show();
                });
            });
        }

        // get cookie to save token
        function getCookie(name) {
            const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? v[2] : null;
        }
    </script>


@endsection