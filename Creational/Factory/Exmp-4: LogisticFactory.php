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
        
        class FactoryMethodTest {
          fun main() {
              // Creating Ship using SeaLogistic
              for(i in 1..5) {
                  val logistic = SeaLogistic()
                  logistic.deliver()
              }

              // Creating Truck using RoadLogistic
              for(i in 1..5) {
                  val logistic = RoadLogistic()
                  logistic.deliver()
              }
          }
        }

        class AirLogistic: Logistic() {
            override fun createTransport(): Transport {
                return Plane()
            }
        }
    
        class Plane : Transport {
            override fun deliver() {
                println("Delivering Plane with id: $this")
            }
        }
