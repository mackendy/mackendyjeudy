<?php
//use app\config;
/**
 * Description of Models
 *
 * @author mackendy
 */
namespace app
{
    use \config\config;
    use \PDO;
    
    class Model{
    //put your code here
    public static $con = [];
    public $my_con = "default";
    public $table =false;
    public $db;




    public function __construct() {
        
            //j'initialise quelques la table qu'il faut utiliser
            if($this->table === false){
                $this->table  = strtolower(get_class($this)).'s';
            }
            
            //je me connecte a la base
            $conf = Config::$database[$this->my_con];
            if(isset(Model::$con[$this->my_con])){
                $this->db = Model::$con[$this->my_con];
                return true;
            }
            
            try
            {

                $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'],$conf['user'],$conf['password'],array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::ATTR_PERSISTENT => TRUE,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                 ));

                Model::$con[$this->my_con] = $pdo;
                $this->db = $pdo;
            }
            catch (PDOException $e)
            {   
                if(Config::$debug >= 1){
                    die($e->getMessage());
                }else{
                    die('base de donnée en vacance');
                }
                
            }
            
            
        }
        
        public function find($req){        
            $sql = 'SELECT ';
            
            if(isset($req['fields'])){
                if(is_array($req['fields'])){
                    $sql .= implode(", ", $req['fields']);
                }else{
                    $sql .= $req['fields'];
                }
            }else{
               $sql .= "*"; 
            }
            
            $sql .= ' FROM '.$this->table.' as '.get_class($this).'';
            
            //construction de nos condition
            if(isset($req['conditions'])){
                $sql.=' WHERE ';

                if(!is_array($req['conditions'])){
                    $sql .= $req['conditions'];
                    die($sql);
                }else{
                    $cond = [];
                    foreach ($req['conditions'] as $k => $v){
                        if(!is_numeric($v)){
                            $v = $this->db->quote($v);
                            //var_dump($v);
                        }

                        $cond[] = " $k = $v ";
                    }
                    $sql .= implode(' AND ', $cond);

                }
            }
            //construction de nos limite
            if(isset($req['limit'])){
                $sql.=' LIMIT '.$req['limit'];
            }
            
            //die($sql);
            
            $pre = $this->db->prepare($sql);
            $pre->execute();
            return $pre->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function findFirst($req){
             return current($this->find($req));
        }
        
        
        public function menu(){
           $query = "SELECT post_id, post_parent, post_title,post_type,post_slug FROM posts WHERE post_status='online' ORDER BY post_title ASC"; 
           $stmt = $this->db->prepare($query);
           $stmt->execute();
           
           $categories = [];
           
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $categories[] = [
                   'parent_id'=>$row['post_parent'],
                   'categorie_id' => $row['post_id'],
                   'nom_categorie' => $row['post_title'],
                   'type' => $row['post_type'],
                   'slug'=>$row['post_slug']
               ];
           }
           //var_dump($categories);
           return $categories;
        }
       
        
        
        //code saysa 
        
        /**
     * 
     * @param array $params
     * @return \sdtClass | false
     */
    public function select($params){

        $columns = (isset($params['columns']))?$params['columns']:'*';
        $table   = $params['table'];
        $where   = " WHERE 1=1 ";
        
        //prepare query fields requested
        if (is_array($columns)){
            $columns = implode(', ', $columns);
        }

        //prepare query where requested
        if (isset($params['where'])){
	        foreach ($params['where'] as $col => $val){
	            $where .= "AND {$col} = :{$col} ";
	        }	
        }

        //set fetch mode
        //default FETCH_OBJ
        $fetchMode = (isset($params['fetchMode'])) ? $params['fetchMode'] : PDO::FETCH_OBJ ;

        //prepare request
        $query = $this->oConnect->prepare("SELECT {$columns} FROM {$table} $where ");

        if (isset($params['where'])){
	        foreach ($params['where'] as $col => $val){
	            $query->bindParam(":{$col}", $val);
	        }
        }

        $result = $query->execute();
        $fetch = $query->fetch($fetchMode);
           
        return $fetch;
    }

	public function create(){		   
		//get POST fields and POST values
		foreach ($_POST as $sFieldName => $sFieldValue) {
			$aFields[] = $sFieldName; 
			$aValues[] = '"'.filter_var($sFieldValue, FILTER_SANITIZE_MAGIC_QUOTES).'"';

			//save POST values in class attributes
			$this->$sFieldName = $sFieldValue;		       
		}		  

		//format values for insert query 
		$sFields = implode(', ', $aFields);
		$sValues = implode(', ', $aValues);	   
		   
		$sql = 'INSERT INTO '.$this->class.' ('.$sFields.')
				VALUE ('.$sValues.')';			   	

		$query = $this->oConnect->exec($sql);		   
		$this->lastInsert = $this->oConnect->lastInsertId();

		return $this;

	}

	public function update(){
		$oid = $_POST[$this->xxx_id];

		//format values for update query 
		$update_values="";
		$where="";
		foreach ($_POST as $sFieldName => $sFieldValue) {
			if($sFieldName !== $this->xxx_id){
				$update_values .= $sFieldName.' = "'.filter_var($sFieldValue, FILTER_SANITIZE_MAGIC_QUOTES).'", ';
			}else{
				$where = 'WHERE '.$this->xxx_id.' = :id';
			}
			   
			//save POST values in class attributes
			$this->$sFieldName = $sFieldValue;	
		} 

		$sql = 'UPDATE '.$this->class.' SET '.substr($update_values, 0, -2).' '.$where;   				   	      	   				   	
		$query = $this->oConnect->prepare($sql);
			   	
		$query->execute(array(':id' => $_POST[$this->xxx_id]));		

		return $this;
	}

	public function del($oid = 0){	 
		     
		//del files 
		if ($oid !== 0) {
			//delete dir if exist
			$dirContent = scandir(SITE_IMG.$this->class.DS.$oid);
			   
			foreach ($dirContent as $fileName) {
				unlink(SITE_IMG.$this->class.DS.$oid.DS.$fileName);
			}
			   
			is_dir(SITE_IMG.$this->class.DS.$oid)?rmdir(SITE_IMG.$this->class.DS.$oid):false;	 		
		}

		//del in bdd
		$where = $this->xxx_id.' = :id';
		$query = $this->oConnect->prepare('DELETE FROM '.$this->class.' WHERE '.$where);	
		$query->execute(array(':id' => $oid));
	}
    }
    
    
    
    
    

}


