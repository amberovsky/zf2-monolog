<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * MonologFactoryAware
 */
interface MonologFactoryAware {
	/**
	 * Setter for monolog factory
	 *
	 * @param MonologFactory $MonologFactory
	 */
	public function setMonologFactory(MonologFactory $MonologFactory);

	/**
     * @param ServiceLocatorInterface|null $ServiceLocator
     *
	 * @return MonologFactory
	 */
	public function getMonologFactory(ServiceLocatorInterface $ServiceLocator = null);
}
