    <?php
    //use databases as DB;
    require_once('database.php');
    
    /*DBManager is a factory class.*/
    class DBManager{
    	public static function create($clsName){
    		return new $clsName();
    	}
    }
    
    $dbmanager = DBManager::create('MySql');
    $sql = 'SELECT * FROM student_hobbies';
    $dbmanager->connect('localhost','root','','test');
    $result = $dbmanager->run($sql);
    print_r($result->fetch_array());//for pdo fetchAll());
    
    $dbmanager = DBManager::create('MySql');
    $sql = 'SELECT * FROM student_hobbies';
    $dbmanager->connect('localhost','root','','test');
    $result = $dbmanager->run($sql);
    print_r($result->fetch_array());//for pdo fetchAll());
