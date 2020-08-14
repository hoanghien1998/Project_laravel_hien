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
</head>
<body>
<div class="container">
    <h2 style="text-align: center">LIST BOOK</h2>
    <table class="table table-hover table-bordered" style="width: 1000px">
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
        <tbody>
        <?php
            /*Dynamically generating rows & columns*/
        /** @var TYPE_NAME $data */
        foreach ($data['books'] as $book) {
            echo '<tr>';
            echo '<td>'.$book["isbn"].'</td>';
            echo '<td>'.$book["title"].'</td>';
            echo '<td>'.$book["subtitle"].'</td>';
            echo '<td>'.$book["author"].'</td>';
            echo '<td>'.$book["published"].'</td>';
            echo '<td>'.$book["publisher"].'</td>';
            echo '<td>'.$book["pages"].'</td>';
            echo '<td>'.$book["description"].'</td>';
            echo '<td>'.$book["website"].'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

