# Микросервис по агрегации данных из свободных источников прогноза погоды

## Содержание

* [Установка приложения](#установка-приложения)
* [Работа с API](#работа-с-api)

## Установка приложения

системные требования:
```text
    PHP version 8.0.0 or higher
    Composer 2.0 or higher
    PDO PHP Extension
    cURL PHP Extension
    OpenSSL PHP Extension
    Mbstring PHP Extension
    ZipArchive PHP Extension
    GD PHP Extension
    SimpleXML PHP Extension.
```
```text
    MySQL 5.7 or MariaDB 10.2.
```

1. Клонируем репозиторий:

```text
git clone git@github.com:fruskate/CloudCastService.git {path}
```

2. Переходим в `{path}` и устанавливаем пакеты Composer:

```text
composer install
```

3. Добавляем базу данных любым известным и привлекательным нам способом.

4. Создадим файл с настройками окружения, для этого скопируем в корне проекта `.env.example` `->` `.env`

Будьте внимательны, чтобы заменить данные подключения к БД, а также URL проекта в `.env` файле:

```text
APP_URL=https://weather.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=weather
DB_USERNAME=root
DB_PASSWORD=
```

5. Выполним все миграции:

```text
php artisan october:migrate
```

6. Сгенерируем ключ приложения (он добавится в .env файл)

```text
php artisan key:generate
```

7. Теперь через браузер смело идём в backend приложения по адресу (из .env файла) `https://weather.test/admin/` и
регистрируем(создаём аккаунт) админа.

8. Вуаля, мы в админке. Давайте настроим пару погодных провайдеров. Для этого перейдём в `Weather` `->` `Weather Provider`
и нажмём на кнопочку `Создать`.

Далее выберим тип провайдера `openweathermap.org` проверим чтобы свитч показывал что провайдер активен и добавим API
ключик: `210a6469c633f37a2d9a6738a59ab633` - да, я уже его получил =)

Сохраним.

Нам надо минимально 2 погодных провайдера создать, поэтому добавим второй:

тип провайдера: `weatherapi.com`
ключ: `e9dd73fdc3cd490791362926240805`

Сохраним.

9. Не забываем настроить `CRON` у себя в окружении. Смысл в том, чтобы каждую минуту выполнялась команда:

```text
php artisan schedule:run
```

Как правило достаточно записи в crontab:

```text
* * * * * php /path_to_project/artisan schedule:run >> /dev/null 2>&1
```

10. Проверяем стандартно настройки очередей. По умолчанию настроено на `redis` - у меня поднят локально.

11. Наслаждаемся.

## Работа с API

фух, в разработке ))
