# Поиск вхождений в файле

#### Установка:

- `composer require symfony/flex`
- `composer require vladimirloskutov/promokrot:dev-master`

Packagist: `https://packagist.org/packages/vladimirloskutov/promokrot`

#### Как работать:

Шаблон команды `app:find <value> <path> [--type]`

- `app:find` - команда для поиска вхождений.
- `value` - значение для поиска.
- `path` - полный путь до файла.
- `--type или -t` - опция для указания типа поиска.
- `--type=substring` - поиск вхождения строки в указанный файл.
- `--type=hash` - сравнение хэш-суммы (на данный момент недоступно).

- Также справка доступна по команде: `php bin/console app:find --help`.

#### Пример установки и использования:
<a href="https://asciinema.org/a/Bs4UPJdnjsjl5GeV9CuU1BXaS" target="_blank"><img src="https://asciinema.org/a/Bs4UPJdnjsjl5GeV9CuU1BXaS.svg" /></a>