@echo off
TITLE PocketBungee
cd /d %~dp0

if exist bin\php\php.exe (
	set PHPRC=""
	set PHP_BINARY=bin\php\php.exe
) else (
	set PHP_BINARY=php
)

if exist PocketMine-MP.phar (
	set POCKETBUNGEE_FILE=PocketBungee.phar
) else (
	if exist src\pocketbungee\PocketBungee.php (
		set POCKETBUNGEE_FILE=src\pocketbungee\PocketBungee.php
	) else (
		echo "Couldn't find a valid PocketBungee installation"
		pause
		exit 1
	)
)

if exist bin\mintty.exe (
	start "" bin\mintty.exe -o Columns=88 -o Rows=32 -o AllowBlinking=0 -o FontQuality=3 -o Font="Consolas" -o FontHeight=10 -o CursorType=0 -o CursorBlinks=1 -h error -t "PocketBungee" -i bin/pocketbungee.ico -w max %PHP_BINARY% %POCKETBUNGEE_FILE% --enable-ansi %*
) else (
	%PHP_BINARY% -c bin\php %POCKETBUNGEE_FILE% %*
)