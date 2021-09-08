gitlab  Command line instructions


# Git global setup

git config --global user.name "Administrator"
git config --global user.email "admin@example.com"

# Create a new repository

git clone git@limex-VirtualBox:root/wtfidid.git
cd wtfidid
touch README.md
git add README.md
git commit -m "add README"
git push -u origin master

# Existing folder

cd existing_folder
git init
git remote add origin git@limex-VirtualBox:root/wtfidid.git
git add .
git commit
git push -u origin master

# Existing Git repository

cd existing_repo
git remote add origin git@limex-VirtualBox:root/wtfidid.git
git push -u origin --all
git push -u origin --tags

################################################################
#
#   bitbucket
#
################################################################

First start from scratch


Set up Git on your machine if you haven't already

mkdir /path/to/your/project
cd /path/to/your/project
git init
git remote add origin https://arunpksh@bitbucket.org/arunpksh/nanosculpt.git

Create your first file, commit, and push

echo "Arun Prakash" >> contributors.txt
git add contributors.txt
git commit -m 'Initial commit with contributors'
git push -u origin master

+
+
+

git init
git remote add origin sshkey
example: git remote add origin ssh://git@bitbucket.org/username/projname.git
git status
git add *
git status
git commit -m "This is the very first initial commit"
git status
git push origin master

+
+
+
+

> cd /path/to/my/repo
> git remote add origin https://me@bitbucket.org/me/test.git
> git push -u origin --all # pushes up the repo and its refs for the first time
> git push -u origin --tags # pushes up any tags

+
+
+
+

git init
git add .
git commit -m "message"
Then follow the steps from the initial page of the repo:

git remote add origin https://xxxx@bitbucket.org/xxx/xxx.git
git push -u origin --all
git push -u origin --tags

+
+
+


cd /path/to/my/repo
git remote add origin https://xxxx@bitbucket.org/xxxx/sitename.git
git push -u origin --all
git push -u origin --tags

git push --set-upstream origin master

# push changes to branch
git push --set-upstream origin branch

v
1. git init .
2. git checkout -b master
3. git commit -am "first commit"
4. git push -u origin --all

1. cd /path/to/my/repo
2. git init
3. git commit -am "first commit"
4. git push -u origin --all

git push origin master


-------------------
https://confluence.atlassian.com/bitbucket/copy-your-git-repository-and-add-files-746520876.html
https://confluence.atlassian.com/bitbucket/clone-a-repository-223217891.html
https://confluence.atlassian.com/bitbucket/use-the-ssh-protocol-with-bitbucket-cloud-221449711.html
https://www.atlassian.com/git/tutorials/git-hooks
https://confluence.atlassian.com/bitbucket/push-updates-to-a-repo-221449525.html
https://confluence.atlassian.com/bitbucket/create-a-repository-for-your-existing-files-800695576.html
https://guides.co/g/bitbucket-101/11158

https://gist.github.com/mandiwise/5954bbb2e95c011885ff
https://gist.github.com/rosswd/e1afd2b0b0d515517eac


################################################################
#
#   13 Advanced (but useful) Git Techniques and Shortcuts
#   https://www.youtube.com/watch?v=ecK3EnyGD8o
#
################################################################

# add all files to commit in 2 steps
git add .
git commit -m "hi mom"

# add all files to commit in one step
git commit -am "hi mom"

# correct last commit message
git commit --amend -m "nicer"

# add files to last commit if remote repo
git commit --amend --no-edit

# overwite history on remote
# git push origin master --force
git push origin master --force-with-lease


# revert
#git revert feature_branch
git log --oneline
git revert 453436346

--------------------------------------------------------
# temp work with stash
--------------------------------------------------------
git stash  		# save temp code and remove
git stash pop	# restore temp code

git stash save coolstuff
git stash list
git stash apply 0

# master goes into main mega mucho - rename branch
git branch -M mega

# nice log view
git log --graph --oneline --decorate

--------------------------------------------------------
# stat from last stable
--------------------------------------------------------
git bisect start
git bisect bad
git bisect good 6d010fd

--------------------------------------------------------
# mix more fixes in one
--------------------------------------------------------
git rebase master --interactive # genearates a to-do file

# file git-rebase-todo
pick  7er10fd feature complete
squash  6d010fd 1
squash  3d010gd 2
squash  5d010ed 3

git commit --fixup fb5f6999
git commit --squash fb5f697s
git rebase -i --autosquash

--------------------------------------------------------
// git hooks # for js there is and npm pack named husky
--------------------------------------------------------
npm install husly -D
npm set-script prepapre "husky install"
npm run prepare

// add hook
npx husky add .husky/pre-commit "npm test"
git add .husky/pre-commit

// make commit
git commit -m "new coomit"

--------------------------------------------------------
// destruction
--------------------------------------------------------
git fetch origin
git reset --hard origin/master
git clean -df
rm -rf .git


# go to last or previous branch
git checkout -

# performs a merge without fast-forwarding
git merge --no-ff

# revert a PR merge and avoid reverting every commit
git revert merge_commit_id -m 1

# pick the commits(changes) from different branches to current branch
git cherry-pick

--------------------------------------------------------
create new branch
--------------------------------------------------------
git branch new-branch && git checkout new-branch

or

git checkout -b new-branch

--------------------------------------------------------
# if you mess up something, can undo almost any operation
git reflog && git reset


# aliases
alias uncommit="git reset HEAD~1"
alias recommit="git commit --amend --no-edit"
alias editcommit="git commit --amend"
alias gs="git status"

# config
git config --global alias.magic '! git add . >/dev/null 2>&1 && git status --porcelain | git commit -F -'

# when updating a feature branch from dev / master
git rebase > git merge

# get feature branch commits into the staged files and proceed to one commit out of all changes.
git reset --soft master


https://git-scm.com/docs/git-checkout
https://www.atlassian.com/git/tutorials/resetting-checking-out-and-reverting
https://stackoverflow.com/questions/41101998/git-checkout-vs-git-checkout/41102120


