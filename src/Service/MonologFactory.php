<?php
/**
 * @author amberovsky
 */

namespace Amberovsky\Monolog\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Monolog\Logger;

/**
 * Monolog factory
 */
class MonologFactory implements FactoryInterface {
	public function createService(ServiceLocatorInterface $ServiceLocator) {
		$Logger = new Logger();
	}
}
