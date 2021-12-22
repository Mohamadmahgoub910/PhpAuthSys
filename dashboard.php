<?php
require 'index.php';
require 'conn-db.php';
echo 'welcome '. $_SESSION['user']['name'];
$stm = "SELECT * FROM users";
        $q = $conn->prepare($stm);
        $q->execute();
        $data = $q->fetch();
?>
<h3>This is dashboard </h3>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['name'] ?></td>
            <td><?= $data['email'] ?></td>
            <td><?= $data['prev'] ?></td>

        </tr>
    </tbody>
</table>
<a href="logout.php">logout</a>