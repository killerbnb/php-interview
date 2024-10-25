<?php

class Rook extends Figure
{
    public function __toString()
    {
        return $this->isBlack ? '♜' : '♖';
    }

    public function checkMove(Path $path)
    {
        // TODO: Implement checkMove() method.
    }
}
