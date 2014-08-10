set -ex
git status -sb
sleep 5
git fetch public
git fetch private
git checkout private
bin/phpunit -c app/
sleep 10
git checkout www1-stable
git pull private www1-stable
git merge --no-ff private
bin/phpunit -c app/
sleep 10
git push private www1-stable
