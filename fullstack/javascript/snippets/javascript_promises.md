######
##	Javascript Promises Angular / React
######

### Javascript Classic Try Get specific number https://jsfiddle.net/
```

console.clear();
/*
async function evenNumber() {
let promise = new Promise((resolve, reject) => {
    setTimeout(() => resolve("8"), 120)
  });
  let result = await promise; // pause till the promise resolves
  console.log(result); // "8"
}
evenNumber();
*/

// try until you get the promise
async function genNumber(){
 	return (Math.floor(Math.random() * 6));
}
async function checkNumber() {
  genNumber()
  .then(number => {
  	if(number === 3){
    	console.log(number);
    }
    else{
    	console.log("Try again! Unexpected " + number);
      new Promise(done => setTimeout(done => checkNumber(), 1500));
    }
  })
  .catch(err => {
		console.log(err);
	});
}
checkNumber();
```

----------------------------------------------------
### Angular js

```
let wrappingPromise = new Promise((resolve, reject) => {
  var error = false;
  setTimeout(function(){
    reject("some error");
  }, 3000);
  this.http.get(...).toPromise().then(res => {
    if(!error) {
      resolve(res.json);
    }
  });
});
```



### Javascript Classic

```
const durations = [1000, 2000, 3000]
promises = durations.map((duration) => {
  return timeOut(duration).catch(e => e) // Handling the error for each promise.
})
Promise.all(promises)
  .then(response => console.log(response)) // ["Completed in 1000", "Rejected in 2000", "Completed in 3000"]
  .catch(error => console.log(`Error in executing ${error}`))
```



### js react
```
function getCurrentTime() {
  // Get the current 'global' time from an API using Promise
  return new Promise((resolve, reject) => {
    setTimeout(function() {
      var didSucceed = Math.random() >= 0.5;
      didSucceed ? resolve(new Date()) : reject('Error');
    }, 2000);
  })
}
getCurrentTime()
  .then(currentTime => getCurrentTime())
  .then(currentTime => {
    console.log('The current time is: ' + currentTime);
    return true;
  })
  .catch(err => console.log('There was an error:' + err))
```



### Async function to send mail to a list of users.
```
const sendMailForUsers = async (users) => {
  const usersLength = users.length;
  for (let i = 0; i < usersLength; i += 100) {
    const requests = users.slice(i, i + 100).map((user) => { // The batch size is 100. We are processing in a set of 100 users.
      return triggerMailForUser(user) // Async function to send the mail.
       .catch(e => console.log(`Error in sending email for ${user} - ${e}`)) // Catch the error if something goes wrong. So that it won't block the loop.
    })

    // requests will have 100 or less pending promises.
    // Promise.all will wait till all the promises got resolves and then take the next 100.
    await Promise.all(requests)
     .catch(e => console.log(`Error in sending email for the batch ${i} - ${e}`)) // Catch the error.
  }
}
sendMailForUsers(userLists)
```


