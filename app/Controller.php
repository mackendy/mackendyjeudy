<?php

/**
 * Description of Controller
 * Controller principal
 * @author mackendy
 */
namespace app
{
    use \app;
    
    class Controller {
        
        protected $oRequest;
        private $aVars=[];
        private $rendered =false;
        public $mymenu =[];
        protected $sController;
        protected $em;



        public function __construct($oRequest,$entityManager) {
              $this->em = $entityManager;
              $this->oRequest = $oRequest;
              $this->sController = $this->oRequest->Controller;
              // $this->mymenu = $this->loadModel('post')
              //       ->post
              //       ->menu();
        }
        /**
         * permet de passer une ou plusieurs variable a la vue
         * @param mixt $key nom de la variable OU tableau de variable
         * @param string $value Valeur de la variable
         */
        public function set($key,$value=""){
            if(is_array($key)){
                $this->aVars = $key;
            }else{
                $this->aVars[$key] =$value;
            }
        }
        /**
         * Permet de rendre une vue
         * @param type $view Fichier a rendre
         * @param type $layout le layout utilisé par default c'est defoult
         * @return boolean 
         */
        public function render($view,$layout="default"){
            //test si le render a deja etait fait
            if($this->rendered){return false;}
            
            //test si le controller est admin
            if($this->sController == "admin"){
                $layout ="admin";
                extract($this->aVars);
                
                if(strpos($view, "/")){
                    $view = WEBROOT.DS."admin".DS."views".DS.$view.".php";
                }else{
                    $view = WEBROOT.DS."admin".DS."views".DS.$this->oRequest->Controller.DS.$view.".php";
                }
                ob_start();
                require_once($view);
                $content_for_layout= ob_get_clean();
                require WEBROOT.DS."admin".DS."views".DS."layouts".DS.$layout.".php";
                $this->rendered =true;
                
            }else{
              
                extract($this->aVars);

                if(strpos($view, "/")){
                    $view = WEBROOT.DS."views".DS.$view.".php";
                }else{
                    $view = WEBROOT.DS."views".DS.$this->oRequest->Controller.DS.$view.".php";
                }
                ob_start();
                require_once($view);
                $content_for_layout= ob_get_clean();
                require WEBROOT.DS."views".DS."layouts".DS.$layout.".php";
                $this->rendered =true;
            }
        }
        /**
         * permet de charger un model
         * @param string $model
         * @return \app\Controller
         */
        public function loadModel($model){
            $file = WEBROOT.DS."models".DS.$model.".php";
            require_once $file;
            if(!isset($this->$model)){
                $this->$model = new $model;
            }
            return $this;
            
        }
        /**
         * Permet de rendre la page 404 error
         * @param type $message
         */
        public function e404($message){
            header("HTTP/1.0 404 Not Found");
            header('Content-Type: text/html; charset=UTF-8');
            $this->set("message",$message);
            $this->render('errors/404',"error");
            die();
        }
        /**
         * permet de recuperer le menu afficher_menu($parent, $niveau, $array) 
         * @param int $parent
         * @param int $niveau
         * @param array $tab permet d'avoir la requette
         * @return string le menu
         */
        public function afficher_menu($parent="0", $niveau="0",$tab){
            //var_dump($tab);
            $menu = "";
            $niveau_precedent = 0;
            //verifie si le niveau est null OU 0 alors on ajout ul
            if(!$niveau && !$niveau_precedent) $menu .="\n<ul class='nav'>\n";
            foreach ($tab as $noeud){
                if($parent == $noeud['parent_id']){
                    if($niveau_precedent < $niveau) $menu .="\n<ul class='' >\n";
                    $menu .='<li><a href="'.\app\Router::url("{$noeud['type']}s/view/id:{$noeud['categorie_id']}/slug:{$noeud['slug']}").'">'.$noeud['nom_categorie'].'</a>';
                    $niveau_precedent = $niveau;
                    $menu .=$this->afficher_menu($noeud['categorie_id'],($niveau + 1),$tab);
                }
            }
            if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $menu .= "</ul>\n</li>\n";
            else if ($niveau_precedent == $niveau) $menu .= "</ul>\n";
            else $menu .= "</li>\n";

            return $menu;
        }

        public function redirect($url, $code = 301) {
        header("Location: $url", true, $code);
        exit;
    }
    
    }
    //\app\Router::url("posts/view/id:{$v->post_id}/slug:{$v->post_slug}");
    //'.BASE_URL.DS.$noeud['type']."s".DS."view".DS.$noeud['categorie_id'].'">'.$noeud['nom_categorie'].
}

