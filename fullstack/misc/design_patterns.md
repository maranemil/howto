## Design Patterns by Christopher Okhravi
***
---
_________________

### [ Observer Pattern ] 
https://www.youtube.com/watch?v=_BpmfnqjgzQ
```
------------------------------------------------------
Example 1 -> chat room ( room + users )
Example 2 -> weather station ( weather data + users )
Example 2 -> file data ( data + devices users )
observable Methods: add / remove / notify
observer Methods: update / get state
```
```
[ Facade Pattern ] https://www.youtube.com/watch?v=K4FkHVO5iac
------------------------------------------------------
wrapper / interface -> manage interaction with other classes
client -> facade -> classes to be managed
```
```
[ Factory Method Pattern ] https://www.youtube.com/watch?v=EcFVTgRHJLM&t=49s
------------------------------------------------------
(interface)(single object)
when "new Class()" used then do factory (business logic)
Animal -> (Cat,Dog,Mouse)
Car -> (Wheel,Door,Engine)
```
```
[ Singleton Pattern ] https://www.youtube.com/watch?v=hUE_j6q0LTQ&t=21s
------------------------------------------------------
One instance + global access to that instance - public constructor
Varian 1:  new Singleton()->dosomething();
Varian 2:  Singleton.getInstance()->dosomething(); // with static var
```
```
[ Adapter Pattern ] https://www.youtube.com/watch?v=2PKQtcJjYvc&t=1s
------------------------------------------------------
converts one interface into another one - mapper / wrapper / convertor
Client > Target (request) -> Adapter (request) ->  Adaptee (specific request)
Local Class -> Adapter Interface -> API (ex: payment)
```
```
[ Proxy Pattern ] https://www.youtube.com/watch?v=NwaabHqPHeM&t=11s
------------------------------------------------------
provides a place holder for an object to controll access to it
access related  (remote, virtual (cache), protection (allowed))
Book -> Book parser
```
```
[ Abstract Factory Pattern ] https://www.youtube.com/watch?v=v-GiuMmsXj4&t=17s
------------------------------------------------------
(interface)(multiple objects)
interface for class familiy objects
Product Abstract Class > Product A, Product B, Product C
```
```
[ Null Object Pattern ] https://www.youtube.com/watch?v=rQ7BzfRz7OY
------------------------------------------------------
```
```
[ Command Pattern ] https://www.youtube.com/watch?v=9qA5kw8dcSU&t=19s
------------------------------------------------------
object request - receiver - commands executer
```
```
[ Strategy Pattern ] https://www.youtube.com/watch?v=v9ejT8FO-7I&t=24s
------------------------------------------------------
using composition instead of inheritence - defines family of algoritms
Duck > Wild Duck + Street Duck
```
```
[ Bridge Pattern ] https://www.youtube.com/watch?v=F1YQ7YRjttI
------------------------------------------------------
Decouple abstraction from implementation
```
```
[ State Pattern ] https://www.youtube.com/watch?v=N12L5D78MAA
------------------------------------------------------
states (locked/open)+ transitions
```

```
[ Decorator Pattern ] https://www.youtube.com/watch?v=GCraGHx6gso&t=36s
------------------------------------------------------
lets you attach new behaviors to objects
by placing these objects inside special wrapper objects that contain the behaviors.
```
```
[ Template Method Pattern ] https://www.youtube.com/watch?v=7ocpwK9uesw
------------------------------------------------------
pdf -> templates -> write
```
```
[ Iterator Pattern ]  https://www.youtube.com/watch?v=uNTNEfwYXhI&t=24s
------------------------------------------------------
collections looping
```

```
Structural patterns - Adapter, Bridge, Composite, Decorator, Facade, Flyweight, Proxy
Creational patterns - Abstract Factory, Builder, Factory Method, Object Pool, Prototype, Singleton
Behavioral patterns - Chain, Command, Interpreter, Iterator, Mediator, Memento, Observer, Strategy, State, Template method, Visitor
```

