# Install Instructions

1. Clone the repository
2. cd code/
3. curl -s http://getcomposer.org/installer | php
4. php composer.phar install
5. Open web/config.php in your browser and check for any problems
6. Copy app/config/parameters.dist.yml to app/config/parameters.yml and adjust the settings as needed
7. php app/console doctrine:database:create
8. php app/console doctrine:schema:update --force
