<?php namespace WinkForm;

/**
 * file containing the required setup
 * @author b-deruiter
 */


// constants
if (! defined('BRCLR'))
    define('BRCLR', '<br class="clear" />');


// helper functions
require_once 'helpers.php';



// autoloader
if (! defined('WINKFORM_PATH'))
    define('WINKFORM_PATH', __DIR__.'/');

spl_autoload_register(function($class) {
    
    $file = trim(substr($class, strrpos($class, "\\")), "\\") . '.php';
    
    // library root
    if (file_exists(WINKFORM_PATH . $file))
        require_once WINKFORM_PATH . $file;
    // library Input classes
    elseif (file_exists(WINKFORM_PATH . 'Input/' . $file))
        require_once WINKFORM_PATH . 'Input/' . $file;
    
    // else not found. Maybe another autoloader will find the class
});
