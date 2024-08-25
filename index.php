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
                <a class="nav-link active" aria-current="page" href="index.php">Enter Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="displayAll.php">Display Data</a>
            </li>
        </ul>

        <div class="row mt-4">

            <form action="" method="post">
                <h4 class="border-bottom">Basic Details</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="First Last" onfocusout="capitaliseName(this)">
                            <label for="floatingInput">Full name</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                    </div>
                    <div class="col-1">D.O.B:</div>
                    <div class="col-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" placeholder="19-12-2022">
                            <label for="floatingPassword">Date</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" placeholder="19-12-2022">
                            <label for="floatingPassword">Month</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" placeholder="19-12-2022">
                            <label for="floatingPassword">Year</label>
                        </div>
                    </div>
                </div>

                <h4 class="border-bottom mt-4">Permanent Address</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="First Last">
                            <label for="floatingInput">Phone number</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="First Last" onfocusout="capitaliseAddress(this)">
                            <label for="floatingInput">Address</label>
                        </div>
                    </div>
                </div>

                <h4 class="border-bottom mt-4">Postal Address <button type="button" class="btn btn-secondary btn-sm ms-2">Same as permanent</button></h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="First Last">
                            <label for="floatingInput">Phone number</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="First Last" onfocusout="capitaliseAddress(this)">
                            <label for="floatingInput">Address</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </form>

        </div>
    </div>

    <script>
        function capitaliseName(ele){
            splitStr = ele.value.split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1).toLowerCase();     
            }
            ele.value = splitStr.join(' ');
        }

        function capitaliseAddress(ele){
            splitStr = ele.value.split(/[,.]+/);
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
            }
            console.log(splitStr);
            ele.value = splitStr.join(' ');
        }
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>