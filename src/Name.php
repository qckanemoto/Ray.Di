<?php

/**
 * This file is part of the Ray package.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\Di;

final class Name
{
    /**
     * 'Unnamed' name
     */
    const ANY = '*';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $names;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @param string $name
     */
    private function setName($name)
    {
        // annotation
        if (class_exists($name, false)) {
            $this->name = $name;

            return;
        }
        // single name
        // @Named(name)
        if ($name === Name::ANY || preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
            $this->name = $name;
            return;
        }
        // key=value name
        // @Named(varName1=name1,varName2=name2)
        parse_str(str_replace(',', '&', $name), $match);
        $this->names = $match;
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return string
     */
    public function __invoke(\ReflectionParameter $parameter)
    {
        // single variable named binding
        if ($this->name) {
            return $this->name;
        }
        // multiple variable named binding
        if (is_array($this->names) && isset($this->names[$parameter->name])) {
            return $this->names[$parameter->name];
        }

        // not matched
        return Name::ANY;
    }
}
