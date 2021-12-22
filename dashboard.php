<?php
require 'index.php';
require 'conn-db.php';
echo 'welcome '. $_SESSION['user']['name']. ' <span style="color:red;" > and This is dashboard </span>' ;
$stm = "SELECT id,name,email,prev FROM users";
        $q = $conn->prepare($stm);
        $q->execute();
        $data = $q->fetch();
?>

<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
            <th scope="col">notes</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['name'] ?></td>
            <td><?= $data['email'] ?></td>
            <td><?= $data['prev'] ?></td>
            <td>
                <i style="color: green;" class="fa fa-edit" aria-hidden="true"></i>
                <i style="color: red;" class="fa fa-trash" aria-hidden="true"></i>
            </td>



        </tr>
    </tbody>
</table>
<a href="logout.php">logout</a>