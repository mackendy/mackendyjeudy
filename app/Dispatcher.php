<?php

/**
 * Description of Dispatcher
 * objet qui permet de rediriger vers le bon composant a partir du request
 * @author mackendy
 */


namespace app
{
  

    class Dispatcher {

        /**
         *contient l'url passé par l'utilisateur
         * @var string
         */
        protected $oRequest;

        public function __construct($entityManager) {
            // lance mon chargeur de class autoload 
            spl_autoload_register([__CLASS__,'autoload']);
            //
            $this->em =$entityManager;
            
            $this->oRequest = new Request();
            Router::parse($this->oRequest->sUrl,$this->oRequest);
            $oController = $this->loadController();
            if(!in_array($this->oRequest->Action, array_diff(get_class_methods($oController),  get_class_methods(get_parent_class($oController))))){
                $this->error(' Le controller '. $this->oRequest->Controller.' n\'a pas de méthode '. $this->oRequest->Action);
            }
            //il dit a mon controller quelle est mon action et ses parametres
            call_user_func_array([$oController,$this->oRequest->Action], $this->oRequest->Params);
            $oController->render($this->oRequest->Action);
            

        }
        /**
         * Permet de charger les classes de mon MVC
         * @param type $sClassName
         */
        public function autoload($sClassName){
            
            $sClass =  str_replace("\\",DS, $sClassName);
            require($sClass.".php");
            require_once  WEBROOT.DS.'configs/config.php';
            //var_dump($sClass);
        }

        /**
         * Permet de chargé le bon controller
         * @return Objet
         */
        public function loadController(){
//            if($this->oRequest->Controller == "admin"){
//                $sName =  ucfirst($this->oRequest->Controller)."Controller";
//                $sFile = WEBROOT.DS."admin".DS."controllers".DS.$sName.".php";
//                //var_dump($sFile);die;
//                if (!file_exists($sFile)){
//                    $this->error("Cette page existe pas pour les admin");
//                }
//                require $sFile;
//                return $oController = new $sName($this->oRequest,  $this->em);
//            }
            
            $sName =  ucfirst($this->oRequest->Controller)."Controller";
            $sFile = WEBROOT.DS."controllers".DS.$sName.".php";
            if (!file_exists($sFile)){
                $this->error("Cette page existe pas");
            }
            require $sFile;
            return $oController = new $sName($this->oRequest,$this->em);
        }
        
        public function error($message){
            $controller = new \app\Controller($this->oRequest,$this->em);
            $controller->e404($message);
            
        }
    }
}

