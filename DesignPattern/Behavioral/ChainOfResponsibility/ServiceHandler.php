<?php
interface Handler
{
    public function handleRequest($request); 
    public function setSuccessor($nextService);     
}
class JsonService implements Handler
{
    private $successor; 
    public function setSuccessor($nextService)
    {
        $this->successor = $nextService;
    } 
    public function handleRequest($request)
    {
        if ($request->getService() == "JSON")
        {
            echo ("I am parsing JSON!");
        }
        else if ($this->successor != NULL)
        {
            $this->successor->handleRequest($request);
        }
    }    
}

class XMLService implements Handler
{
    private $successor; 
    public function setSuccessor($nextService)
    {
        $this->successor = $nextService;
    } 
    public function handleRequest($request)
    {
        if ($request->getService() == "XML")
        {
            echo ("I am parsing XML");
        }
        else if ($this->successor != NULL)
        {
            $this->successor->handleRequest($request);
        }
    }    
}

class Request
{
    private $value; 
    public function __construct($service)
    {
        $this->value = $service;
    } 
    public function getService()
    {
        return $this->value;    
    }    
}

$json = new JsonService();
$xml = new XMLService();
$json->setSuccessor($xml);
$request = new Request("XML");
$json->handleRequest($request);
