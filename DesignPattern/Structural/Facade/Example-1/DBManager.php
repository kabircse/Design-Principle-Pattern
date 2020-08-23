    <?php
    //use databases as DB;
    require_once('database.php');
    
    //DBManager is a facade class.
    class DBManager implements DB{
    	public $db_cls,$db,$user,$pass,$con,$server,$sql,$obj;
    	public function __construct($obj){
    		$this->db_cls = $obj;
    	}	
    	public function connect($server,$user,$pass,$db){
    		return $this->db_cls->connect($server,$user,$pass,$db);
    	}
    	public function run($sql){
    		return $this->db_cls->run($sql);
    	}
    	public function disconnect(){
    		$this->db_cls->disconnect();
    	}
    }
    
    $mysql = new MySql(); // for pdo: new PdoDB();
    $dbmanager = new DBManager($mysql);
    $sql = 'SELECT * FROM student_hobbies';
    $dbmanager->connect('localhost','root','','test');
    $result = $dbmanager->run($sql);
    print_r($result->fetch_array());//for pdo fetchAll());
