echo "Git Status:"
git status -sb
echo ""
echo "composer.phar Update:"
php composer.phar self-update
# Comment this line if no phar in path
composer self-update
echo ""
echo "Deps update:"
# If no composer in your path then comment this line and uncomment Ln 12
composer update -v --dev
# php composer.phar update --dev
echo ""
echo "Tests:"
bin/phpunit -c app/
echo ""
echo "COMPLETE!"
