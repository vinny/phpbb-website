git status -sb
echo "If that showed anything abort now!!!!!!"
sleep 5
echo ""
echo "git fetch public"
git fetch public
echo ""
echo "git fetch private"
git fetch private
echo ""
echo "git checkout master"
git checkout master
echo ""
echo "bin/phpunit -c app/"
bin/phpunit -c app/
echo ""
echo "git merge public/master"
git merge public/master
echo ""
echo "git merge private/master"
git merge private/master
echo ""
echo "git checkout develop"
git checkout develop
echo ""
echo "git merge public/develop"
git merge public/develop
echo ""
echo "git merge private/develop"
git merge private/develop
echo ""
echo "git merge master"
git merge master
echo ""
echo "git checkout sandbox"
git checkout sandbox
echo ""
echo "git merge private/sandbox"
git merge private/sandbox
echo ""
echo "git merge develop"
git merge develop
echo ""
echo "git merge private"
git merge private
echo ""
echo "git merge private/private"
git merge private/private
echo ""
echo "git merge master"
git merge master
echo ""
echo "git checkout private"
git checkout private
echo ""
echo "git merge private/private"
git merge private/private
echo ""
echo "git merge master"
git merge master
echo ""
echo "git checkout master"
git checkout master
echo ""
echo "git push public master develop"
git push public master develop
echo ""
echo "git push private master develop private sandbox"
git push private master develop private sandbox
echo "Done"
