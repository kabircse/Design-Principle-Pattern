    Design Patterns:
    
    Design Pattern: Design pattern is a general repeatable solution to a commonly occurring problem in
    software design.
    
    Types of design pattern:
        1. Creational Pattern
        2. Structural Pattern
        3. Behavioral Pattern
        4. Concurrency Pattern
      
        1.Creational Pattern:
          a. Abstract Factory: Abstract Factory pattern is a creational design pattern which creates factory method.
          b. Factory: Factory method pattern is a creational design pattern which creates another classes.
          c. Builder
          d. Lazy Initialization
          e. Singleton: Singleton is creational pattern which creates one instance of class in the duration of runtime.
      
        2. Structural Patter:
          a. Adapter : The Adapter pattern is a design pattern which is commonly used to manage changes in development.
          b. Decorator : The Decorator pattern is a design pattern which gives to add new functionality to an existing object without altering its stucture.
          c. Facade:Facade is a structural design pattern which gives us a simplified interface of a complex sub system.
          
        3.Behavioral Pattern:
          a. Strategy Pattern: Strategy Pattern is a design pattern in which a class behavior or its algorithm can be changed at run time.
       /*
        The main difference between a "factory method" and an "abstract factory" is that the
        factory method is a single method, and an abstract factory is an object.
		*/
    Coupling: Coupling means the degree of one module depend on other module.
      	$storage = new Storage();
      	$user->new User($storage);//$user depend on $storage//
      	
    Dependency Injection: Dependency Injection is where components are given through their constructor,method
        or directly into field as a dependency.
      	//storage components gives as constructor to user.
      	
    Dispatch: Dispatch is a process of select a method at run time.
	Trait: Trait is simply a group of methods that you want include within another class. A Trait, like an abstract class, cannot be instantiated on it’s own.
  
  Easy Design Pattern:
  1. http://code.tutsplus.com/articles/a-beginners-guide-to-design-patterns--net-12752
  2. http://www.codeproject.com/Articles/1009532/Learn-Csharp-Design-patterns-step-by-step-with-a-p