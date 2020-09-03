@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Add car form</h2>
                <form method="post" id="addCarFrm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="carSeat">Car Seat:</label>
                        <input type="number" class="form-control" placeholder="Enter car_seat" name="seat">
                    </div>
                    <div class="form-group">
                        <label for="carModel">Car Model:</label>
                        <input type="text" class="form-control" placeholder="Enter car_brand and car_model likes Toyota Innova, Toyota Altis,..." name="model">
                    </div>
                    <div class="form-group">
                        <label for="carBody">Car Body:</label>
                        <input type="text" class="form-control" placeholder="Enter car_body likes Sedan, Coupe, Convertible, Hatchback, SUV, Wagon,..." name="body">
                    </div>
                    <div class="form-group">
                        <label for="carBody">Car Year:</label>
                        <input type="text" class="form-control" placeholder="Enter car_year" name="year">
                    </div>
                    <div class="form-group">
                        <label for="price">Car Starting Price:</label>
                        <input type="number" class="form-control" placeholder="Enter car_price" name="price">
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
                        <label for="endBid">Bid Duration:</label>
                        <input type="datetime-local" class="form-control" name="endBid">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" placeholder="Enter car_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">Upload Image:</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <ul style="visibility: hidden" class="showErr">

                </ul>
            </div>

            <div class="col-lg-6">
                @include('cars.list-car')
            </div>
        </div>
        <div>

        </div>
        <h2>List cars</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Seat</th>
                <th>Starting Price</th>
                <th>Due date</th>
                <th>Car year</th>
                <th>Model</th>
                <th>Body</th>
                <th>Start Bid Time</th>
                <th>Bid Duration</th>
                <th>Description</th>
                <th>Photo</th>
            </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td>Success</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
