const Koa = require('koa');
const app = new Koa();
app.use(async ctx => {
  ctx.body = 'Hello, World!';
});
app.listen(3000);
console.log('Server running on port 3000');