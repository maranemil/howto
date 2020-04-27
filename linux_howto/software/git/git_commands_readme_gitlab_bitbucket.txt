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

################################
#
#   bitbucket
#
################################

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