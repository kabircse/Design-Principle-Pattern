    <?php
    
    //namespace databases;
    
    interface DB{
    	function connect($server,$user,$pass,$db);
    	function run($sql);
    	function disconnect();
    }
    
    class MySql implements DB{
    	public $db,$user,$pass,$con,$server,$sql;	
    	public function connect($server,$user,$pass,$db){
    		$this->con = new mysqli($server,$user,$pass,$db);
    	}
    	public function run($sql){
    		return $this->con->query($sql);
    	}
    	public function disconnect(){
    		$this->con->close();
    	}
    }
    /*
    $mysql = new MySql();
    $mysql->connect('localhost','root','','test');
    $result = $mysql->run('SELECT * FROM student_hobbies');
    $mysql->disconnect();
    print_r($result->fetch_array());
    */
    
    class PdoDB implements DB{
    	public $db,$user,$pass,$con,$server,$sql;	
    	public function connect($server,$user,$pass,$db){
    		$this->con = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
    	}
    	public function run($sql){
    		$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$result = $this->con->prepare($sql);
    		$result->execute();
    		$result->setFetchMode(PDO::FETCH_ASSOC);
    		return $result;
    	}
    	public function disconnect(){
    		$this->con = null;
    	}
    }
    
    /*$pdo = new PdoDB();
    $pdo->connect('localhost','root','','test');
    $result = $pdo->run('SELECT * FROM student_hobbies');
    $pdo->disconnect();
    print_r($result->fetchAll());*/
