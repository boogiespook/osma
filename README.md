# osma2

## Create the MySQL/MariaDB database using database.sql and create a user:
\# mysql -u <username> -p osma < database.sql

MariaDB [osma]> INSERT INTO `users` (`id`, `email`, `password`, `name`, `uuid`, `lastUpdate`) VALUES (NULL, 'test@asd.com', MD5('password'), 'Test User', '', current_timestamp())

### Registration uses a CAPTCHA to authenticate users.  Setup an API key from:  http://www.phpcaptcha.org
