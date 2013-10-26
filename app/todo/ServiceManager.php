<?php
/**
 *
 * @author Mackendy
 *
 */
namespace app;

class ServiceManager extends Singleton
{
    /** @var instance */
    protected static $instance;

    /** @var array */
    protected $aServices=array();

    /**
     *
     * @param ajoute le nom du service $serviceName
     * @param objet $service
     * @return fluidit��
     */
    public function addService($serviceName,$service)
    {
        $this->aServices[$serviceName]=$service;
        return $this;
    }

    /**
     *
     * @param nom du service demand�� $serviceName
     * @return objet
     */
    public function getService($serviceName)
    {
       return  $this->aServices[$serviceName];
    }
}