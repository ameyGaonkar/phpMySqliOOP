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

            <form action="insert_script.php" method="post">
                <h4 class="border-bottom">Basic Details</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="userName" placeholder="First Last" onfocusout="capitaliseName(this)" required>
                            <label for="floatingInput">Full name</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="userEmail" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                    </div>
                    <div class="col-1 my-auto text-end">D.O.B:</div>
                    <div class="col-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" name="userDOBDate" placeholder="28" min="1" max="31" required>
                            <label for="floatingPassword">Date</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" name="userDOBMonth" placeholder="08" min="1" max="12" required>
                            <label for="floatingPassword">Month</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" name="userDOBYear" placeholder="2004" min="1900" max="2006" required>
                            <label for="floatingPassword">Year</label>
                        </div>
                    </div>
                </div>

                <h4 class="border-bottom mt-4">Permanent Address</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="userPerCont" placeholder="98xxxxxx80" min="6000000000" max="9999999999" required>
                            <label for="floatingInput">Phone number</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="userPerAddr" placeholder="Address" onfocusout="capitaliseAddress(this)" required>
                            <label for="floatingInput">Address</label>
                        </div>
                    </div>
                </div>

                <h4 class="border-bottom mt-4">Postal Address <button type="button" class="btn btn-secondary btn-sm ms-2" onclick="copyContactInformation()">Same as permanent</button></h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="userPosCont" placeholder="75xxxxxx46" min="6000000000" max="9999999999" required>
                            <label for="floatingInput">Phone number</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="userPosAddr" placeholder="Address" onfocusout="capitaliseAddress(this)" required>
                            <label for="floatingInput">Address</label>
                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary btn-lg" value="submit">
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