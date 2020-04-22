<?php

namespace Core\Router;

class Route implements RouteInterface
{

    protected $name;
    protected $methods = [];
    public $pattern;
    protected $compilePattern;
    protected $paths;

    public function __construct(string $pattern, $paths = null, $httpMethod = null)
    {
        $this->reConfigure($pattern, $paths);
        $this->methods = $httpMethod;
    }

    public function compilePattern(string $pattern): string
    {
        if ($pattern !== '/')
            $pattern = trim($pattern, '/');
        if (strpos($pattern, ':') !== false) {
            $int_pattern = "/([0-9]+)";
            $any_pattern = "/([\\w0-9\\_\\-]+)";
            if (strpos($pattern, '/:controller') !== false)
                $pattern = str_replace('/:controller', $any_pattern, $pattern);
            if (strpos($pattern, '/:action') !== false)
                $pattern = str_replace('/:action', $any_pattern, $pattern);
            if (strpos($pattern, '/:params') !== false)
                $pattern = str_replace('/:params', $any_pattern, $pattern);
            if (strpos($pattern, '/:int') !== false)
                $pattern = str_replace('/:int', $int_pattern, $pattern);
        }
        if (strpos($pattern, '(')) {
            return "#^" . $pattern . "$#u";
        }
        if (strpos($pattern, '[')) {
            return "#^" . $pattern . "$#u";
        }

        return $pattern;
    }


    public function getPaths()
    {
        return $this->paths;
    }

    public function getCompiledPattern()
    {
        return $this->compilePattern;
    }

    public function reConfigure(string $pattern, $paths = null)
    {
        $routePaths = null;
        $pcrePattern = null;
        $extracted = null;
        $compiledPattern = $this->compilePattern($pattern);
        $this->pattern = $pattern;
        $this->compilePattern = $compiledPattern;

        $this->paths = $paths;
    }

    public function setName(string $name): RouteInterface
    {
        $this->name = $name;
        return $this;
    }

    public function getHttpMethods()
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     * @return RouteInterface
     */
    public function setHttpMethods($methods): RouteInterface
    {
        $this->methods = $methods;
        return $this;
    }

}