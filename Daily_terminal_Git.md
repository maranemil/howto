## Daily Git CMDs

### Config Git on new location

- [x] git config -l
- [x] git config --get user.name
- [x] git config --get user.email
- [x] git config --global user.name "Administrator"
- [x] git config --global user.email "admin@example.com"
- [ ] ...
- 
### Add git ignore
```
* echo ".idea/*" >> .gitignore
* git commit -am "remove .idea"
```

### Git refresh the list of remote branches
```
https://stackoverflow.com/questions/36358265/when-does-git-refresh-the-list-of-remote-branches

git remote update origin --prune
git branch -a
```

### Git list changes commits
```
git log
git log --branches --not --remotes
git log origin/master..HEAD
git log --oneline
git log --oneline --branches
```

### Git count number of commits between two branches
```
git log --oneline mybranch ^master
git log --oneline mybranch ^master | wc -l
git rev-list --count my-branch ^master
git rev-list --count master..my-branch
git cherry master | wc -l
```

### Git list files
```
git show f5f3fa6e012adf5d2caf2e1310421ad8258950d3 --name-only
```

### Git reset
```
git reset --soft HEAD~1
git status
```

### Git  revert
```
git log --oneline
git revert 453436346
```

### Check pack
```
* git verify-pack -v ./.git/objects/pack/pack-......ea.pack
```

### Fetch with update repos list
```
git fetch --prune
```


### get last updates and abord if conflict
```
git fetch && git pull --rebase
git rebase --abord

git fetch -p -a && git pull --ff-only && git rebase master
git fetch -p && git pull && git rebase master && git rebase develop
git remote update origin --prune

# pull
git pull --rebase
git rebase --abort
git pull 
```


### for uncommitted changes
```
git stash
git pull
git stash apply

git stash
git switch branch
git stash pop # add changes back
git stash 
git stash -u
git stash list 
git stash apply stash@{2}
git stash drop stash@{2}
git stash clear
git status -s

# worktree
git worktree add ../name_path_hotfix main
git worktree remove .
git worktree list

# cherrypick
git remote -v
git log fixbug --oneline
git checkout dev
git cherry-pick hash
git cherry-pick hash1 hash2
git log dev --oneline

git pull
git rebase dev
git merge dev
```


### submodules
```
git clone ---recursive main-repo
git submodule update --init --recursive
git ls-treee HEAD submodulepath
git log --oneline
git switch branch 
git submodule add submodulepath
git rm submodulepath

git config --global  submodule.recusive true
git config --global push.recurseSubmodules on-demand
```

### ignore folder and include
```
/data/*
!/data/myfolder
```