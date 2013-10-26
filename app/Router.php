<?php

/**
 * Description of Router
 * Découper ma request en ptit bout pour
 * définir le controller la methode et les params
 * @author mackendy
 */
namespace app
{
    
    class Router {
        static $routes = [];
        
        /**
         * permet de parser une url 
         * @param strinf $url
         * @return array tableau contenant les paramétres
         */
        static function parse($sUrl,$oRequest){
            
            //permet d'enlever les espaces trim($str, $charlist) 
            $sUrl = trim($sUrl,"/");
           
            foreach(Router::$routes as $v){
                
                if(preg_match($v['catcher'],$sUrl,$matches)){
                   $oRequest->Controller = $v['controller'];
                   $oRequest->Action = $v['action'];
                   $oRequest->params = [];
                   foreach($v['params'] as $k=>$v){
                     $oRequest->Params[$k] = $matches[$k];  
                   }
                   return $oRequest;
                }
            }
            
            $aURI =  explode("/", $sUrl);
            // je récupere le controller et la methode = action
            $oRequest->Controller = $aURI[0];
            $oRequest->Action = isset($aURI[1]) ? $aURI[1] : 'index';
            // je récupere les parametres supplémentaire
            $oRequest->Params = array_slice($aURI, 2);
            return true;


        }
        
       static public function connect($urlRedir,$urlBase){
            $r=[];
            $r['params']=[];
            
            $r['urlRedir'] = $urlRedir;
            $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $urlBase);
            $r['origin'] = '/'.str_replace('/', '\/', $r['origin']).'/';
            
            $params =  explode('/', $urlBase);
            foreach($params as $k=>$v){
                if(strpos($v, ":")){
                   $par = explode(":", $v);
                   $r['params'][$par[0]] = $par[1];
                   //debug($par);
                }else{
                    if($k == 0){
                        $r['controller'] = $v;
                    }elseif($k == 1){
                        $r['action'] = $v;
                    }
                }
            }
            //debug($r['params']);
            $r['catcher'] = $urlRedir;
            foreach($r['params'] as $k=>$v){
                $r['catcher'] = str_replace(":$k", "(?P<$k>$v)", $r['catcher']);
            }
            $r['catcher'] = '/'.str_replace('/', '\/', $r['catcher']).'/';
            //debug($r);
            
            
            self::$routes[] =$r;
           // debug($r);
        }
        
       static public function url($url){
           foreach (self::$routes as $v){
               if(preg_match($v['origin'], $url, $matches)){
                   //debug($matches);
                   foreach($matches as $k=>$w){
                       if(!is_numeric($k)){
                            $v['urlRedir'] = str_replace(":$k", $w, $v['urlRedir']);
                       } 
                    }
                    return ROOT.'/'.$v['urlRedir'];
               }
           }
            return ROOT.'/'.$url;
        }
    }
}


