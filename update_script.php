<?php
    require_once 'connection.php';
    $status=0;

    $getPeople = $con->prepare("SELECT t1.id, t1.name, t2.id AS permanent_id, t2.contact AS 'permanent_contact', t2.address AS 'permanent_address', t3.id AS postal_id, t3.contact AS 'postal_contact', t3.address AS 'postal_address'
                                FROM basic_information t1 
                                LEFT JOIN contact_information t2 ON t1.id = t2.basic_id AND t2.type='Permanent' 
                                LEFT JOIN contact_information t3 ON t1.id = t3.basic_id AND t3.type='Post'
                                WHERE t1.id = ?");
    $getPeople->bind_param("i", $_POST['people_id']);
    $getPeople->execute();
    $result = $getPeople->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(!empty($_POST["userName"]) && $row["name"] != $_POST["userName"]){
            $updateBasic  = $con->prepare("UPDATE basic_information SET name = ? WHERE id = ?");
            $updateBasic->bind_param("si",$_POST["userName"], $row["id"]);
            $updateBasic->execute() ? $status+=5 : '';
        }

        if(!empty($_POST["userPerCont"]) && !empty($_POST["userPerAddr"]) && ($row["permanent_contact"] != $_POST["userPerCont"] || $row["permanent_address"] != $_POST["userPerAddr"])){
            $updatePermanent = $con->prepare("UPDATE contact_information SET contact = ?, address =  ? WHERE id = ? AND basic_id = ?");
            $updatePermanent->bind_param("isii",$_POST["userPerCont"], $_POST["userPerAddr"], $row['permanent_id'], $row['id']);
            $updatePermanent->execute() ? $status+=4 : '';
        }

        if(!empty($row["postal_id"]) && ($row["postal_contact"] != $_POST["userPosCont"] || $row["postal_address"] != $_POST["userPosAddr"])){
            $updatePostal = $con->prepare("UPDATE contact_information SET contact = ?, address =  ? WHERE id = ? AND basic_id = ?");
            $updatePermanent->bind_param("isii",$_POST["userPosCont"], $_POST["userPosAddr"], $row['postal_id'], $row['id']);
            $updatePostal->execute() ? $status+=3 : '';
        } elseif(empty($row["postal_id"]) && !empty($_POST["userPosCont"]) && !empty($_POST["userPosAddr"]) && ($_POST["userPosCont"] != $row["permanent_contact"] || $_POST["userPosAddr"] != $row["permanent_address"])){
            $insertPostal = $con->prepare("INSERT INTO contact_information (basic_id,type,contact,address) VALUES (?, 'POST', ?, ?)");
            $insertPostal->bind_param("iis", $row["id"], $_POST["userPosCont"], $_POST["userPosAddr"]);
            $insertPostal->execute() ? $status+=6 : '';
        }
    }

    header("Location: displayAll.php?status={$status}");