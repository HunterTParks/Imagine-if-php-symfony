<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/** @var ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('AppBundle\Controller', __DIR__.'/../vendor/phpauth');
$loader->add('AppBundle\Controller', __DIR__.'/../src/AppBundle/Entity/User');

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
