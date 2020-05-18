# Поиск вхождений в файле

#### Как работать:

Шаблон команды `app:find <value> <path> [--type]`

- `app:find` - команда для поиска вхождений.
- `value` - значение для поиска.
- `path` - полный путь до файла.
- `--type или -t` - опция для указания типа поиска.
- `--type=substring` - поиск вхождения строки в указанный файл.
- `--type=hash` - сравнение хэш-суммы (на данный момент недоступно).

- Также справка доступна по команде: `php bin/console app:find --help`.

Пример использования: `php bin/console app:find localhost /etc/hosts --type=substring`

<a href="https://asciinema.org/a/EWohr9HGAAmYZOPrs6ScKUXj9" target="_blank"><img src="https://asciinema.org/a/EWohr9HGAAmYZOPrs6ScKUXj9.svg" /></a>