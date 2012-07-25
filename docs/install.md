# Install Instructions

1. Clone the repository
2. Copy app/config/parameters.dist.yml to app/config/parameters.yml and adjust the settings as needed. 
Please select the database name as a database that does not exist and the user needs to be able to create databases.
3. cd code/
4. curl -s http://getcomposer.org/installer | php
5. php composer.phar install
6. Open web/config.php in your browser and check for any problems
7. php app/console doctrine:database:create
8. php app/console doctrine:schema:update --force
