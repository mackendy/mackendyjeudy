<?php
use config\Config;
function debug($var){
    
    if(config::$debug>0) :
        $backtrace = debug_backtrace();
        echo'<p>&nbsp;<a href="#"  ><strong>'.$backtrace[0]['file'].'</strong> ligne: '.$backtrace[0]['line'].'</a></p>';//onclick="$(this).parent().next(\'ol\').slideToggle(); return false;
        echo'<ol>';
            foreach($backtrace as $k=>$v)if($k>0){
                echo'<li><strong>'.$v['file'].'</strong> ligne: '.$v['line'].'</li>';
            }
        echo'</ol>';
        echo'<pre>';
        print_r($var);
        echo'</pre>';

    endif;;
}