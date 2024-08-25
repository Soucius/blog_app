<?php
    include "partials/header.php";
    include "options/database.php";
    include "partials/nav.php";

    $blogQuery = $connection->prepare("select * from blogs");
    $blogQuery->execute();
    $blogs = $blogQuery->fetchAll(PDO::FETCH_ASSOC);
    $totalBlogs = $blogQuery->rowCount();
?>
    <div class="container mt-5">
        <div class="card mx-auto">
            <div class="card-header text-center bg-primary text-white">
                <h2 class="card-title">Latest Blogs</h2>
            </div>
    
            <div class="card-body">
                <div class="row align-items-start">
                    <?php
                        foreach ($blogs as $blog) {
                            ?>
                            <div class="col-6 col-md-4 col-sm-6 col-xs-12 mb-3 mx-3">
                                <div class="card" style="width: 18rem; height: auto;">
                                    <img src="<?= $blog['img']; ?>" class="card-img-top" alt="<?= $blog['title']; ?>">
            
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $blog['title']; ?></h5>
            
                                        <p class="card-text"><?= $blog['body']; ?></p>

                                        <p class="card-text">Creator: <b><?= $blog['creator']; ?></b></p>

                                        <span class="card-text"><?= $blog['createdDate']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
    
            <div class="card-footer">
                <span>Total blogs: <?= $totalBlogs; ?></span>
            </div>
        </div>
    </div>

<?php include "partials/footer.php"; ?>