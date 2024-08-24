<?php

    include "options/database.php";
    include "partials/header.php";
    include "partials/nav.php";
    $date = date("Y-m-d H:i:s");
?>

<div class="container mt-5">
    <div class="card mx-auto">
        <div class="card-header text-center bg-success text-white">
            <h2 class="card-title">Create Blog</h2>
        </div>

        <div class="card-body">
            <?php
                if ($_POST) {
                    $blogTitle = $_POST['blogTitle'];
                    $blogBody = $_POST['blogBody'];
                    $blogImage = $_POST['blogImage'];

                    if ($blogTitle != "" and $blogBody != "" and $blogImage != "") {
                        $currentUser = $_SESSION['username'];

                        $userQuery = $connection->prepare("select username from users where username = :username");
                        $userQuery->execute([
                            ":username" => $currentUser,
                        ]);
                        $user = $userQuery->fetch(PDO::FETCH_ASSOC);

                        if ($userQuery->rowCount() > 0) {
                            $blogQuery = $connection->prepare("insert into blogs (title, body, creator, img, createdDate) values (:title, :body, :creator, :img, :createdDate)");
                            $blogQuery->execute([
                                ":title" => $blogTitle,
                                ":body" => $blogBody,
                                ":creator" => $currentUser,
                                ":img" => $blogImage,
                                ":createdDate" => $date,
                            ]);

                            echo "<div class='container bg-success text-center text-white mb-3 py-3'>Blog created succesfully</div>";
                            header("refresh:1, url=blogs.php");
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
                <label for="blogTitle" class="form-label fw-bold">Blog Title</label>
                <input type="text" class="form-control" name="blogTitle" placeholder="blog title...">
              </div>
            
              <div class="form-group mb-3">
                <label for="blogBody" class="form-label fw-bold">Blog Body</label>
                <textarea class="form-control" name="blogBody" placeholder="blog body..." id="blogBody"></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="blogImage" class="form-label fw-bold">Blog Image</label>
                <input type="text" class="form-control" name="blogImage" placeholder="blog image (url)...">
              </div>
            
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="card-footer">
            <p>Creating Date: <b><?= $date; ?></b></p>
            <p>Creator: <b><?= $_SESSION['username']; ?></b></p>
        </div>
    </div>
</div>