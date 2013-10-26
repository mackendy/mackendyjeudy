<?php

/**
 * Description of Request
 * Retrouve l'url passé par l'utilsateur
 * @author mackendy
 */
namespace app
{
    class Request {

        /**
         *  url appelé par l'utilisateur
         * @var string
         */
        public $sUrl;

        public  function __construct() {

            $this->sUrl = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : 'index';


        }
    }
}


