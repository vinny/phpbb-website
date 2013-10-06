set -x
git status -sb
echo "If that showed anything abort now!!!!!!"
sleep 5
echo ""
git fetch public
echo ""
git fetch private
echo ""
git checkout master
echo ""
php composer.phar install
echo ""
tests.sh
echo ""
git merge public/master
echo ""
git merge private/master
echo ""
git checkout develop
echo ""
git merge public/develop
echo ""
git merge private/develop
echo ""
git merge master
echo ""
git checkout sandbox
echo ""
git merge private/sandbox
echo ""
git merge develop
echo ""
git merge private
echo ""
git merge private/private
echo ""
git merge master
echo ""
git checkout private
echo ""
git merge private/private
echo ""
git merge master
echo ""
git checkout master
echo ""
git push public master develop
echo ""
git push private master develop private sandbox
echo "DONE!!"
