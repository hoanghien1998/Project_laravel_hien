<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <h2 style="text-align: center">LIST BOOK</h2>
    <div>
        <div style="float: left; margin-right: 50px"><a href="add">
                <button type="button" class="btn btn-primary">Add</button>
            </a></div>
        <div style="margin-bottom: 5px">
            <button type="button" id="reload" class="btn btn-info" style="margin-top: 5px">Reload</button>
        </div>
    </div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr class="success">
            <th>ISBN</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Author</th>
            <th>Published</th>
            <th>Publisher</th>
            <th>Pages</th>
            <th style="min-width: 200px">Description</th>
            <th style="max-width: 200px">Website</th>
        </tr>
        </thead>
        <tbody id="tbody">
        <?php
        /*Dynamically generating rows & columns*/
        /** @var TYPE_NAME $data */
        foreach ($data['books'] as $book) {
            echo '<tr>';
            echo '<td> <a href="/update?isbn=' . $book["isbn"] . '">' . $book["isbn"] . '</a></td>';
            echo '<td>' . $book["title"] . '</td>';
            echo '<td>' . $book["subtitle"] . '</td>';
            echo '<td>' . $book["author"] . '</td>';
            echo '<td>' . $book["published"] . '</td>';
            echo '<td>' . $book["publisher"] . '</td>';
            echo '<td>' . $book["pages"] . '</td>';
            echo '<td>' . $book["description"] . '</td>';
            echo '<td>' . $book["website"] . '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $("#reload").click(function () {
        $.ajax({
            method: "POST",
            url: "/reload",
            data: "",
            success: function (response) {
                var data = "";
                for (var i = 0; i < response.length; i++) {
                    var isbn = response[i]['isbn'];
                    data += "<tr>"
                        + "<td>" + "<a " + "href='/update?isbn=" + isbn + "'>" + isbn + "</a></td>"
                        // + "<td>" + "<a" + "href='/update?isbn=" + isbn + "'>" + isbn + "</a></td>"
                        + "<td>" + response[i]['title'] + "</td>"
                        + "<td>" + response[i]['subtitle'] + "</td>"
                        + "<td>" + response[i]['author'] + "</td>"
                        + "<td>" + response[i]['published'] + "</td>"
                        + "<td>" + response[i]['publisher'] + "</td>"
                        + "<td>" + response[i]['pages'] + "</td>"
                        + "<td>" + response[i]['description'] + "</td>"
                        + "<td>" + response[i]['website'] + "</td>"
                }
                $('#tbody').html(data);
            }
        });
    });

</script>
</body>
</html>

