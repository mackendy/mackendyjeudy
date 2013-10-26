<?php
/**
 * @author Mackendy
 */
namespace app;

class DbManager extends Singleton
{
    /** @var instance */
    protected static $instance;
    /** @var PDO */
    protected $db;

    /** @var string */
    protected $dbname=DBNAME;

    protected $user=USER;

    protected $password=PASSWORD;

    protected $repositoryFactory;

    protected function __construct()
    {
        try
        {

            $this->db = new PDO('mysql:host=localhost;dbname='.$this->dbname,$this->user,$this->password,array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => TRUE
             ));
           

        }
        catch (PDOException $e)
        {
            echo"erreur de connexion";
        }
    }


    public function setRepository($oRepository)
    {
        $this->repositoryFactory = $oRepository;
        return $this;
    }

    public function getOneRepository($sRepositoryName)
    {
        return $this->repositoryFactory->findRepository($sRepositoryName);
    }

    public function getDb() {
        return $this->db;
    }


}