<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

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
	 * @return MonologFactory
	 */
	public function getMonologFactory();
}
