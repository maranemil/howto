
### kotlinlang

```
https://kotlinlang.org/
https://kotlinlang.org/docs/data-science-overview.html#jupyter-kotlin-kernel
https://kotlinlang.org/docs/home.html
https://kotlinlang.org/docs/basic-syntax.html
```

```
fun main() {
    println("Hello World")
}
```
-----------------------------------------
```
class Greeter(val name: String) {
    fun greet() {
        println("Hello, $name")
    }
}

fun main(args: Array<String>) {
    Greeter(args[0]).greet()
}
```
-----------------------------------------
```
suspend fun main() = coroutineScope {
    for (i in 0 until 10) {
        launch {
            delay(1000L - i * 10)
            print("$i ")
        }
    }
}
```