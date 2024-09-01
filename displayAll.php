<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <title>People</title>
    </head>
    <body>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Enter Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="displayAll.php">Display Data</a>
            </li>
        </ul>

        <?php
            if(isset($_GET['status']) && $_GET['status']>0){
                if ($_GET['status'] == 1){
                    $msg = "User data stored.";
                } elseif($_GET['status'] == 5) {
                    $msg = "Basic Information Updated.";
                } elseif($_GET['status'] == 4 || $_GET['status'] == 3) {
                    $msg = "Contact Information Updated.";
                } elseif($_GET['status'] == 6 || $_GET['status'] == 10 || $_GET['status'] == 15) {
                    $msg = "Postal contact details added & Information Updated.";
                } elseif($_GET['status'] == 7) {
                    $msg = "User has been deactivated.";
                }
                ?>
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Success!</strong> <?php echo $msg?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif(isset($_GET['status']) && $_GET['status'] == 0){
                ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Something seems wrong!!</strong> User information could not be updated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }

        ?>

        <div class="row mt-4">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Basic Details</th>
                    <th>Contact Information</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
                require_once 'connection.php';

                $fetchStatement = $con->prepare("SELECT t1.id, t1.name, t1.email, t1.dob, t2.contact AS 'permanent_contact', t2.address AS 'permanent_address', t3.contact AS 'postal_contact', t3.address AS 'postal_address'
                                                    FROM basic_information t1 
                                                    LEFT JOIN contact_information t2 ON t1.id = t2.basic_id AND t2.type='Permanent' 
                                                    LEFT JOIN contact_information t3 ON t1.id = t3.basic_id AND t3.type='Post' 
                                                    WHERE delete_status = 'N' 
                                                    ORDER BY t1.id DESC");
                $fetchStatement->execute();
                $result = $fetchStatement->get_result();
                $index = 1;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $index; ?>.</td>
                                <td>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?php echo $row['name']; ?></h5>
                                            <small class="text-body-secondary"><?php echo date( 'd M Y', strtotime( $row['dob'] ) ); ?></small>
                                            </div>
                                            <p class="mb-1"><?php echo $row['email']; ?></p>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <h6>Permanent:</h6>
                                    <figure>
                                        <blockquote class="blockquote">
                                            <p><small><?php echo $row['permanent_address']; ?></small></p>
                                        </blockquote>
                                        <figcaption class="blockquote-footer">
                                        Phone: <?php echo $row['permanent_contact']; ?>
                                        </figcaption>
                                    </figure>
                                    <?php if(!empty($row['postal_address'])){ ?>
                                        <hr width="60%">
                                        <h6>Postal:</h6>
                                        <figure>
                                            <blockquote class="blockquote">
                                                <p><small><?php echo $row['postal_address']; ?></small></p>
                                            </blockquote>
                                            <figcaption class="blockquote-footer">
                                            Phone: <?php echo $row['postal_contact']; ?>
                                            </figcaption>
                                        </figure>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="update_form.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i> Update</a>
                                    <a href="delete_script.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php
                        $index++;
                    }
                }
            ?>
            </tbody>
        </table>

        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>