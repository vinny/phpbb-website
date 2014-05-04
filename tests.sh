set -e
echo "This will perform our test suite"
echo "Removing cache for the test enviroment"
rm -rf app/cache/test/
echo "Running phpunit tests:"
bin/phpunit -c app/
echo "Running the Sensio Labs Security Checker to ensure no dependencies have outstanding security advisories:"
bin/security-checker security:check composer.lock
