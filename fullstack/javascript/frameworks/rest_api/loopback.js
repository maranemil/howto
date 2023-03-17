import { Application, RestBindings, get } from '@loopback/rest';
import { inject } from '@loopback/core';
class HelloWorldController {
  @get('/')
  hello(): string {
    return 'Hello, World!';
  }
}
const app = new Application();
app.controller(HelloWorldController);
app.bind(RestBindings.PORT).to(3000);
app.start().then(() => {
  console.log('Server running on port 3000');
});
