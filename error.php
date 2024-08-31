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
                <a class="nav-link" href="displayAll.php">Display Data</a>
            </li>
        </ul>

        <div class="row mt-4">

            <p class="fs-3 text-center alert alert-danger"><i class="bi bi-exclamation-octagon"></i> Ah haan haan... Caught you!</p>
            <p class="fs-5 text-center">Whatever you were trying to do won't work.
                <?php 
                    if (isset($_GET['message'])){
                        echo $_GET['message'];
                    } else {
                        echo "Check the data you are trying to submit.<br>";
                    }
                ?>
            </p>

        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>