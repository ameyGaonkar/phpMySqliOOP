<?php
    require_once 'connection.php';
    $status = 0;

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $deleteStmt = $con->prepare("UPDATE basic_information SET delete_status='Y' WHERE id=?");
        $deleteStmt->bind_param("i",$_GET['id']);
        $deleteStmt->execute() ? $status = 7 : '';
    }

    header("Location: displayAll.php?status={$status}");