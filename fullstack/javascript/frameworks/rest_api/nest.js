import { Controller, Get, Module } from '@nestjs/common';
import { NestFactory } from '@nestjs/core';
@Controller()
class AppController {
  @Get()
  getHello(): string {
    return 'Hello, World!';
  }
}
@Module({
  controllers: [AppController],
})
class AppModule {}
async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  await app.listen(3000);
  console.log('Server running on port 3000');
}
bootstrap();