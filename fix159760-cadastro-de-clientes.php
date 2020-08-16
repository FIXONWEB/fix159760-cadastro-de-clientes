<?php
/**
 * Plugin Name:     Fixonweb - Ref.: 159760 - Cadastro de Clientes
 * Plugin URI:      https://fixonweb.com.br/fix159760-cadastro-de-clientes
 * Description:     Cadastro de Clientes
 * Author:          FIXONWEB
 * Author URI:      https://fixonweb.com.br
 * Text Domain:     fix159760-cadastro-de-clientes
 * Domain Path:     /languages
 * Version:         0.1.1
 *
 * @package         Fix159760_Cadastro_De_Clientes
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

require 'plugin-update-checker.php';
$url_159760 	= 'https://github.com/fixonweb/fix159760-cadastro-de-clientes';
$slug_159760 	= 'fix159760-cadastro-de-clientes/fix159760-cadastro-de-clientes';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker($url_159760,__FILE__,$slug_159760);


function fix159760_load_modules($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
    $arrayItems = array();
    $skipByExclude = false;
    $handle = opendir($directory);
    if ($handle) {
        while (false !== ($file = readdir($handle))) {
        preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
        if($exclude){
            preg_match($exclude, $file, $skipByExclude);
        }
        if (!$skip && !$skipByExclude) {
            if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) {
                if($recursive) {
                    $arrayItems = array_merge($arrayItems, fix159760_load_modules($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                }
                if($listDirs){
                    $file = $directory . DIRECTORY_SEPARATOR . $file;
                    $arrayItems[] = $file;
                }
            } else {
                if($listFiles){
                    $file = $directory . DIRECTORY_SEPARATOR . $file;
                    $arrayItems[] = $file;
                }
            }
        }
    }
    closedir($handle);
    }
    return $arrayItems;
}


$path_modules = plugin_dir_path( __FILE__ )."add-in";
$dire = fix159760_load_modules($path_modules);
sort($dire);
foreach ($dire as $key => $value) {
	$extensao = substr($value, -4) ;
	if($extensao=='.php') require_once($value);;
}


function fix159760__file__(){
	return __FILE__;
}
function fix159760_plugin_file(){
	return plugin_dir_path( __FILE__ );
}

add_action('wp_enqueue_scripts', "fix159760_enqueue_scripts");
function fix159760_enqueue_scripts(){
    wp_enqueue_script( 'jquery-validate-min', plugin_dir_url( __FILE__ ) . '/js/jquery.validate.min.js', array( 'jquery' )  );
}
