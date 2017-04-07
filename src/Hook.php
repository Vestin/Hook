<?php

namespace Vestin\Hook;

class Hook
{

    static protected $hooks = [];

    /**
     * attach a target on a hook
     *
     * @param string $name
     * @param callable|Target $target
     * @return bool
     * @throws \Exception
     */
    static public function on($name, $target)
    {
        if (!is_callable($target) && !class_exists($target)) {
            throw new \Exception('target must be a callabel or a class implement Vestin\Hook\Target');
        }

        if (isset(self::$hooks[$name])) {
            self::$hooks[$name][] = $target;
        } else {
            self::$hooks[$name] = [$target];
        }

        return true;
    }


    /**
     * deattach a target off a hook or dettach all target of the hook
     *
     * @param string $name
     * @param null $target
     */
    static public function off($name, $target = null)
    {
        if (isset(self::$hooks[$name])) {
            if ($target !== null && in_array($target, self::$hooks[$name])) {
                $index = array_search($target, self::$hooks[$name]);
                unset(self::$hooks[$name][$index]);
            } else {
                unset(self::$hooks[$name]);
            }
        }
    }

    /**
     * check and exec if the specific hook have target
     *
     * @param $name
     * @param null $args
     * @return array
     * @throws \Exception
     */
    static public function call($name, &$args = null)
    {
        $result = [];
        if (!isset(self::$hooks[$name])) {
            return $result;
        }
        foreach (self::$hooks[$name] as $target) {
            // callable
            if (is_callable($target)) {
                $result[] = $target($args);
            }
            // class
            if (is_string($target) && class_exists($target)) {
                $targetClass = new $target();
                if (!$targetClass instanceof Target) {
                    throw new \Exception('target class must implement Vestin\Hook\Target');
                }
                $result[] = $targetClass->exec();
            }
        }
        return $result;
    }

}