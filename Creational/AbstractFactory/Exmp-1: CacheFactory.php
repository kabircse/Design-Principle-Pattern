<?php
    interface Cache {
        public function getCache();
    }    
    class redisCache implements Cache{        
        public function getCache(){
            return 'Redis Cache. ';
        }
    }
    class memCache implements Cache{
        public function getCache(){
            return 'Mem Cache. ';   
        }        
    }
    class phpCache implements Cache{
        public function getCache(){
            return 'Php cache. ';
        }
    }   
    class CacheFactory{ // This is AbstractCacheFactory class
        private $user;
        public function __construct(Cache $cache){
            $this->user = $cache->getCache();
        }
        public function cacheUser(){
            echo $this->user;
        }
    }
	$cache = new phpCache();	
    $output = new CacheFactory($cache);	
    //var_dump($output);
	$output->cacheUser();
    
    /*
        The main difference between a "factory method" and an "abstract factory" is that the
        factory method is a single method, and an abstract factory is an object.
    */
