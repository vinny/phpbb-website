echo "This will execute the phpunit tests"
bin/phpunit -c app/
bin/security-checker security:check composer.lock
echo "Complete"
