<?php

declare(strict_types=1);

class Path
{
    private const array HORIZONTAL = [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => 4,
        'e' => 5,
        'f' => 6,
        'g' => 7,
        'h' => 8,
    ];

    private bool $thereIsFigureOnPathMovement;

    private TypeMoving $typeMoving;

    private DirectionMovement $directionMovement;

    private int $numberOfCellsPassed = 0;

    private int $xIntFrom;

    private int $xIntTo;

    private int $xPath;

    private int $yPath;

    private bool $isThereAreFiguresOnWay = false;

    public function __construct(
        private array $figures,
        private string $xFrom,
        private int $yFrom,
        private string $xTo,
        private int $yTo
    ) {
        $this->xIntFrom = static::HORIZONTAL[$this->xFrom];
        $this->xIntTo = static::HORIZONTAL[$this->xTo];

        $this->xPath = abs($this->xIntFrom - $this->xIntTo);
        $this->yPath = abs($this->yFrom - $this->yTo);

        $this->setTypeMoving();
        $this->setNumberOfCellsPassed();
        $this->setDirectionMovement();
        $this->setThereAreFiguresOnWay();
    }

    public function isThereAreFiguresOnWay(): bool
    {
        return $this->isThereAreFiguresOnWay;
    }

    public function getNumberOfCellsPassed(): int
    {
        return $this->numberOfCellsPassed;
    }

    public function getDirectionMovement(): DirectionMovement
    {
        return $this->directionMovement;
    }

    private function setTypeMoving()
    {
        if ($this->xFrom === $this->xTo || $this->yFrom === $this->yTo) {
            $this->typeMoving = TypeMoving::Direct;
        } elseif ($this->xPath === $this->yPath) {
            $this->typeMoving = TypeMoving::Diagonal;
        } else {
            $this->typeMoving = TypeMoving::Indefinite;
        }
    }

    public function getXFrom(): string
    {
        return $this->xFrom;
    }

    public function getXTo(): string
    {
        return $this->xTo;
    }

    public function getYFrom(): int
    {
        return $this->yFrom;
    }

    public function getYTo(): int
    {
        return $this->yTo;
    }

    private function setNumberOfCellsPassed()
    {
        if ($this->typeMoving === TypeMoving::Direct) {
            $this->numberOfCellsPassed = max($this->xPath, $this->yPath);
        }
        if ($this->typeMoving === TypeMoving::Diagonal) {
            $this->numberOfCellsPassed = $this->xPath;
        }
    }

    private function setDirectionMovement()
    {
        if ($this->typeMoving === TypeMoving::Direct) {
            if ($this->xIntFrom > $this->xIntTo) {
                $this->directionMovement = DirectionMovement::Left;
            } elseif ($this->xIntFrom < $this->xIntTo) {
                $this->directionMovement = DirectionMovement::Right;
            } elseif ($this->yFrom < $this->yTo) {
                $this->directionMovement = DirectionMovement::Up;
            } elseif ($this->yFrom > $this->yTo) {
                $this->directionMovement = DirectionMovement::Down;
            } else {
                $this->directionMovement = DirectionMovement::Indefinite;
            }
        } elseif ($this->typeMoving === TypeMoving::Diagonal) {
            if ($this->xIntFrom < $this->xIntTo && $this->yFrom < $this->yTo) {
                $this->directionMovement = DirectionMovement::UpRight;
            } elseif ($this->xIntFrom > $this->xIntTo && $this->yFrom > $this->yTo) {
                $this->directionMovement = DirectionMovement::DownRight;
            } elseif ($this->xIntFrom < $this->xIntTo && $this->yFrom > $this->yTo) {
                $this->directionMovement = DirectionMovement::DownLeft;
            } elseif ($this->xIntFrom > $this->xIntTo && $this->yFrom < $this->yTo) {
                $this->directionMovement = DirectionMovement::UpLeft;
            } else {
                $this->directionMovement = DirectionMovement::Indefinite;
            }
        }
    }

    private function setThereAreFiguresOnWay()
    {
        if ($this->typeMoving === TypeMoving::Direct) {
            if ($this->directionMovement === DirectionMovement::Up) {
                for ($i = $this->yFrom + 1; $i <= $this->yTo; $i++) {
                    if (isset($this->figures[$this->xFrom][$i])) {
                        $this->isThereAreFiguresOnWay = true;
                    }
                }
            }elseif ($this->directionMovement === DirectionMovement::Down) {
                for ($i = $this->yFrom - 1; $i >= $this->yTo; $i--) {
                    if (isset($this->figures[$this->xFrom][$i])) {
                        $this->isThereAreFiguresOnWay = true;
                    }
                }
            }
        }elseif ($this->typeMoving === TypeMoving::Diagonal) {
            $horizontalKey = array_flip(static::HORIZONTAL);
            if ($this->directionMovement === DirectionMovement::UpLeft) {
                for ($i = 1; $i <= $this->numberOfCellsPassed; $i++) {
                    $xValue = $horizontalKey[$this->xIntFrom - $i];
                    if (isset($this->figures[$xValue][$this->yFrom + $i])) {
                        $this->isThereAreFiguresOnWay = true;
                    }
                }
            }elseif ($this->directionMovement === DirectionMovement::UpRight) {
                for ($i = 1; $i <= $this->numberOfCellsPassed; $i++) {
                    $xValue = $horizontalKey[$this->xIntFrom + $i];
                    if (isset($this->figures[$xValue][$this->yFrom + $i])) {
                        $this->isThereAreFiguresOnWay = true;
                    }
                }
            }elseif ($this->directionMovement === DirectionMovement::DownLeft) {
                for ($i = 1; $i <= $this->numberOfCellsPassed; $i++) {
                    $xValue = $horizontalKey[$this->xIntFrom - $i];
                    if (isset($this->figures[$xValue][$this->yFrom - $i])) {
                        $this->isThereAreFiguresOnWay = true;
                    }
                }
            }elseif ($this->directionMovement === DirectionMovement::DownRight) {
                for ($i = 1; $i <= $this->numberOfCellsPassed; $i++) {
                    $xValue = $horizontalKey[$this->xIntFrom + $i];
                    if (isset($this->figures[$xValue][$this->yFrom - $i])) {
                        $this->isThereAreFiguresOnWay = true;
                    }
                }
            }
        }
    }
}
