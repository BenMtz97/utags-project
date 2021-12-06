<?php

/* @var $this yii\web\View */
/* @var $users Array */

$this->title = 'Gestion de Usuarios';
?>
<div class="site-index">
    <h1><?= $this->title ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th> # </th>
                <th> Name </th>
                <th> Username </th>
                <th> Email </th>
                <th> Birth </th>
                <th> Phone </th>
                <th> Country </th>
                <th> Type </th>
                <th> Actions </th>
            </tr>
        </thead>
       <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name']. " " . $user['lastname'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['birth'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['country_name'] ?></td>
                    <td><?= $user['type'] == 2 ? 'admin' : 'regular' ?></td>
                    <td>
                        <a title="Delete user" href="/site/delete-user?id=<?=$user['id']?>" type="button" class="btn btn-xs btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
       </tbody>
    </table>
</div>
