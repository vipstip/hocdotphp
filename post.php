<?php
if (isset($_POST['lop']) && isset($_POST['mon']) && isset($_POST['books']) && isset($_POST['terms'])){

    $lop = $_POST['lop'];
    $mon = $_POST['mon'];
    $books = $_POST['books'];
    $terms = $_POST['terms'];


    $query = "
SELECT questions.title AS \"tenbai\"
FROM questions
INNER JOIN posts on questions.post_id = posts.id
INNER JOIN terms on posts.term_id = terms.id
INNER JOIN books on terms.book_id = books.id
INNER JOIN subjects on books.subject_id = subjects.id
INNER JOIN class on subjects.class_id = class.id
WHERE class.name = '$lop' AND subjects.name = '$mon' AND books.name = '$books' AND terms.name = '$terms'
";
    $data = mysqli_query($connect,$query);
    $mangPosts = array();

    while ($row = mysqli_fetch_assoc($data))
    {
        array_push($mangQuestions, $row);
    }
    ob_end_clean();
    echo json_encode($mangQuestions);
}

?>