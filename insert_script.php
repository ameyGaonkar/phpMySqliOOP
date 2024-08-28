<?php
    require_once 'connection.php';
    $status= 0;

    if (isset($_POST['userName']) && isset($_POST['userEmail']) && isset($_POST['userDOBDate']) && isset($_POST['userDOBMonth']) && isset($_POST['userDOBYear'])) {
        $dob= $_POST['userDOBYear'] .'-' .$_POST['userDOBMonth'] .'-' .$_POST['userDOBDate'];
        $queryStatement = $con->prepare("INSERT INTO basic_information (name, email, dob) VALUES (?, ?, ?)");
        $queryStatement->bind_param("sss", $_POST['userName'], $_POST['userEmail'], $dob);
        $queryStatement->execute();
        $foreign_key = $con->insert_id;
        $queryStatement->close();
        var_dump($foreign_key);
    }

    if(!empty($foreign_key)){
        $type='Permanent';
        $queryStatement2 = $con->prepare("INSERT INTO contact_information (basic_id, type, contact, address) VALUES (?,?,?,?)");
        $queryStatement2->bind_param("isis", $foreign_key, $type, $_POST['userPerCont'], $_POST['userPerAddr']);
        $queryStatement2->execute() ? $status = 1 : $status = 0;

        if( ($_POST['userPerCont']!=$_POST['userPosCont']) && ($_POST['userPerAddr']!=$_POST['userPosAddr']) ){
            $type = 'Post';
            $queryStatement2->bind_param("isis", $foreign_key, $type, $_POST['userPosCont'], $_POST['userPosAddr']);
            $queryStatement2->execute() ? $status = 1 : $status = 0;
        }
        $queryStatement2->close();
    }
    header("Location: displayAll.php?status={$status}");