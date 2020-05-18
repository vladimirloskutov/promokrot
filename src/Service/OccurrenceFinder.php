<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class OccurrenceFinder
{
    public function find(string $substring, string $path): array
    {
        if (strpos($path, 'http') !== false) {
            $result['error'] = $this->validateUrl($path);
        } else {
            $result['error'] = $this->validate($path);
        }

        if(!empty($result['error'])) {
            return $result;
        }

        $result['response'][] = "<comment>Строка для поиска: \"{$substring}\"</comment>";
        $result['response'][] = "<comment>Результат поиска:</comment>";

        $position = 0;
        $lineNumber = 1;

        $file = fopen($path, 'r');

        while (!feof($file)) {
            $line = fgets($file);

            while (($position = mb_stripos($line, $substring, $position))!== false) {
                $result['response'][] = sprintf('Номер строки: %d Позиция в строке: %d', $lineNumber, $position + 1);
                $position += mb_strlen($substring);
            }

            $lineNumber++;
        }

        if (count($result['response']) === 2) {
            $result['response'][] = "<error>Вхождения не найдены</error>";
        }

        fclose($file);
        return $result;
    }

    private function validate(string $path): string
    {
        $error = '';
        $fileConstraints = Yaml::parseFile(__DIR__ . '/../../config/constraints.yaml');

        if (!is_file($path)) {
            $error = "<error>Укажите корректный путь до файла</error>";
        } elseif (!in_array(mime_content_type($path), $fileConstraints['fileConstraints']['mime-type'])) {
            $error = "<error>Укажите файл корректного формата</error>";
        } elseif (filesize($path) > $fileConstraints['fileConstraints']['filesize']) {
            $error = "<error>Размер файла должен быть не более 1 Мб</error>";
        }

        return $error;
    }

    private function validateUrl(string $path): string
    {
        $error = '';
        $headers = get_headers($path);

        if(strpos('200', $headers[0])) {
            $error = "<error>Укажите корректный путь до файла</error>";
        }

        return $error;
    }
}