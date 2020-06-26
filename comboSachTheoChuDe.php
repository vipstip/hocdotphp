<?php
require 'dbcon.php';

$lop = $_POST['lop'];
$mon = $_POST['mon'];

$query = "SELECT combo.name AS \"tencombo\", combo.thumb AS \"hinhanh\"
FROM class
INNER JOIN subjects on class.id = subjects.class_id
INNER JOIN combo  on combo.subject_id = subjects.id
Where class.name = '$lop' and subjects.name = '$mon' and combo.status != 0
";

$query2 = "SELECT books.name AS \"tensach\", books.thumb AS \"hinhanh\"
FROM class 
INNER JOIN subjects on class.id = subjects.class_id
INNER JOIN books on books.subject_id = subjects.id
Where class.name = '$lop' and subjects.name = '$mon' and books.status != 0
EXCEPT 
SELECT books.name AS \"tensach\", books.thumb AS \"hinhanh\"
FROM class
INNER JOIN subjects on class.id = subjects.class_id
INNER JOIN books ON subjects.id = books.subject_id
INNER JOIN combo_detail ON books.id = combo_detail.book_id
INNER JOIN combo on combo.id = combo_detail.combo_id
Where class.name = '$lop' and subjects.name = '$mon' and books.status != 0  and combo.status != 0
";
$query3 = "SELECT DISTINCT books.name AS \"tensach\", books.thumb AS \"hinhanh\"
FROM class
INNER JOIN subjects on class.id = subjects.class_id
INNER JOIN books ON subjects.id = books.subject_id
INNER JOIN combo_detail ON books.id = combo_detail.book_id
INNER JOIN combo on combo.id = combo_detail.combo_id
Where class.name = '$lop' and subjects.name = '$mon' and books.status != 0  and combo.status != 0

";


$data = mysqli_query($connect,$query);
$data2 = mysqli_query($connect,$query2);
$data3 = mysqli_query($connect,$query3);

class Books {
    function Books($tensach,$hinhanh){
        $this->tensach = $tensach;
        $this->hinhanh = $hinhanh;
    }
}
class Combos{
    function Combos($tencombo,$hinhanh){
        $this->tencombo = $tencombo;
        $this->hinhanh = $hinhanh;
    }
}

$mangJson = array();
$mangSach = array();
$mangCombo = array();

while ($row = mysqli_fetch_assoc($data))
{
    array_push($mangCombo, new Combos($row['tencombo'],$row['hinhanh']));
}

while ($row = mysqli_fetch_assoc($data2))
{
    array_push($mangSach, new Books($row['tensach'],$row['hinhanh']));
}

while ($row = mysqli_fetch_assoc($data3))
{
    array_push($mangSach, new Books($row['tensach'],$row['hinhanh']));
}

$mangJson = array(
    'Sach' => $mangSach, 'Combo' => $mangCombo
);

echo json_encode($mangJson);

?>