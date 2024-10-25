<?php

class Pawn extends Figure
{
    private bool $notMoving = true;

    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    public function checkMove(Path $path)
    {
        if ($path->getNumberOfCellsPassed() > 2) {
            throw new \Exception("A pawn moves a max of 2 squares");
        }

        $isBlackAndDown = $path->getDirectionMovement() === DirectionMovement::Down && $this->isBlack;
        $isWhiteAndUp = $path->getDirectionMovement() === DirectionMovement::Up && !$this->isBlack;
        $isDirectionSameAsColor = $isBlackAndDown || $isWhiteAndUp;

        //Пешка может ходить вперёд(по вертикали) на одну клетку;
        if ($isDirectionSameAsColor
            && $path->getNumberOfCellsPassed() === 1
            && !$path->isThereAreFiguresOnWay()
        ) {
            $this->notMoving = false;
            return;
        }

        //Если пешка ещё ни разу не ходила, она может пойти вперёд на две клетки;
        if ($isDirectionSameAsColor
            && $this->notMoving
            && $path->getNumberOfCellsPassed() === 2
            && !$path->isThereAreFiguresOnWay()
        ) {
            $this->notMoving = false;
            return;
        }

        //Пешка может бить фигуры противника только по диагонали вперёд на одну клетку;

        $isBlackAndDownLeft = $path->getDirectionMovement() === DirectionMovement::DownLeft && $this->isBlack;
        $isBlackAndDownRight = $path->getDirectionMovement() === DirectionMovement::DownRight && $this->isBlack;

        $isWhiteAndUpLeft = $path->getDirectionMovement() === DirectionMovement::UpLeft && !$this->isBlack;
        $isWhiteAndUpRight = $path->getDirectionMovement() === DirectionMovement::UpRight && !$this->isBlack;

        $isDirectionSameAsColorForPunch = $isBlackAndDownLeft
            || $isBlackAndDownRight
            || $isWhiteAndUpLeft
            || $isWhiteAndUpRight;

        if (
            $isDirectionSameAsColorForPunch
            && $path->getNumberOfCellsPassed() === 1
            && $path->isThereAreFiguresOnWay()
        ) {
            $this->notMoving = false;
            return;
        }

        throw new \Exception(
            "The move {$path->getXFrom()}{$path->getYFrom()}-{$path->getXTo()}{$path->getYTo()} with {$this->__toString()} is impossible"
        );
    }
}
