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
use Zend\ServiceManager\ServiceLocatorInterface;

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

	/** @var  ServiceLocatorInterface */
	protected $ServiceLocator;

	/**
	 * @inheritDoc
	 */
    public function onBootstrap(EventInterface $MvcEvent) {
        /** @var MvcEvent $MvcEvent*/
        $this->ServiceLocator = $MvcEvent->getApplication()->getServiceManager();
		$this->getMonologFactory();
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
