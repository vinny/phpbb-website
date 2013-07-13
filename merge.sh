git fetch public
git fetch private
git checkout master
git merge public/master
git merge private/master
git checkout develop
git merge public/develop
git merge private/develop
git merge master
git checkout private
git merge private/private
git merge master
git checkout sandbox
git merge private/sandbox
git merge develop
git merge private
git push origin master develop
git push private master develop private sandbox
echo "Done"
