set -e
echo "This script will merge all the branches as is required. To use this script you need to have setup both the private and public parts of the phpBB website and this is designed for use by core committers to the phpBB website only."
echo ""
echo "This script should exit should any problems occur but please watch it and should you notice anything go wrong, please hit Ctrl + C to stop script execution"
echo ""
echo "Running this script is not enough to deploy onto .com. Bamboo will handle merging private into www1-stable which is the branch used to update .com and that will only occur if tests pass. If this is an urgent fix and cannot wait for bamboo run the deploy.sh script immediately after this script"
echo ""
echo "   ------------ This script will now begin ------------   "
echo ""
echo "Git status:"
git status -sb
echo "If that showed anything abort now!!!!!!"
sleep 5
echo ""
echo "$ git fetch public"
git fetch public
echo ""
echo "$ git fetch private"
git fetch private
echo ""
echo "$ git checkout master"
git checkout master
echo ""
echo "$ git merge public/master && git merge private/master"
git merge public/master
git merge private/master
echo ""
echo "Install composer deps:"
echo "------------------------"
php composer.phar install
echo ""
echo "Tests:"
echo "--------"
tests.sh
echo ""
echo "Checkout develop branch:"
echo "--------------------------"
git checkout develop
echo ""
echo "$ git merge public/develop && git merge private/develop"
git merge public/develop
git merge private/develop
echo ""
echo "Merge master branch into develop branch:"
echo "------------------------------------------"
git merge master
echo ""
echo "Checkout sandbox branch:"
echo "--------------------------"
git checkout sandbox
echo ""
echo "$ git merge private/sandbox"
git merge private/sandbox
echo ""
echo "Merge private branch into sandbox branch:"
echo "--------------------------------------------"
git merge private
echo ""
echo "Merge develop (inclusive of master branch changes) into sandbox branch:"
echo "--------------------------------------------------------------------------"
git merge develop
echo ""
echo "$ git merge private/private"
git merge private/private
echo ""
echo "Merge master branch into sandbox branch:"
echo "------------------------------------------"
git merge master
echo ""
echo "Checkout private branch:"
echo "--------------------------"
git checkout private
echo ""
echo "$ git merge private/private"
git merge private/private
echo ""
echo "Merge master branch into private branch:"
echo "-------------------------------------------"
git merge master
echo ""
echo "Checkout master branch:"
echo "--------------------------"
git checkout master
echo ""
echo "Push master & develop branches to publc repository:"
echo "------------------------------------------------------"
git push public master develop
echo ""
echo "Push master, develop, sandbox & private branches to private repository:"
echo "--------------------------------------------------------------------------"
git push private master develop private sandbox
echo "DONE!!"
