<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Loader\StandardAutoloader;
use Zend\EventManager\EventInterface;

/**
 * Module
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface, \Zend\ModuleManager\Feature\BootstrapListenerInterface {

    public function onBootstrap(EventInterface $e)
    {
        /** @var \Zend\Mvc\MvcEvent $e*/
        $application    = $e->getApplication();
        $serviceManager = $application->getServiceManager();
    }

    /**
     * @inheritDoc
     */
    public function getAutoloaderConfig() {
        return [
            StandardAutoloader::class   => [
                'namespaces'    => [
                    __NAMESPACE__   => __DIR__ . '/' . __NAMESPACE__,
                ],
            ]
        ];
    }

    /**
     * @inheritDoc
     */
	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}
}
