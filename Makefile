ENTITY_DIRECTORY=src/EcoDoc/CoreBundle/Entity

clean-cache:
	php app/console --env=dev cache:clear --no-warmup
	php app/console --env=prod cache:clear --no-warmup

update-database:
	php app/console doctrine:schema:update --force

update-vendors:
	php bin/vendors install

install-database-data:update-database
	php app/console doctrine:fixtures:load

install-web-assets:
	 php app/console assets:install web

update:update-vendors update-database

install:update clean-cache install-database-data install-web-assets

clean:clean-cache
