```
############################################################
Using C++ on Linux in VS Code
https://code.visualstudio.com/docs/cpp/config-linux
############################################################
```
```
http://www.lcs-chemie.de/c_comp.htm
https://code.visualstudio.com/docs/cpp/config-linux
http://www.cpp-entwicklung.de/cpplinux/cpp_main/cpp_main.html
https://man7.org/linux/man-pages/man1/cpp.1.html
https://www.cyberciti.biz/faq/howto-compile-and-run-c-cplusplus-code-in-linux/
https://www.geeksforgeeks.org/cpp-command-in-linux-with-examples/
```

```
gcc -v
sudo apt-get update
sudo apt-get install build-essential gdb

mkdir projects
cd projects
mkdir helloworld
cd helloworld
```

```
----------------------------
code helloworld.cpp
----------------------------
#include <iostream>
#include <vector>
#include <string>

using namespace std;

int main()
{
    vector<string> msg {"Hello", "C++", "World", "from", "VS Code", "and the C++ extension!"};
    for (const string& word : msg)
    {
        cout << word << " ";
    }
    cout << endl;
}
```


```
############################################################
#
#  Compile C and Cpp
#
############################################################
```
```
https://code.visualstudio.com/docs/cpp/config-linux
http://www.lcs-chemie.de/c_comp.htm

gcc -v
sudo apt-get update
sudo apt-get install build-essential gdb

mkdir projects
cd projects
mkdir helloworld
cd helloworld
code
```
```
touch helloworld.c
vi helloworld.c

#include<stdio.h>
/* demo.c:  My first C program on a Linux */
int main(void)
{
 printf("Hello! This is a test prgoram.\n");
 return 0;
}

cc program-source-code.c -o exhelloworld
./exhelloworld

```
```
touch helloworld.cpp
vi helloworld.cpp

#include "iostream"
// demo2.C - Sample C++ program
int main(void)
{
    std::cout << "Hello! This is a C++ program.\n";
    return 0;
}


g++ helloworld.cpp -o helloworld
make helloworld
./helloworld

```
```
#include <iostream>
#include <vector>
#include <string>

using namespace std;
int main()
{
    vector<string> msg {"Hello", "C++", "World", "from", "VS Code", "and the C++ extension!"};

    for (const string& word : msg)
    {
        cout << word << " ";
    }
    cout << endl;
}
```
```
#include <iostream>
using namespace std;

void main( void )
{
  char name[50 ];
   cout << "Wie ist Dein Name ?: " ;
   cin >> name;
   cout << "Hallo, " << name << endl;
}

g++   versuch.cpp
g++   versuch.cpp -o versuch
g++   -g versuch.cpp -o versuch
```