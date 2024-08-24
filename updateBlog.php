<?php

    include "options/database.php";
    include "partials/header.php";
    include "partials/nav.php";
    $date = date("Y-m-d H:i:s");

    $previousDataQuery = $connection->prepare("select * from blogs where creator = :creator");
    $previousDataQuery->execute([
        ":creator" => $_SESSION['username']
    ]);
    $previousDatas = $previousDataQuery->fetchAll(PDO::FETCH_ASSOC);
    $previousDataNumber = $previousDataQuery->rowCount();
?>

<div class="container mt-5">
    <div class="card mx-auto">
        <div class="card-header text-center bg-success text-white">
            <h2 class="card-title">Update Blog</h2>
        </div>

        <div class="card-body">
            <?php
                $previousBlogTitle = "";
                $previousBlogBody = "";
                $previousBlogImage = "";

                if ($_POST["updateForm"]) {
                    foreach ($previousDatas as $previousData) {
                        $previousBlogTitle = $previousData['title'];
                        $previousBlogBody = $previousData['body'];
                        $previousBlogImage = $previousData['img'];
                    }
                }

                if (@$_POST['updatedForm']) {
                    $currentDataQuery = $connection->prepare('insert into (title, body, img) values (:title, :body, :img)');
                    $currentDataQuery->execute([
                        ":title" => $_POST['currentBlogTitle'],
                        ":body" => $_POST['currentBlogBody'],
                        ":img" => $_POST['currentBlogImage'],
                    ]);
                }
            ?>

            <form method="post">
              <div class="form-group mb-3">
                <label for="currentBlogTitle" class="form-label fw-bold">Blog Title</label>
                <input type="text" class="form-control" name="currentBlogTitle" placeholder="blog title..." value="<?= $previousBlogTitle; ?>">
              </div>
            
              <div class="form-group mb-3">
                <label for="currentBlogBody" class="form-label fw-bold">Blog Body</label>
                <textarea class="form-control" name="currentBlogBody" placeholder="blog body..." id="currentBlogBody"><?= $previousBlogBody; ?></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="currentBlogImage" class="form-label fw-bold">Blog Image</label>
                <input type="text" class="form-control" name="currentBlogImage" placeholder="blog image (url)..." value="<?= $previousBlogImage; ?>">
              </div>
            
              <button type="submit" name="updatedForm" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="card-footer">
            <p>Creating Date: <b><?= $date; ?></b></p>
            <p>Creator: <b><?= $_SESSION['username']; ?></b></p>
        </div>
    </div>
</div>