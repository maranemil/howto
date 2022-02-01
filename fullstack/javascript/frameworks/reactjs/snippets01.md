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
