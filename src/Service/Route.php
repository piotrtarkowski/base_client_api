<?php

namespace BaseClientApi\Service;

class Route
{

    private string $name;

    private string $route;

    private string $class;

    private string $action;

    private ?array $constraints = null;

    private ?array $params = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return array
     */
    public function getConstraints(): ?array
    {
        return $this->constraints;
    }

    /**
     * @param array $constraints
     */
    public function setConstraints(?array $constraints): void
    {
        $this->constraints = $constraints;
    }

    public function addConstraint(string $key, string $value): self
    {
        $this->constraints[$key] = $value;

        return $this;
    }

    public function getParams(): ?array
    {
        return $this->params;
    }

    public function addParams($key, $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }
}