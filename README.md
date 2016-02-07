# Bus

NOTE: This library still under development (tests are not yet included). Use it at your own risk.

 A very simple Command Bus to plug into your project. This library differs from other similar libraries like 
 [Tactician](http://tactician.thephpleague.com/) and [SimpleBus](http://simplebus.github.io/MessageBus/doc/command_bus.html) 
 not on its purpose but on the approach taken. 
 
 `Bus` has been inspired by both of those libraries but it moves away from the `Command` > `CommandHandler` terminology 
 due to the function of a `Command` object. The object in other libraries work as a mere `data` object, and that IMO is 
 what a `Message` should be, I understand `Command` should `execute` or `process` a `Message`, getting the data that 
 requires to be executed from it. So, this library has the following characteristics: 
 
 - It handles `Message` instances 
 - Every `Message` is processed by exactly one `Command`
 - The library is extensible by `strategies`. Currently supporting `ExecuteStrategy` (simple locate and execute), and 
 `MiddlewareStrategy` (supporting middleware pattern). New `strategies` can be easily implemented. 
 - The behavior of the `MiddlewareStrategy` is also extensible. New `middlewares` can be added to the `middleware 
 strategy`, so `messages` can be handled the way you wish. Middlewares do things before (see `LockingMiddleware`) 
 and/or after (see `LogginMiddleware`) handling a command. 

 

## Examples

- TODO 

## Clean code
 
We have added some development tools for you to contribute to the library with clean code: 

- PHP mess detector: Takes a given PHP source code base and look for several potential problems within that source.
- PHP code sniffer: Tokenizes PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
- PHP code fixer: Analyzes some PHP source code and tries to fix coding standards issues.

And you should use them in that order. 

### Using php mess detector

Sample with all options available:

```bash 
 ./vendor/bin/phpmd ./src text codesize,unusedcode,naming,design,controversial,cleancode
```

### Using code sniffer
 
```bash 
 ./vendor/bin/phpcs -s --report=source --standard=PSR2 ./src
```

### Using code fixer

We have added a PHP code fixer to standardize our code. It includes Symfony, PSR2 and some contributors rules. 

```bash 
./vendor/bin/php-cs-fixer --config-file=.php_cs fix ./src
```

## Testing

 - TODO

[![2amigOS!](https://s.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0?s=80)](http://www.2amigos.us) 
