<?php
    include "partials/header.php";
    include "options/database.php";

    $usersQuery = $connection->prepare("select * from users");
    $usersQuery->execute();
    $users = $usersQuery->fetchAll(PDO::FETCH_ASSOC);
    $totalUsers = $usersQuery->rowCount();

    include "partials/nav.php";
?>
    <div class="container mt-5">
        <div class="card mx-auto">
            <div class="card-header text-center bg-primary text-white">
                <h2 class="card-title">Users</h2>
            </div>
    
            <div class="card-body">
                <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Register Date</th>
                            </tr>
                        </thead>
            
                        <tbody>
                            <?php
                                foreach ($users as $user) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $user['id']; ?></th>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['createdDate']; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="card-footer">
                <span>Total users: <?= $totalUsers; ?></span>
            </div>
        </div>
    </div>

<?php include "partials/footer.php"; ?>