######
###   setTimeout alternatives - await promises
```

/*
https://www.sitepoint.com/jquery-settimeout-function-examples/
https://medium.com/javascript-in-plain-english/truly-understanding-promises-in-javascript-cb31ee487860
https://medium.com/javascript-in-plain-english/async-await-javascript-5038668ec6eb
https://hackernoon.com/smarter-javascript-timeouts-24308f3be5ab
https://javascript.info/settimeout-setinterval
https://blog.praveen.science/right-way-of-delaying-execution-synchronously-in-javascript-without-using-loops-or-timeouts/
https://developer.mozilla.org/de/docs/Web/API/WindowTimers/setTimeout
http://jsfiddle.net/wZ9Z6/
https://stackoverflow.com/questions/35133311/js-settimeout-alternative
https://rpo.wrotapodlasia.pl/docs/sections/custom/scrollbar.html
https://stackoverflow.com/questions/36209758/how-to-reset-the-scroller-on-ace-theme
http://jsfiddle.net/wna8h21d/1/
http://jsfiddle.net/wna8h21d/

chrome://flags/#overlay-scrollbars
*/

// using Timeout lib
// https://github.com/rommelsantor/Timeout
const didGreet = Timeout.set('myGreeting', greetWorld, 2000)
if (Timeout.exists('myGreeting')) {// true
  console.log('greeting has been scheduled')
}


// Classic setTimeout
// ----------------------------
// repeat with the interval of 2 seconds
let timerId = setInterval(() => alert('tick'), 2000);
// after 5 seconds stop
setTimeout(() => { clearInterval(timerId); alert('stop'); }, 5000);


// Garbage collection and setInterval/setTimeout callback
// ----------------------------
// the function stays in memory until the scheduler calls it
setTimeout(function() {...}, 100);


// Using await async
// ----------------------------
async done(){ return true }
console.log("Start");
console.time("Promise");
await new Promise(done => setTimeout(() => done(), 5000));
console.log("End");
console.timeEnd("Promise");


// Using delay
// ----------------------------
function delay(n) {
  n = n || 2000;
  return new Promise(done => {
    setTimeout(() => {
      done();
    }, n);
  });
}


// Using jQuery
// ----------------------------
// Creates a jQ object where elem set to index of [0]
// a plain object with value of 0 `{to:0}`
// call .animate() chained to the jQ object
// Animates `{to:0}` value from 0 - 1
// $({to:0}).animate({to:1}

var duration = 5000;
$({to:0}).animate({to:1}, duration, function() {
  // do stuff after `duration` elapsed
  $("#messageTimer").html("Happy New Year ! (working version)")
})


// Using simple await
// ----------------------------
// async wait
async function firstAsync() {
  return 27;
}
firstAsync().then(alert); // 27



//  Async Await together
// ----------------------------
// To make the above function work properly, we need to add async before
async function firstAsync() {
    let promise = new Promise((res, rej) => {
        setTimeout(() => res("Now it's done!"), 1000)
    });
    // wait until the promise returns us a value
    let result = await promise;
    // "Now it's done!"
    alert(result);
};
firstAsync();


//  takes 100ms to complete
// ----------------------------
async function sequence() {
  await promise1(50); // Wait 50ms…
  await promise2(50); // …then wait another 50ms.
  return "done!";
}


// Seq
// ----------------------------
async function sequence() {
    await Promise.all([promise1(), promise2()]);
    return "done!";
}


// Parallel
// ----------------------------
async function parallel() {    // Start a 500ms timer asynchronously…
    const wait1 = promise1(50);     // …meaning this timer happens in parallel.
    const wait2 = promise2(50);
    // Wait 50ms for the first timer…
    await wait1;
    // by which time this timer has already finished.
    await wait2;
    return "done!";
}



// Chaining Promises
// ----------------------------
new Promise(function(resolve, reject) {
  setTimeout(() => resolve(1), 1000);
}).then(function(result) {
  alert(result);
  return result * 3;
}).then(function(result) {
  alert(result);
  return result * 4;
}).then(function(result) {
  alert(result);
  return result * 6;

});



//  Handling and Consuming the Promis
// ----------------------------
const isDone = new Promise()
//...
const checkIfDone = () => {
  isDone
    .then(ok => {
      console.log(ok)
    })
    .catch(err => {
      console.error(error)
    })
}
```



