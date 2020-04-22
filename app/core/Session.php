<?php

namespace Core;


class Session
{

    public function set($key, $value)
    {
        $session = &$_SESSION;
        $session[$key] = $value;
        return $this;
    }

    public function get($key)
    {
        $session = $_SESSION;
        if (!isset($session[$key]))
            return null;
        return $session[$key];
    }

    /**
     * @param $key
     * @return $this
     */
    public function destroy($key)
    {
        $session = &$_SESSION;
        $session[$key] = null;
        return $this;
    }
}