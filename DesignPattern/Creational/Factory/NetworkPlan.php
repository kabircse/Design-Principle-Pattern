<?php

abstract class CellularPlan {
    protected $rate;
    abstract function getRate();
    public function processBill($minutes) {
        return $minutes*$this->rate;
    }
}

class SecondGenerationNetwork extends CellularPlan {
    public function getRate() {
        $this->rate = 1.50;
    }
}

class FourthGenerationNetwork extends CellularPlan {
    public function getRate() {
        $this->rate = 1.65;
    }
}

class NetworkFactory {
    public function getPlan($network) {
        return new $network();
    }
}

$network_factory = new NetworkFactory();

$network_name = 'SecondGenerationNetwork';
$second_g_network = $network_factory->getPlan($network_name);
echo "<br/> Enter Network Name: ".$network_name;
$minutes = 5;
echo "<br/> Enter Minutes: ".$minutes;
echo "<br/> Network: $network_name, Minutes: $minutes, Bill: ";
$second_g_network->getRate();
echo $second_g_network->processBill($minutes);



$network_name = 'FourthGenerationNetwork';
$second_g_network = $network_factory->getPlan($network_name);
echo "<br/><br/> Enter Network Name: ".$network_name;
$minutes = 5;
echo "<br/> Enter Minutes: ".$minutes;
echo "<br/> Network: $network_name, Minutes: $minutes, Bill: ";
$second_g_network->getRate();
echo $second_g_network->processBill($minutes);
