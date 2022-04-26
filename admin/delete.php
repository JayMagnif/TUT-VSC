<?php

    require_once '../db.php';

    $id = $_GET['id'];

    $sql = 'DELETE FROM students WHERE student_id=:id';

    $stmt = $conn->prepare($sql);

    if($stmt->execute([':id' => $id])){
        header("location: ./");
    }

?>