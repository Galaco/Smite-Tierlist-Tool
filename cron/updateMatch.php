#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/AppKernel.php';

use MatchBundle\Console\Command\UpdateMatchCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;

$kernel = new AppKernel('prod', false);
$application = new Application($kernel);
$application->add(new UpdateMatchCommand());
$application->run();