<?php

if ( !defined('ABSPATH') ) {
    define('ABSPATH', dirname(__FILE__) . '/');
}
if ( !defined('ROOT_PATH') ) {
    define('ROOT_PATH', realpath(__DIR__.'/../') . '/');
}

/**
* Define type of server
*
* Depending on the type other stuff can be configured
* Note: Define them all, don't skip one if other is already defined
*/

define( 'LOCAL_SERVER', file_exists( ABSPATH . '/local-config.php' ) );

if ( LOCAL_SERVER )
    require ABSPATH . '/local-config.php';
else
    require ABSPATH . '/production-config.php';

?>
