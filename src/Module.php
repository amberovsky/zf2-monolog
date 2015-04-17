<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Loader\StandardAutoloader;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Module
 */
class Module implements
	AutoloaderProviderInterface,
	ConfigProviderInterface,
	BootstrapListenerInterface,
	MonologFactoryAware
{

	use MonologFactoryTrait;

	/**
	 * @inheritDoc
	 */
    public function onBootstrap(EventInterface $MvcEvent) {
        /** @var MvcEvent $MvcEvent*/
		$this->getMonologFactory($MvcEvent->getApplication()->getServiceManager());
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
