set -x
git status -sb
echo ""
php composer.phar self-update
# Comment this line if no phar in path
composer self-update
echo ""
# If no composer in your path then comment this line and uncomment Ln 10
composer update -v --dev
# php composer.phar update --dev
echo ""
bin/phpunit -c app/
echo ""
echo "COMPLETE!"
