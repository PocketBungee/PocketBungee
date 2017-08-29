#!/bin/bash
DIR="$(cd -P "$( dirname "${BASH_SOURCE[0]}" )" && pwd)"
cd "$DIR"

DO_LOOP="no"

while getopts "p:f:l" OPTION 2> /dev/null; do
	case ${OPTION} in
		p)
			PHP_BINARY="$OPTARG"
			;;
		f)
			POCKETBUNGEE_FILE="$OPTARG"
			;;
		l)
			DO_LOOP="yes"
			;;
		\?)
			break
			;;
	esac
done

if [ "$PHP_BINARY" == "" ]; then
	if [ -f ./bin/php7/bin/php ]; then
		export PHPRC=""
		PHP_BINARY="./bin/php7/bin/php"
	elif [[ ! -z $(type php) ]]; then
		PHP_BINARY=$(type -p php)
	else
		echo "Couldn't find a working PHP 7 binary, please use the installer."
		exit 1
	fi
fi

if [ "$POCKETBUNGEE_FILE" == "" ]; then
	if [ -f ./PocketBungee.phar ]; then
		POCKETBUNGEE_FILE="./PocketBungee.phar"
	elif [ -f ./src/pocketbungee/PocketBungee.php ]; then
		POCKETBUNGEE_FILE="./src/pocketbungee/PocketBungee.php"
	else
		echo "Couldn't find a valid PocketBungee installationn"
		exit 1
	fi
fi

LOOPS=0

set +e
while [ "$LOOPS" -eq 0 ] || [ "$DO_LOOP" == "yes" ]; do
	if [ "$DO_LOOP" == "yes" ]; then
		"$PHP_BINARY" "$POCKETBUNGEE_FILE" $@
	else
		exec "$PHP_BINARY" "$POCKETBUNGEE_FILE" $@
	fi
	if [ "$DO_LOOP" == "yes" ]; then
		if [ ${LOOPS} -gt 0 ]; then
			echo "Restarted $LOOPS times"
		fi 
		echo "To escape the loop, press CTRL+C now. Otherwise, wait 5 seconds for the server to restart."
		echo ""
		sleep 5
		((LOOPS++))
	fi
done
