<?php

declare(strict_types=1);

enum DirectionMovement
{
    case Up;
    case Right;
    case Down;
    case Left;

    case UpLeft;
    case UpRight;
    case DownLeft;
    case DownRight;

    case Indefinite;
}
