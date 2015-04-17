# Monolog integration to Zend Framework 2

# Install

```json
{
    "require": {
        "amberovsky/zf2-monolog": "~0.1"
    }
}
```

# Usage

1. Add `Monolog` to your `config/application.config.php`.
2. Configure loggers (`config/logs.php`):
```php
use Amberovsky\Monolog\Config;
use Monolog\Handler\StreamHandler;

return [
	'monolog'	=> [
        'root'  => [
            Config::SECTION_HANDLERS    => [
                [
                    Config::HANDLER_CLASS   => StreamHandler::class,
                    Config::SECTION_ARGS    => [
                        'path'  => '/var/log/root.log'
                    ]
                ],
            ]
        ]
	]
];

```
3. Write to log:
```php
use \Amberovsky\Monolog\MonologFactoryTrait;

class Whatever {
    use MonologFactoryTrait;
    
    public function action() {
         $this->getMonologFactory()->getLogger('root')->debug('hello');
    }
}
```
