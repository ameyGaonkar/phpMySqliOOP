<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>People</title>
    </head>
    <body>
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Enter Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="displayAll.php">Display Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Update</a>
                </li>
            </ul>

            <div class="row mt-4">
                <?php
                    if(isset($_GET['id'])){
                        require_once 'connection.php';

                        $fetchStatement = $con->prepare("SELECT t1.id, t1.name, t1.email, t1.dob, t2.id AS permanent_id, t2.contact AS 'permanent_contact', t2.address AS 'permanent_address', t3.id AS postal_id, t3.contact AS 'postal_contact', t3.address AS 'postal_address'
                                                    FROM basic_information t1 
                                                    LEFT JOIN contact_information t2 ON t1.id = t2.basic_id AND t2.type='Permanent' 
                                                    LEFT JOIN contact_information t3 ON t1.id = t3.basic_id AND t3.type='Post'
                                                    WHERE t1.id = ?");
                        $fetchStatement->bind_param("i", $_GET['id']);
                        $fetchStatement->execute();
                        $result = $fetchStatement->get_result();
                        if($result->num_rows > 0){
                            $row = $result->fetch_assoc();
                ?>

                <form action="update_script.php" method="post">
                    <h4 class="border-bottom">Basic Details</h4>
                    <div class="row">
                        <input type="hidden" name="people_id" value="<?php echo $row['id']; ?>">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="userName" placeholder="First Last" onfocusout="capitaliseName(this)" value="<?php echo $row['name']; ?>" required>
                                <label for="floatingInput">Full name</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="userEmail" placeholder="name@example.com" value="<?php echo $row['email']; ?>" required readonly>
                                <label for="floatingInput">Email address</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingInput" name="userDOB" placeholder="28" value="<?php echo $row['dob']; ?>" required readonly>
                                <label for="floatingPassword">Date</label>
                            </div>
                        </div>
                    </div>

                    <h4 class="border-bottom mt-4">Permanent Address</h4>
                    <div class="row">
                        <input type="hidden" name="permanent_id" value="<?php echo $row['permanent_id']; ?>">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" name="userPerCont" placeholder="98xxxxxx80" min="6000000000" max="9999999999" value="<?php echo $row['permanent_contact']; ?>" required>
                                <label for="floatingInput">Phone number</label>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="userPerAddr" placeholder="Address" onfocusout="capitaliseAddress(this)" value="<?php echo $row['permanent_address']; ?>" required>
                                <label for="floatingInput">Address</label>
                            </div>
                        </div>
                    </div>

                    <h4 class="border-bottom mt-4">Postal Address <button type="button" class="btn btn-secondary btn-sm ms-2" onclick="copyContactInformation()">Same as permanent</button></h4>
                    <div class="row">
                        <input type="hidden" name="postal_id" value="<?php echo $row['postal_id']; ?>">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" name="userPosCont" placeholder="75xxxxxx46" min="6000000000" max="9999999999" value="<?php echo $row['postal_contact']; ?>" >
                                <label for="floatingInput">Phone number</label>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="userPosAddr" placeholder="Address" onfocusout="capitaliseAddress(this)" value="<?php echo $row['postal_address']; ?>">
                                <label for="floatingInput">Address</label>
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-lg" value="Update">
                </form>

            </div>
        </div>
            <?php       }
                    } else {?>
                        <p class="fs-3 text-center alert alert-warning">Could not recoznise which data to load.</p>
                <?php
                    }
                ?>

    <script>
        function capitaliseName(ele){
            splitStr = ele.value.split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1).toLowerCase();     
            }
            ele.value = splitStr.join(' ');
        }

        function capitaliseAddress(ele){
            splitStr = ele.value.split(/[,]+/);

            for (var i = 0; i < splitStr.length; i++) {
                if(splitStr[i].includes('.')){
                    let subStrSplit = splitStr[i].split(/[.]+/);
                    for (var j = 0; j < subStrSplit.length; j++) {
                        subStrSplit[j] = subStrSplit[j].trim().charAt(0).toUpperCase() + subStrSplit[j].trim().substring(1).toLowerCase();
                    }
                    splitStr[i] = subStrSplit.join('. ');
                } else {
                    splitStr[i] = splitStr[i].trim().charAt(0).toUpperCase() + splitStr[i].trim().substring(1).toLowerCase();
                }
            }
            ele.value = splitStr.join(', ');
        }

        function copyContactInformation(){
            document.getElementsByName('userPosCont')[0].value = document.getElementsByName('userPerCont')[0].value;
            document.getElementsByName('userPosAddr')[0].value = document.getElementsByName('userPerAddr')[0].value;
        }
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>