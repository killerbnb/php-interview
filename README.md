Chess
=====

`chess.php` is a CLI program that displays chess games.
It receives players' moves as arguments and prints the board state
with figure positions after those moves.

Example:

`php chess.php e2-e4 e7-e5`

<img src="example.png" width="405" height="349" alt="Example of the program execution"/>

Validation:

Currently `chess.php` does nothing to verify chess rules in those moves.
And you don't need to implement each rule for the game.

Add only the validations required by the tasks below.

## Task 1

Task 1: modify the program so that it throws an exception
when player move order is wrong (e.g. if whites make two moves in a row).

To verify your solution, run tests:

```shell
# Linux:
$ ./vendor/bin/phpunit --group=rotation

# Windows:
> php ./vendor/phpunit/phpunit/phpunit --group=rotation
```

## Task 2

Task 2: modify the program so that it throws an exception
when a pawn makes an illegal move.

To verify your solution, run tests:

```shell
# Linux:
$ ./vendor/bin/phpunit --group=pawn

# Windows:
> php ./vendor/phpunit/phpunit/phpunit --group=pawn
```

Tests only move pawns, other figures are not moved,
so you are safe to ignore non-pawn specifics in your solution.

### Chess pawn rules

 * A pawn can move forward (vertically) by 1 square;
 * The first time a pawn moves, it may move forward by 2 squares instead of 1;
 * Pawns cannot jump over other figures;
 * Pawns can capture enemy figures only by diagonally moving 1 square forward;
 * En passant capture also exists, but don't bother about it :)
