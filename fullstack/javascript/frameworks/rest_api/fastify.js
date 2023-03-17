const fastify = require('fastify')();
fastify.get('/', async (request, reply) => {
  return 'Hello, World!';
});
fastify.listen(3000, err => {
  if (err) {
    console.error(err);
    process.exit(1);
  }
  console.log('Server running on port 3000');
});
