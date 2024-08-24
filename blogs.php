<?php
    include "partials/header.php";
    include "options/database.php";
    include "partials/nav.php";

    $currentUser = $_SESSION["username"];
    $blogQuery = $connection->prepare("select * from blogs where creator = :creator");
    $blogQuery->execute([":creator" => $currentUser]);
    $userBlogs = $blogQuery->fetchAll(PDO::FETCH_ASSOC);
    $totalUserBlogs = $blogQuery->rowCount();
?>
    <div class="container mt-5">
        <div class="card mx-auto">
            <div class="card-header text-center bg-primary text-white">
                <h2 class="card-title">Your Blogs</h2>
            </div>

            <div class="container mt-3 mb-3 text-center">
                <a href="createBlog.php" class="btn btn-success">Create Blog</a>
            </div>

            <div class="row">
                <?php
                    foreach ($userBlogs as $userBlog) {
                        ?>
                        <div class="col-4 mb-3">
                            <div class="card-body">
                                <div class="container">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?= $userBlog['img']; ?>" class="card-img-top" alt="<?= $userBlog['title']; ?>">
        
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $userBlog['title']; ?></h5>
        
                                            <p class="card-text"><?= $userBlog['body']; ?></p>
        
                                            <p class="card-text"><?= $userBlog['createdDate']; ?></p>
                                        </div>

                                        <div class="card-footer">
                                            <form action="updateBlog.php" method="post">
                                                <input type="submit" class="btn btn-info text-white" name="updateForm" value="Update Blog">
                                            </form>

                                            <form action="deleteBlog.php" method="post">
                                                <input type="submit" class="btn btn-danger" value="Delete Blog">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
    
            <div class="card-footer">
                <span>Total blogs: <?= $totalUserBlogs; ?></span>
            </div>
        </div>
    </div>

<?php include "partials/footer.php"; ?>