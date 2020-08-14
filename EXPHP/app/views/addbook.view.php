<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        control-label{ text-align: left;}
    </style>
</head>
<body>
<div class="container" style="margin-top: 20px">
    <h1 style="text-align: center">Form Book</h1>
    <form class="form-horizontal" action="/add" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="is">IBSN:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="isbn" placeholder="Enter isbn">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="title">Title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="Enter title">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subtitle">Subtitle:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="subtitle" placeholder="Enter subtitle">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="author">Author:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="author" placeholder="Enter author">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="published">Published:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="published" placeholder="Enter published">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="publisher">Publisher:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="publisher" placeholder="Enter publisher">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pages">Pages:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pages" placeholder="Enter pages">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="description" placeholder="Enter description">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="website">Website:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="website" placeholder="Enter website">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" name="add">Add book</button>
            </div>
        </div>
    </form>

</div>
</body>
</html>
