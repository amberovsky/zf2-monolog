<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

/**
 * Configuration
 */
class Config {
	/** name of monolog configuration part */
	const
		CONFIG_MONOLOG	= 'monolog';

    /** global section names */
    const
        SECTION_HANDLERS    = 'handlers', // handlers section
        SECTION_PROCESSORS  = 'processors', // processors section
        SECTION_ARGS        = 'args'; // arguments

    /** options for handler */
    const
        HANDLER_CLASS       = 'class', // handler class
        HANDLER_FORMATTER   = 'formatter'; // formatter section

    /** options for formatter */
    const
        FORMATTER_CLASS = 'class'; // formatter class
}
