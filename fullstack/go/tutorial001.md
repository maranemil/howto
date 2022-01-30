```
############################################################

Go for PHP Developers - Terrence Ryan | IPC 2017
https://www.youtube.com/watch?v=KWWo0vJaogI
Test on: https://ideone.com

############################################################
```
```
go run main.go
// ----------------------------------------------------
package main
func main(){
	// your code goes here
	println("hello")
}

// ----------------------------------------------------
package main
import "fmt"
func main(){
	// your code goes here
	var s string = "Hello"
	// s:= "Hello"
	fmt.Printf("%s\n",s)
}
```
```
----------------------------------------------------
//array -------------
gre :=[5] string{
	"on",
	"tewo",
}
// slice -------------
gre :=[] string{
	"on",
	"tewo",
}
gre = gre.append("new string")
```
```
// ----------------------------------------------------
package main
import (
	"fmt"
	"math/rand"
	"time"
)

func main(){
	g:=[]string{"a","b"}
	rand.Seed(time.Now().UnixNano())
	l:=len(g)
	i:=rand.Int(l-1)
	fmt.Printf("%s\n", g[i])
}
```
