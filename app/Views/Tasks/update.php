<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Update task
            </div>
            <div class="card-body">
                <form  action="<?php echo prepareUrl('/tasks/update?taskId=' . $task->getId()); ?>" method="post">
                    <div class="form-group">
                        <label for="InputUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="InputUsername" name="username" value="<?php echo $task->getUsername(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" value="<?php echo $task->getEmail(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="InputDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="InputDescription" name="description" value="<?php echo $task->getDescription(); ?>">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="statusBox" name="status" <?php echo $task->getStatus() === 1 ? "checked" : "" ; ?>>
                        <label for="statusBox" class="form-check-label">Done</label>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
