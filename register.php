<?php

    include "options/database.php";
    include "partials/header.php";
?>

<div class="container mt-5">
    <div class="card mx-auto">
        <div class="card-header text-center bg-light">
            <h2 class="card-title">Register</h2>
        </div>

        <div class="card-body">
            <?php
                if ($_POST) {
                    $username = $_POST['formUsername'];
                    $password = $_POST['formPassword'];
                    $passwordConfirm = $_POST['formPasswordConfirm'];
                    $date = date("Y-m-d H:i:s");

                    if ($username != "" and $password != "" and $passwordConfirm != "" and $password == $passwordConfirm) {
                        $userQuery = $connection->prepare("insert into users (username, password, createdDate) values (:username, :password, :createdDate)");
                        $userQuery->execute([
                            ":username" => $username,
                            ":password" => md5($password),
                            ":createdDate" => $date,
                        ]);

                        if ($userQuery->rowCount() > 0) {
                            $_SESSION['username'] = $username;

                            echo "<div class='container bg-success text-center text-white mb-3 py-3'>User created succesfully</div>";
                            header("refresh:1, url=index.php");
                        } else {
                            echo "<div class='container bg-danger text-center text-white mb-3 py-3'>Failed</div>";
                        }
                    } else {
                        echo "<div class='container bg-danger text-center text-white mb-3 py-3'>Fill the all inputs please!</div>";
                    }
                }
            ?>

            <form method="post">
              <div class="form-group mb-3">
                <label for="formUsername" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control" name="formUsername" placeholder="username...">
              </div>
            
              <div class="form-group mb-3">
                <label for="formPassword" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control" name="formPassword" placeholder="password...">
              </div>

              <div class="form-group mb-3">
                <label for="formPasswordConfirm" class="form-label fw-bold">Password Confirm</label>
                <input type="password" class="form-control" name="formPasswordConfirm" placeholder="password confirm...">
              </div>
            
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="card-footer">
            <a href="login.php">Have an account? Login here.</a>
        </div>
    </div>
</div>