<?php
require 'dbcon.php';

if (isset($_POST['lop']) && isset($_POST['mon']) && isset($_POST['combo'])){

    $lop = $_POST['lop'];
    $mon = $_POST['mon'];
    $combo = $_POST['combo'];

    $query = "
SELECT books.name AS \"tensach\"
FROM class
INNER JOIN subjects ON class.id = subjects.class_id
INNER JOIN combo on subjects.id = combo.subject_id
INNER JOIN combo_detail on combo.id = combo_detail.combo_id
INNER JOIN books on combo_detail.book_id = books.id

WHERE class.name = '$lop' AND subjects.name = '$mon' AND combo.name = '$combo'

";
    $data = mysqli_query($connect,$query);
    $mangCombo = array();

    while ($row = mysqli_fetch_assoc($data))
    {
        array_push($mangCombo, new Books($row['tensach']));
    }
    echo json_encode($mangCombo);

}

if (isset($_POST['lop']) && isset($_POST['mon']) && isset($_POST['combo']) && isset($_POST['books'])){

    $lop = $_POST['lop'];
    $mon = $_POST['mon'];
    $combo = $_POST['combo'];
    $books = $_POST['books'];

    $query1 = "
SELECT terms.name AS \"tenchuong\"
FROM class
INNER JOIN subjects ON class.id = subjects.class_id
INNER JOIN combo on subjects.id = combo.subject_id
INNER JOIN combo_detail on combo.id = combo_detail.combo_id
INNER JOIN books on combo_detail.book_id = books.id
INNER JOIN terms on books.id = terms.book_id
WHERE class.name = '$lop' AND subjects.name = '$mon' AND combo.name = '$combo' AND books.name = '$books'
";
    $data1 = mysqli_query($connect,$query1);
    $mangTemrs = array();

    while ($row = mysqli_fetch_assoc($data1))
    {
        array_push($mangTemrs, $row);
    }
    ob_end_clean();
    echo json_encode($mangTemrs);

}
if (isset($_POST['lop']) && isset($_POST['mon']) && isset($_POST['books']) && isset($_POST['terms'])){

    $lop = $_POST['lop'];
    $mon = $_POST['mon'];
    $books = $_POST['books'];
    $terms = $_POST['terms'];


    $query2 = "
SELECT posts.name AS \"tenbai\"
FROM posts
INNER JOIN terms on posts.term_id = terms.id
INNER JOIN books on terms.book_id = books.id
INNER JOIN subjects on books.subject_id = subjects.id
INNER JOIN class on subjects.class_id = class.id
WHERE class.name = '$lop' AND subjects.name = '$mon' AND books.name = '$books' AND terms.name = '$terms'
";
    $data2 = mysqli_query($connect,$query2);
    $mangPosts = array();

    while ($row = mysqli_fetch_assoc($data2))
    {
        array_push($mangPosts, $row);
    }
    ob_end_clean();
    echo json_encode($mangPosts);
}
if (isset($_POST['lop']) && isset($_POST['mon']) && isset($_POST['books'])){

    $lop = $_POST['lop'];
    $mon = $_POST['mon'];
    $books = $_POST['books'];


    $query3 = "
SELECT terms.name AS \"tenchuong\"
FROM class
INNER JOIN subjects ON class.id = subjects.class_id
INNER JOIN books on subjects.id = books.subject_id
INNER JOIN terms on books.id = terms.book_id
WHERE class.name = '$lop' AND subjects.name = '$mon' AND books.name = '$books'
";
    $data3 = mysqli_query($connect,$query3);
    $mangTermsBook = array();

    while ($row = mysqli_fetch_assoc($data3))
    {
        array_push($mangTermsBook, $row);
    }
    ob_end_clean();
    echo json_encode($mangTermsBook);
}

class Books {
    function Books($tensach){
        $this->tensach = $tensach;
    }
}

?>
