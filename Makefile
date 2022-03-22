all:	php-cs-fixer phpstan psalm

psalm:
	vendor/bin/psalm $(EXTRA)

php-cs-fixer:
	vendor/bin/php-cs-fixer fix $(EXTRA)

phpstan:
	vendor/bin/phpstan --memory-limit=16384M analyse -vvv -l 9 src $(EXTRA)
