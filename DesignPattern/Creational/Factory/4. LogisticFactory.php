<?php
interface Transport {    
    fun deliver()
}
abstract class Logistic {
    abstract fun createTransport(): Transport
    fun deliver() {
        val transport: Transport = createTransport()
        transport.deliver()
    }
}

class SeaLogistic : Logistic() {
    override fun createTransport(): Transport {
        return Ship()
    }
}        

class RoadLogistic: Logistic() {    
    override fun createTransport(): Transport {
        return Truck()
    }
}

class Ship : Transport {    
    override fun deliver() {
        println("Delivering Ship with id: $this")
    }
}
class Truck : Transport {   
    override fun deliver() {
        println("Delivering Truck with id: $this")
    }
}

// Creating Ship using SeaLogistic
  val logistic = SeaLogistic();
  logistic.deliver();

// Creating Truck using RoadLogistic
  val logistic = RoadLogistic();
  logistic.deliver();

// AirLogistic->Plane other transport can exist.
