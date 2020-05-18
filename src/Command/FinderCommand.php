<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\OccurrenceFinder;

class FinderCommand extends Command
{
    protected static $defaultName = 'app:find';

    protected function configure()
    {
        $this
            ->setDescription('Поиск вхождений в файле')
            ->addArgument('value', InputArgument::REQUIRED, 'Значение для поиска.')
            ->addArgument('path', InputArgument::REQUIRED, 'Путь до файла. Необходимо указать полный путь до файла в локальной файловой системе.')
            ->addOption('type', 't', InputOption::VALUE_REQUIRED, 'Тип операции, которую нужно выполнить с файлом. substring - поиск вхождения строки, hash - сравнение хэш-суммы.', ['substring', 'hash']);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $value = $input->getArgument('value');
        $path = $input->getArgument('path');
        $operationType = $input->getOption('type');

        if (is_array($operationType)) {
            $output->writeln("<error>Необходимо выбрать тип опции --type=substring или --type=hash</error>");
            exit();
        } elseif ($operationType === 'substring') {
            $occurrenceFinder = new OccurrenceFinder();
            $result = $occurrenceFinder->find($value, $path);
        }

        /*
           Подключение модуля для сравнения хэш-суммы

           elseif ($operationType === 'hash') {
               ...
           }
         */

        if (!empty($result['error'])) {
            $output->writeln($result['error']);
            exit();
        }

        foreach ($result['response'] as $item) {
            $output->writeln("<info>{$item}</info>");
        }

        return 0;
    }
}