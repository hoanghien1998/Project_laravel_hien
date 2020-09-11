<div style="display: none" id="update">
    <h2>Edit car form</h2>
    <form method="post" id="updateCarFrm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="carSeat">Car Seat:</label>
            <input type="number" class="form-control" placeholder="Enter car_seat"  name="seat" id="seat">
        </div>
        <div class="form-group">
            <label for="carModel">Car Model:</label>
            <label for="model"></label><input type="text" class="form-control" placeholder="Enter car_brand and car_model likes Toyota Innova, Toyota Altis,..." name="model" id="model">
        </div>
        <div class="form-group">
            <label for="carBody">Car Body:</label>
            <label for="body"></label><input type="text" class="form-control" placeholder="Enter car_body likes Sedan, Coupe, Convertible, Hatchback, SUV, Wagon,..." name="body" id="body">
        </div>
        <div class="form-group">
            <label for="carBody">Car Year:</label>
            <label for="year"></label><input type="text" class="form-control" placeholder="Enter car_year" name="year" id="year">
        </div>
        <div class="form-group">
            <label for="price">Car Starting Price:</label>
            <input type="number" min="0" class="form-control" placeholder="Enter car_price" name="price" id="price">
        </div>
        <div class="form-group">
            <label for="dueDate">Due Date:</label>
            <input type="date" class="form-control" name="dueDate" id="dueDate">
        </div>
        <div class="form-group">
            <label for="startBid">Start Bid Date:</label>
            <input type="datetime-local" class="form-control" name="startBid" id="startBid">
        </div>
        <div class="form-group">
            <label for="endBid">End Bid:</label>
            <input type="datetime-local" class="form-control" name="endBid" id="endBid">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" placeholder="Enter car_description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="upload">Upload Image:</label>
            <input type="file" class="form-control" name="images">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
