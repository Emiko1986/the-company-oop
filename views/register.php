<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid">
       <div class="card w-25 mx-auto my-5">
            <div class="card-header text-center text-success">
                <h1>REGISTER</h1>
            </div>
            <div class="card-body">
                <form action="../actions/register-action.php" method="post">
                    <div class="row mb-2">
                        <div class="col">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>

                    <input type="submit" name="btn_register" class="btn btn-success w-100" value="Register">
                </form>
            </div>
       </div>
    </div>
    



</body>
</html>