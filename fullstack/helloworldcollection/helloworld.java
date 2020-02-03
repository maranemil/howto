// Hello World in Java

class HelloWorld {
  static public void main( String args[] ) {
    System.out.println( "Hello World!" );
  }
}

/*
public class Main {
    public static void main(String[] args) {
        System.out.println("This will be printed");
    }
}*/

/******************************************************************************
 *  Compilation:  javac HelloWorld.java
 *  Execution:    java HelloWorld
 *
 *  Prints "Hello, World". By tradition, this is everyone's first program.
 *
 *  % java HelloWorld
 *  Hello, World
 *
 *  These 17 lines of text are comments. They are not part of the program;
 *  they serve to remind us about its properties. The first two lines tell
 *  us what to type to compile and test the program. The next line describes
 *  the purpose of the program. The next few lines give a sample execution
 *  of the program and the resulting output. We will always include such
 *  lines in our programs and encourage you to do the same.
 *
 ******************************************************************************/

public class HelloWorld {
    public static void main(String[] args) {
        // Prints "Hello, World" to the terminal window.
        System.out.println("Hello, World");
    }
}

/*
https://www.w3schools.in/java-program/call-method-in-same-class/
https://www.homeandlearn.co.uk/java/java_method_calling.html
*/

public class CallingMethodsInSameClass
{
 // Method definition performing a Call to another Method
 public static void main(String[] args) {
  Method1(); // Method being called.
  Method2(); // Method being called.
 }

 // Method definition to call in another Method
 public static void Method1() {
  System.out.println("Hello World!");
 }

 // Method definition performing a Call to another Method
 public static void Method2() {
  Method1(); // Method being called.
 }
}


/*
https://www.jdoodle.com/online-java-compiler/
*/
public class MyClass {
    public static void main(String args[]) {
      int x=10;
      int y=25;
      int z=x+y;
      System.out.println("Sum of x+y = " + z);
    }
}
