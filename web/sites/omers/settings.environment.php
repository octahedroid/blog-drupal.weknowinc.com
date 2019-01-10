<?php

// Load .env file if exists
if (file_exists(dirname(DRUPAL_ROOT) . '/.env')) {
    // Load environment
    $dotEnv = new \Symfony\Component\Dotenv\Dotenv();
    $dotEnv->load(dirname(DRUPAL_ROOT) . '/.env');
}

# Load environment name
$env = getenv('ENVIRONMENT');

if (!$env) {
    return;
}

$base_path = $app_root . '/' . $site_path;
$servicesFile = $base_path . '/services.'.$env.'.yml';
$settingsFile = $base_path . '/settings.'.$env.'.php';

// Load services definition file.
if (file_exists($servicesFile)) {
    $settings['container_yamls'][] = $servicesFile;
}

// Load settings file.
if (file_exists($settingsFile)) {
    include $settingsFile;
}

$databases['default']['default'] = array (
    'database' =>  getenv('DATABASE_NAME_OMERS'),
    'username' => getenv('DATABASE_USER_OMERS'),
    'password' => getenv('DATABASE_PASSWORD_OMERS'),
    'prefix' => '',
    'host' => getenv('DATABASE_HOST_OMERS'),
    'port' => getenv('DATABASE_PORT'),
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
);
