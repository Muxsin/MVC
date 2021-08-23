# Introduction
Hello from **Muhsin** 👋. First of all thanks for viewing my repository, I'm glad 🤝. If you clone my repository please keep an eye on starting settings on <a href="#settings">*below*</a> 👇.
# Settings
1) Run this command on terminal to load **project dependencies**:
```
 composer install
```
2) Copy **config.ini.example** file, change name to **config.ini** and setting it. For emaxple:
```ini
[admin]
username = admin
password = secret
[mysql]
hostname = localhost:3306
database = mvc
username = root
password = secret

```
3) Create **"tasks"** table on your database:
```mysql
CREATE TABLE tasks (id int not null primary key auto_increment, username varchar(255), email varchar(255),  description varchar(255), status int, updated int);
```
4) Serve the application:
```bash
php -S localhost:8000 -t public
```
5) Enjoy it 😊
