<?php
    require_once 'connection.php';
    $status= 0;

    if (!isset($_POST['userName']) || empty($_POST['userName']) || is_numeric($_POST['userName'])){
        header("Location: error.php?message=Please%20enter%20a%20valid%20full%20name.");

    } elseif (!isset($_POST['userEmail']) || empty($_POST['userEmail']) || !filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)){
        header("Location: error.php?message=Please%20enter%20a%20valid%20email%20address."); 

    } elseif (!isset($_POST['userDOBDate']) || empty($_POST['userDOBDate']) || !is_numeric($_POST['userDOBDate']) || $_POST['userDOBDate']<1 || $_POST['userDOBDate'] >31){
        header("Location: error.php?message=Please%20enter%20a%20valid%20date%20of%20birth."); 

    } elseif (!isset($_POST['userDOBMonth']) || empty($_POST['userDOBMonth']) || !is_numeric($_POST['userDOBMonth']) || $_POST['userDOBMonth']<1 || $_POST['userDOBMonth'] >12){
        header("Location: error.php?message=Please%20enter%20a%20valid%20month%20of%20birth."); 

    } elseif (!isset($_POST['userDOBYear']) || empty($_POST['userDOBYear']) || !is_numeric($_POST['userDOBYear']) || $_POST['userDOBYear']<1900 || $_POST['userDOBYear'] >2006){
        header("Location: error.php?message=Please%20enter%20a%20valid%20year%20of%20birth."); 

    } elseif (!isset($_POST['userPerCont']) || empty($_POST['userPerCont']) || !is_numeric($_POST['userPerCont']) || $_POST['userPerCont']<6000000000 || $_POST['userPerCont']>9999999999){
        header("Location: error.php?message=Please%20enter%20a%20valid%20permanent%20phone%20number.");

    } elseif (!isset($_POST['userPerAddr']) || empty($_POST['userPerAddr']) || is_numeric($_POST['userPerAddr'])){
        header("Location: error.php?message=Please%20enter%20a%20valid%20pemanent%20address.");

    } elseif (!isset($_POST['userPosCont']) || empty($_POST['userPosCont']) || !is_numeric($_POST['userPosCont']) || $_POST['userPosCont']<6000000000 || $_POST['userPosCont']>9999999999){
        header("Location: error.php?message=Please%20enter%20a%20valid%20postal%20phone%20number.");

    } elseif (!isset($_POST['userPosAddr']) || empty($_POST['userPosAddr']) || is_numeric($_POST['userPosAddr'])){
        header("Location: error.php?message=Please%20enter%20a%20valid%20postal%20address.");

    } else {
        $dob= $_POST['userDOBYear'] .'-' .$_POST['userDOBMonth'] .'-' .$_POST['userDOBDate'];
        $queryStatement = $con->prepare("INSERT INTO basic_information (name, email, dob) VALUES (?, ?, ?)");
        $queryStatement->bind_param("sss", $_POST['userName'], $_POST['userEmail'], $dob);
        $queryStatement->execute();
        $foreign_key = $con->insert_id;
        $queryStatement->close();
    
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
    }
