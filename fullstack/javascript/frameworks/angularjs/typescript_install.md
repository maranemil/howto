######
#
###	TypeScript
######
```
https://www.npmjs.com/package/typescript/v/3.6.4
https://www.digitalocean.com/community/tutorials/setting-up-a-node-project-with-typescript
https://github.com/microsoft/TypeScript-Node-Starter/blob/master/README.md
https://dev.to/monisnap/5-min-typescript-npm-package-4ce4
https://khalilstemmler.com/blogs/typescript/node-starter-project/
https://egghead.io/lessons/typescript-create-high-quality-npm-packages-using-typescript
```
```
node -v
npm -v
npm init -y
npm install typescript --save-dev

npm install -D typescript
npm install -D tslint
npm install express -S

npm install -g typescript
npm install -g gulp
npm install

gulp local            # Build the compiler into built/local
gulp clean            # Delete the built compiler
gulp LKG              # Replace the last known good with the built one.
                      # Bootstrapping step to be executed when the built compiler reaches a stable state.
gulp tests            # Build the test infrastructure using the built compiler.
gulp runtests         # Run tests using the built compiler and test infrastructure.
                      # You can override the host or specify a test for this command.
                      # Use --host=<hostName> or --tests=<testPath>.
gulp baseline-accept  # This replaces the baseline test results with the results obtained from gulp runtests.
gulp lint             # Runs tslint on the TypeScript source.
gulp help             # List the above commands.
```

######
#
###   TypeScript
######
```
TypeScript - The Basics
https://www.typescriptlang.org/
https://rawgit.com/
https://github.com/krausest/js-framework-benchmark
https://levelup.gitconnected.com/typescript-for-beginners-97b568d3e110
-----------------------------------------
npm i -g typescript # or npm install -g typescript

tsc --version
tsc index.ts
node index.js


tsc compiler options: tsconfig.json
target es3
watch true
lib dom
```

######
#
###   React
######
```
React State Management Tutorial | Context Api | React Tutorial For Beginners
https://www.youtube.com/watch?v=35lXWvCuM8o&t=40s
```
```
npx create-react-app appnamehere

# App.js
import React from 'react';
import './App.css'
import MovieList from './MovieList.js'

function App(){
	return (
		<div classname="App">Some Text</div>
	);
}

export default App;
---------------------
# MovieList.js
import React,{useState} from 'react';

cont MovieList = () => {
	const[movies,setMovies] = useState([
		{
			name: 'Inception',
			price: '$10',
			id: 342532
		}
	]);
	return ({
		<div> movies.map( movie => ( <li>{movie.name} </li> )) </div>
	});
}

export default MovieList;
```
--------------------------------------------------------
```
React Tutorial For Beginners
https://www.youtube.com/watch?v=dGcsHMXbSOA
```
--------------------------------------------------------
```
git clone https://github.com/facebook/create-react-app
npx create-react-app appnamehere
```
--------------------------------------------------------
```
Build A Node.js API Authentication With JWT Tutorial
https://www.youtube.com/watch?v=2jqok-WgelI
```
--------------------------------------------------------
```
npm install express
npm install --save-dev nodemon

auth
https://api.mongodb.com/ruby/current/Mongo/URI.html
```

```
https://code.visualstudio.com/Docs/languages/typescript
https://code.visualstudio.com/docs/typescript/typescript-tutorial
https://www.tutorialspoint.com/typescript/typescript_basic_syntax.htm
https://www.typescriptlang.org/
```

```
apt install node
node -v
npm install -g typescript
tsc --version

mkdir HelloWorld
cd HelloWorld
code .

let message: string = 'Hello World';
console.log(message);

tsc helloworld.ts
helloworld.js
node helloworld.js

tsconfig.json
{
  "compilerOptions": {
    "target": "es5",
    "module": "commonjs"
  }
}
```




