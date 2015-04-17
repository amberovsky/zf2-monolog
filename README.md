# Monolog integration to Zend Framework 2

# Install

```json
{
    "require": {
        "amberovsky/zf2-monolog": "~0"
    }
}
```

# Usage
* Add `Monolog` to your `config/application.config.php`.
* Configure loggers (`config/logs.php`):

```php
use Amberovsky\Monolog\Config;
use Monolog\Handler\StreamHandler;
use Formatter;

return [
	'monolog'	=> [
        'root'  => [
            Config::SECTION_HANDLERS    => [
                [
                    Config::HANDLER_CLASS   => StreamHandler::class,
                    Config::HANDLER_ARGS    => [
                        'path'  => '/var/log/root.log',
                    ],
                    
                    config::HANDLER_FORMATTER   => [
                        Config::FORMATTER_CLASS => Formatter::class,
                        Config::FORMATTER_ARGS  => [
                            
                        ]
                    ],
                ],
            ],
        ]
	]
];

```

* Write to log:
```php
use \Amberovsky\Monolog\MonologFactoryTrait;

class Whatever {
    use MonologFactoryTrait;
    
    public function action() {
         $this->getMonologFactory()->getLogger('root')->debug('hello');
    }
}
```
