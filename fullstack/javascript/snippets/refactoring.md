### Guard clauses technique - early exit.

#### // before
```

https://www.youtube.com/watch?v=ZzwWWut_ibU
https://jsfiddle.net/


let auth_valid  = true;
let login_valid = true;

if(auth_valid){
   if(login_valid){
  	auth();
  }
}

function auth(){
	console.log("Auth is valid")
}
```

#### // after
```
let auth_valid = true;
let login_valid = true;

if (validation(auth_valid,login_valid) === true) {
  auth();
}

function validation(auth_valid,login_valid) {
  if (!auth_valid) {
    return false;
  }
  if (!login_valid) {
    return false;
  }
  return true;
}


function auth() {
  console.log("Auth is valid")
}
```
