<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Вход
            </div>
            <div class="card-body">
                <form action="<?php echo prepareUrl('/auth') ?>" method="post">
                    <div class="form-group">
                        <label for="InputUsername" class="form-label">Имя пользователя</label>
                        <input type="text" class="form-control" id="InputUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Вход</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
