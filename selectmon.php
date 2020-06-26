<?php
    require 'dbcon.php';

    $query = "SELECT class.name AS \"lop\",subjects.name AS \"loaisach\", subjects.thumb AS \"hinhanh\"
FROM class INNER JOIN subjects on class.id = subjects.class_id
ORDER BY class.id ASC";

    $data = mysqli_query($connect,$query);

class classAndSubjects {
    function classAndSubjects($lop,$loaisach,$hinhanh){
     $this->lop = $lop;
     $this->loaisach = $loaisach;
     $this->hinhanh = $hinhanh;
    }
}

$mangSach = array();

while ($row = mysqli_fetch_assoc($data))
{
    array_push($mangSach, new classAndSubjects($row['lop'],$row['loaisach'],$row['hinhanh']));
}
echo json_encode($mangSach);

?>