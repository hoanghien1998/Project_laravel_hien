<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
/** @var TYPE_NAME $data */
if (!empty($data['found_book'])) {
    $found_book=$data['found_book'];
}
?>
<div class="container" style="margin-top: 20px">
    <h1 style="text-align: center">Form Book</h1>
    <form class="form-horizontal" <?php if (!empty($data['create'])) {
        echo 'action="/add"';
                                  } else {
                                      echo 'action="/update"';
                                  } ?> method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="is">IBSN:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="isbn" <?php if (!empty($found_book['isbn'])) {
                                                                         echo "value={$found_book['isbn']}";
                                                                  }?> name="isbn" placeholder="Enter isbn">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="title">Title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title"<?php if (!empty($found_book['title'])) {
                                                                       echo "value='{$found_book['title']}'";
                                                                  }?> name="title" placeholder="Enter title">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subtitle">Subtitle:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="subtitle" <?php if (!empty($found_book['subtitle'])) {
                                                                        echo "value='{$found_book['subtitle']}'";
                                                                      }?> name="subtitle" placeholder="Enter subtitle">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="author">Author:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="author" <?php if (!empty($found_book['author'])) {
                                                                         echo "value='{$found_book['author']}'";
                                                                    }?> name="author" placeholder="Enter author">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="published">Published:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="published" <?php if (!empty($found_book['published'])) {
                    echo "value='{$found_book['published']}'";
                                                                       }?> name="published"placeholder="Enter published">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="publisher">Publisher:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="publisher" value="<?php echo !empty($found_book['publisher']) ? htmlspecialchars($found_book['publisher']) : ''; ?>"
                       name="publisher" placeholder="Enter publisher">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pages">Pages:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pages" <?php if (!empty($found_book['pages'])) {
                                                                         echo "value='{$found_book['pages']}'";
                                                                   }?> name="pages" placeholder="Enter pages">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="description" <?php if (!empty($found_book['description'])) {
                                                                             echo "value='{$found_book['description']}'";
                                                                         }?> name="description" placeholder="Enter description">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="website">Website:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="website" <?php if (!empty($found_book['website'])) {
                                                                           echo "value='{$found_book['website']}'";
                                                                     }?> name="website" placeholder="Enter website">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
               <button type="submit" class="btn btn-success"><?php if (!empty($data['create'])) {
                                                                  echo 'Add book';
                                                             } else {
                                                                 echo "Update book";
                                                             } ?> </button>
            </div>
        </div>
    </form>

</div>
</body>
</html>
