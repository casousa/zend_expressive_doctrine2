<?php

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\I18n\Translator\Translator;
use Zend\Mvc\I18n\Translator as TranslatorMvc;

// Load configuration
$config = require __DIR__ . '/config.php';

// Doctrine configuration
$config['doctrine_em'] = require __DIR__ . '/doctrine.config.php';

// Build container
$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

$translator = new Translator();
$translator->addTranslationFile(
    'phpArray',
    './vendor/zendframework/zend-i18n-resources/languages/pt_BR/Zend_Validate.php',
    'default',    
    'pt_BR'
);
$translatorMvc = new TranslatorMvc($translator);
\Zend\Validator\AbstractValidator::setDefaultTranslator($translatorMvc);

return $container;
