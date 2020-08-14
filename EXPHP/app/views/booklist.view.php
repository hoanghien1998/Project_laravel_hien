
<?php
    echo "<h1 style='text-align: center'>LIST BOOK</h1>";
    echo "<table border='1px soild balck' cellpadding='0' align='center'>";

    /*Defining table Column headers depending upon JSON records*/
    echo "<tr><th>ISBN</th>
          <th>title</th>
          <th>subtitle</th>
          <th>author</th>
          <th>published</th>
          <th>publisher</th>
          <th>pages</th>
          <th>description</th>
          <th>website</th></tr>";

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

    /*End tag of table*/
    echo "</table>";
