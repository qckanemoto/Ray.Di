<?php
/**
 * This file is part of the _package_ package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Ray\Di\Demo;

use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

use Ray\Di\ProviderInterface;

class PhpProvider implements ProviderInterface
{
    private $version;

    /**
     * @Inject
     * @Named("version=php_version")
     */
    public function __construct($version)
    {
        $this->version = $version;
    }
    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return new Php($this->version);
    }
}