#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\FinderCommand;

$application = new Application();

$application->add(new FinderCommand());

$application->run();
