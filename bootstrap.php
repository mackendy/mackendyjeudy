<?php
define('WEBROOT',   dirname(__FILE__));
define('ROOT',      dirname(WEBROOT));
define('DS',        DIRECTORY_SEPARATOR);
define('CORE',      WEBROOT.DS."app");
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define("CSS", CORE.DS."webroot".DS."css");
define("JS", BASE_URL.DS."webroot".DS."js");

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("models");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'doctrine',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);



