######
#
###   Building the useInfiniteQuery() project
###   https://blog.logrocket.com/build-instagram-infinite-scrolling-feed-react-query/
######
```
npx create-react-app infinite-scroll
npm install react-query react-infinite-scroller
```

### Configuring React Query

```
#index.js
import { QueryClient, QueryClientProvider } from "react-query";
import { ReactQueryDevtools } from "react-query/devtools";
import ReactDOM from "react-dom";
import App from "./App";

const queryClient = new QueryClient();

ReactDOM.render(
  <QueryClientProvider client={queryClient}>
    <App />
    <ReactQueryDevTools />
  </QueryClientProvider>,
 document.getElementById("root")
);
```


### Hilla application
```
https://www.infoworld.com/article/3655139/intro-to-hilla-the-full-stack-java-framework.html
npx @vaadin/cli init --hilla foundry-hilla

localhost:8080
```




### Building a realtime chat app with React, Laravel, and WebSockets
#### https://ably.com/blog/building-a-realtime-chat-app-with-react-laravel-and-websockets

```

mkdir chat-app-react-laravel-ably
composer create-project laravel/laravel backend
cd backend
php artisan serve
composer require ably/ably-php
php artisan make:event MessageEvent

npx create-react-app frontend
cd frontend
npm start
npm install axios laravel-echo pusher-js
npm start
```