######
### Interval Promise NodeJS
######
```
/*
https://medium.com/@kornatzky/how-to-integrate-intervals-into-a-promises-chain-in-node-js-9cfe9b19ace7
https://blog.atomist.com/javascript-timer-settimeout/
*/

https://github.com/andyfleming/interval-promise
https://github.com/composite/promise-extended-spec
npm install interval-promise

const interval = require('interval-promise')

// Run a function 10 times with 1 second between each iteration
interval(async () => {
    await someOtherPromiseReturningFunction()
    await another()
}, 1000, {iterations: 10})


var promise = new Promise(function(resolve, reject){
  var i = 0;
  setInterval(function(){
    resolve(++i); // when fired, this promise will flag with DONE.
  });
});
promise.then(function(i){
  console.log(i);
}).then(function(i){
  console.log(i);
});

...

async function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async funtion main() {
    setTimeout(async () => {
        try {
            await bad();
        } catch (e) {
            console.warn("caught: " + e.message)
        }
    }, 100);
    await sleep(200);
}

async function main() {
    setTimeout(async () => {
        console.log("before");
        await sleep(100);
        console.log("after");
    }, 100);
}

...

setInterval(() => {
    testLongJobStatus(args).
        .then((data) => { console.log(data); });
}, 1000);

...

const taskResolution = (args, period) => {
  return new Promise((resolve, reject) => {
    const interval = setInterval(() => {
      testLongJobStatus(args)
        .then((data) => {
             if (data === 'failure') {
                         clearInterval(interval);
             reject(Error('fail'));
           } else if (data === 'success') {
               resolve('complete')
           }
           // keep on waiting
       });
    }, period);
  });
};

// Integrate the Interval with the Promises Chain
taskResolution(args, period)
    .then((data) => {})
    .catch((error) => {});

```


```
https://github.com/sindresorhus/p-limit
https://blog.bitsrc.io/understanding-javascript-async-and-await-with-examples-a010b03926ea
https://medium.com/hackernoon/async-await-essentials-for-production-loops-control-flows-limits-23eb40f171bd
https://hackernoon.com/lets-make-a-javascript-wait-function-fa3a2eb88f11

var e = document.querySelector('#a')

  var waitForHello = timeoutms => new Promise((r, j)=>{
    var check = () => {
      console.warn('checking')
      if(e.innerHTML == 'Hello world')
        r()
      else if((timeoutms -= 100) < 0)
        j('timed out!')
      else
        setTimeout(check, 100)
    }
    setTimeout(check, 100)
  })//setTimeout(()=>{e.innerHTML='Hello world'}, 1000)  (async ()=>{
    a.innerHTML = 'waiting..'
    waitForHello(2000)
  })()
```

### Promise.race
https://italonascimento.github.io/applying-a-timeout-to-your-promises/

```
// Will resolve after 200ms
let promiseA = new Promise((resolve, reject) => {
  let wait = setTimeout(() => {
    clearTimout(wait);
    resolve('Promise A win!');
  }, 200)
})

// Will resolve after 400ms
let promiseB = new Promise((resolve, reject) => {
  let wait = setTimeout(() => {
    clearTimout(wait);
    resolve('Promise B win!');
  }, 400)
})

// Let's race our promises
let race = Promise.race([
  promiseA,
  promiseB
])

race.then((res) => console.log(res)) // -> Promise A win!
```

### async
```
https://blog.pusher.com/promises-async-await/
----------------------------------------------------
function getAPIData(url) {
      return contentData(url) // returns a promise
        .catch(e => {
          return somethingElse(url)  // returns a promise
        })
        .then(v => {
          return someOtherThing(v); // returns a promise
        })
        .then(x => {
          return anotherOtherThing(v)
        });
        //   the chain continues with more .then() handlers
    }
```
```
----------------------------------------------------
https://getstream.io/blog/javascript-promises-and-why-async-await-wins-the-battle/
https://gist.github.com/nparsons08/8698238fe689329cab7d67841681cbf5#file-validate-password-js
----------------------------------------------------
// provided a string (password)
function validatePassword(password) {
	// create promise with resolve and reject as params
	return new Promise((resolve, reject) => {
		// validate that password matches bambi (the deer)
		if (password !== 'bambi') {
			// password doesn't match, return an error with reject
			return reject('Invalid Password!');
		}

		// password matches, return a success state with resolve
		resolve();
	});
}

function done(err) {
	// if an err was passed, console out a message
	if (err) {
		console.log(err);
		return; // stop execution
	}

	// console out a valid state
	console.log('Password is valid!');
}

// dummy password
const password = 'foo';

// using a promise, call the validate password function
validatePassword(password)
	.then(() => {
		// it was successful
		done(null);
	})
	.catch(err => {
		// an error occurred, call the done function and pass the err message
		done(err);
	});
```