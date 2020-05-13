<?php $this->layout('layout')?>



<div class="container">
    <div class="row">
        <!-- <a href="/login">Login</a> -->
        <div class="col-md-12">
            <h1>All Tasks</h1>
            <a href="/tasks/create" class="btn btn-success">Add Task</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?=$task['id'];?></td>
                        <td><?=$task['title'];?></td>
                        <td>
                            <a href="/tasks/<?=$task['id'];?>" class="btn btn-info">
                                Show
                            </a>
                            <a href="/tasks/<?=$task['id'];?>/edit" class="btn btn-warning">
                                Edit
                            </a>
                            <a onclick="return confirm('are you sure?');" href="/tasks/<?=$task['id'];?>/delete" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
</div>
