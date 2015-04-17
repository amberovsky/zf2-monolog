<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

use Amberovsky\Monolog\Exception\SectionArgsMissingException;
use Monolog\Logger;
use Amberovsky\Monolog\Exception\LogNotFoundException;
use Amberovsky\Monolog\Exception\HandlerClassMissingException;
use Amberovsky\Monolog\Exception\FormatterClassMissingException;
use Monolog\Handler\HandlerInterface;
use Monolog\Formatter\FormatterInterface;
use ReflectionClass;


/**
 * Monolog Factory
 */
class MonologFactory {
    private $config;

    /** @var null|Logger[] Logger instances */
    static private $Instances = null;

    /**
     * @param array $config configuration
     */
    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * @param Logger $Logger Logger to configure
     * @param HandlerInterface $AbstractHandler Handler to configure
     * @param array $config formatter configuration
     *
     * @throws FormatterClassMissingException
     * @throws SectionArgsMissingException
     */
    protected function configureFormatter(Logger $Logger, HandlerInterface $AbstractHandler, array $config) {
        if (!isset($config[Config::FORMATTER_CLASS])) {
            throw new FormatterClassMissingException('Formatter class is missing for [' . $Logger->getName() . '] log');
        }

        if (!isset($config[Config::FORMATTER_ARGS])) {
            throw new SectionArgsMissingException('Section args is missing for formatter [' . $Logger->getName() .
                '] log');
        }

        $Reflector = new ReflectionClass($config[Config::FORMATTER_CLASS]);
        /** @var FormatterInterface $AbstractFormatter */
        $AbstractFormatter = $Reflector->newInstanceArgs($config[Config::FORMATTER_ARGS]);

        $AbstractHandler->setFormatter($AbstractFormatter);
    }

    /**
     * @param Logger $Logger Logger to configure
     * @param array $config handlers configuration
     *
     * @throws HandlerClassMissingException
     * @throws SectionArgsMissingException
     */
    protected function configureHandlers(Logger $Logger, array $config) {
        foreach ($config as $handlerConfig) {
            if (!isset($handlerConfig[Config::HANDLER_CLASS])) {
                throw new HandlerClassMissingException('Handler class is missing for [' . $Logger->getName() . '] log');
            }

            if (!isset($handlerConfig[Config::HANDLER_ARGS])) {
                throw new SectionArgsMissingException('Section args is missing for [' . $Logger->getName() . '] log');
            }

            $Reflector = new ReflectionClass($handlerConfig[Config::HANDLER_CLASS]);
            /** @var HandlerInterface $AbstractHandler */
            $AbstractHandler = $Reflector->newInstanceArgs($handlerConfig[Config::HANDLER_ARGS]);

            if (isset($handlerConfig[Config::HANDLER_FORMATTER])) {
                $this->configureFormatter($Logger, $AbstractHandler, $handlerConfig[Config::HANDLER_FORMATTER]);
            }

            $Logger->pushHandler($AbstractHandler);
        }
    }

    /**
     * @param Logger $Logger Logger to configure
     * @param array $config processors configuration
     */
    protected function configureProcessors(Logger $Logger, array $config) {

    }

    /**
     * @param string $name logger name
     *
     * @return Logger Logger instance
     *
     * @throws LogNotFoundException when log was not found in the config
     */
    public function getLogger($name) {
        if (!isset(self::$Instances[$name])) {
            if (!isset($this->config[$name])) {
                throw new LogNotFoundException('Log [' . $name . '] was not found in the config');
            }

            $Logger = new Logger($name);

            if (isset($this->config[$name][Config::SECTION_HANDLERS])) {
                $this->configureHandlers($Logger, $this->config[$name][Config::SECTION_HANDLERS]);
            }

            if (isset($this->config[$name][Config::SECTION_PROCESSORS])) {
                $this->configureProcessors($Logger, $this->config[$name][Config::SECTION_PROCESSORS]);
            }

            self::$Instances[$name] = $Logger;
        }

        return self::$Instances[$name];
    }
}