```
https://sourcemaking.com/design_patterns/factory_method
https://designpatternsphp.readthedocs.io/en/latest/Creational/FactoryMethod/README.html
https://www.tutorialspoint.com/design_pattern/factory_pattern.htm
https://refactoring.guru/design-patterns/factory-method
https://refactoring.guru/design-patterns/php
https://refactoring.guru/design-patterns/examples
```



```
java patterns
https://www.tutorialspoint.com/when-to-use-an-abstract-class-and-when-to-use-an-interface-in-java
https://www.baeldung.com/java-interface-vs-abstract-class
https://www.php.net/manual/en/language.oop5.abstract.php
https://www.php.net/manual/en/language.oop5.late-static-bindings.php
https://en.wikipedia.org/wiki/Template_method_pattern
https://en.wikipedia.org/wiki/Design_Patterns
```

```
misc
https://designpatternsphp.readthedocs.io/en/latest/README.html
https://java-design-patterns.com/patterns/
https://phptherightway.com/pages/Design-Patterns.html
https://refactoring.guru/design-patterns/catalog
https://refactoring.guru/design-patterns/java
https://refactoring.guru/design-patterns/php
https://www.digitalocean.com/community/tutorials/java-design-patterns-example-tutorial
https://www.dofactory.com/net/design-patterns
https://www.javatpoint.com/design-patterns-in-java
https://www.php.net/manual/en/language.oop5.interfaces.php
https://www.tutorialspoint.com/design_pattern/index.htm
https://www.tutorialspoint.com/php/php_design_patterns.htm
https://www.w3schools.com/php/php_oop_interfaces.asp
```

###  Design Patterns: The Movie
```
https://www.youtube.com/watch?v=2-4k5FhPlmg

factory . concrete factory . product . concrete product
abstract factory . concrete factory  . product . concrete product
builder . concrete builder . product - for variable components small projects
prototype . concrete prototype - clone 
singleton - getinstance
adapter - api - bridge - interfaces - target - adapters
bridge - abstraction - implementation [plug-system - plugin]
composite - test range string array - component + leaf + composite
decorator - default object - object - uppgrade - update subclasses
facade - client - subsystems
flyweight - building factory
proxy - api . generator - cache . auth . / subject . real subject . proxy
chain of responsability - handlers - rule validate
command - undo redo - action - stack state actions - invoker - receiver 
interpreter - regex math dsl - modularity
iterator - object - walker - iterator . collection
mediator - manager . devices . component 
momento - game . state . manager . undo redo 
observer - changes on event . subscribers . publisher . dynamic updates
state - stages - context - states 
strategy - context 
template method - skeleton - abstract class
visitor - unit - interface

https://agileparrot.com/creational-design-patterns-in-php/
https://designpatternsphp.readthedocs.io/en/latest/
https://designpatternsphp.readthedocs.io/en/latest/index.html
https://github.com/Design-pattrns/Abstract-Factory-Pattern
https://mermaid.js.org/syntax/classDiagram.html
https://refactoring.guru/design-patterns/abstract-factory
https://refactoring.guru/design-patterns/abstract-factory/csharp/example
https://refactoring.guru/design-patterns/abstract-factory/java/example#
https://refactoring.guru/design-patterns/abstract-factory/typescript/example
https://sourcemaking.com/design_patterns#
https://springframework.guru/gang-of-four-design-patterns/abstract-factory-design-pattern/
https://symfony.com/doc/current/service_container/factories.html
https://symfonycasts.com/screencast/design-patterns-2/factory
https://symfonycasts.com/screencast/design-patterns-2/factory-families
https://www.baeldung.com/java-abstract-factory-pattern
https://www.dofactory.com/net/abstract-factory-design-pattern
https://www.dofactory.com/net/design-patterns
https://www.geeksforgeeks.org/abstract-factory-pattern-javascript-design-patterns/
https://www.geeksforgeeks.org/abstract-factory-pattern/
https://www.javatpoint.com/abstract-factory-pattern
https://www.tutorialspoint.com/design_pattern/abstract_factory_pattern.htm
```