<?php

/**
 *  mon singleton
 * @author Mackendy
 * @since
 *
 */
namespace app
{
    class Singleton
    {
        protected function __construct(){
            //ma connection a la bdd en PDO par exemple
        }
        /**
         *
         * @var Singleton
         */
        protected static $instance;

        /**
         * @return Singleton
         */
        public static function getInstance()
        {
            if(static::$instance === null) {
                static::$instance = new static;
            }

            return static::$instance;
        }
        /**
         * je met protected si je veux  que le systeme g��nere le message d'erreur
         * je met public si je veux g��rer le message d'erreur moi meme
         *
         * ces trois function emepeche de cloner serialiser et de d��serialis�� mon singleton
         */
        protected function __clone()
        {

        }

        protected function __sleep()
        {
            //rigger_error('Forbidden serialization of a singleton object', E_USER_ERROR);
        }

        protected function __wakeup()
        {
            //trigger_error('Forbidden unserialization of a singleton object', E_USER_ERROR);
        }

    }
}