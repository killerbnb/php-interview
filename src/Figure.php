<?php

abstract class Figure
{
    protected $isBlack;

    public function __construct($isBlack)
    {
        $this->isBlack = $isBlack;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString()
    {
        throw new \Exception("Not implemented");
    }

    public function isBlack()
    {
        return $this->isBlack;
    }

    abstract public function checkMove(Path $path);
}
