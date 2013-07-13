# Ensure you have setup your parameters.yml and have no passkey on your ssh key before running this script.

php composer.phar self-update
git commit -am 'Update composer'
git remote add public git@github.com:phpbb/phpbb-website.git
git remote add private git@github.com:phpbb/phpbb-website-private.git
git push public master
git push private master
php composer.phar install
php app/console doctrine:database:create
php app/console doctrine:migrations:migrate
./merge.sh
