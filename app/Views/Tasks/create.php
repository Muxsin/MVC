<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Создать задачу
            </div>
            <div class="card-body">
                <form  action="/tasks/store" method="post">
                    <div class="form-group">
                        <label for="InputUsername" class="form-label">Имя пользователя</label>
                        <input type="text" class="form-control" id="InputUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail" class="form-label">Эл. почта</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="InputDescription" class="form-label">Текст задачи</label>
                        <input type="text" class="form-control" id="InputDescription" name="description">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
