<?php

    include "options/database.php";
    include "partials/header.php";
?>

<div class="container mt-5">
    <div class="card mx-auto">
        <div class="card-header text-center bg-light">
            <h2 class="card-title">Login</h2>
        </div>

        <div class="card-body">
            <?php
                if ($_POST) {
                    $username = $_POST['formUsername'];
                    $password = $_POST['formPassword'];

                    if ($username != "" and $password != "") {
                        $userQuery = $connection->prepare("select * from users where username = :username");
                        $userQuery->execute([
                            ":username" => $username
                        ]);

                        if ($userQuery->rowCount() > 0) {
                            echo "<div class='container bg-success text-center text-white mb-3 py-3'>Succesfully logged in</div>";
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
            
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="card-footer">
            <a href="register.php">Do not have an account? Register here.</a>
        </div>
    </div>
</div>