/*
suppose we have three types of applications as follows: Web application, Desktop application, and Mobile Application. 
These three different applications needs to access and manipulate database where the database driver may be Mysql database or MsSqlServer database or Oracle database.
*/
<?php
interface IOApplication
{
    public function setDatabaseDriver(IODatabaseDriver $dbDriver); 
    public function query($query);
}
 
abstract class Application implements IOApplication
{
   protected $dbDriver; 
   public function setDatabaseDriver(IODatabaseDriver $dbDriver)
   {
       $this->dbDriver = $dbDriver;
   }
}
 
class WebApp extends Application
{
    public function query($query)
    {
 $query .= "\n\n running Web app query\n"; 
        return $this->dbDriver->handleQuery($query);
    }
}
 
class MobileApp extends Application
{
    public function query($query)
    {
 $query .= "\n\n running mobile app query\n"; 
        return $this->dbDriver->handleQuery($query);
    }
}
 
interface IODatabaseDriver
{
    public function handleQuery($query);
}
 
class MysqlServerDriver implements IODatabaseDriver
{
    public function handleQuery($query)
    {
        echo "\nUsing the mysql server driver: ".$query;
    }
}
 
class MsSqlServerDriver implements IODatabaseDriver
{
    public function handleQuery($query)
    {
        echo "\nUsing the ms sql server driver: ".$query;
    }
}
 
class OracleDriver implements IODatabaseDriver
{
    public function handleQuery($query)
    {
        echo "\nUsing the oracle driver: ".$query;
    }
}
 
echo "<pre>";
 
$webApp = new WebApp();
$webApp->setDatabaseDriver(new MysqlServerDriver());
echo $webApp->query("select * from table");
 
$webApp->setDatabaseDriver(new OracleDriver());
echo $webApp->query("select * from table");
 
$mobileApp = new MobileApp();
$mobileApp->setDatabaseDriver(new OracleDriver());
echo $mobileApp->query("select * from table");
 
echo "</pre>";
