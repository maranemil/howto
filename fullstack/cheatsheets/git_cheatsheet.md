
### git cheatsheet
```
 | Descriptions                                 | 		CMD		                                                                                                          | 		CMD Alternative                                                       |
|----------------------------------------------|------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------|
| Unstage last commits                         | git reset HEAD file                                                                                              | -	                                                                      |
| Unset Last Commits	                        | git reset HEAD~                                                                                                  | 	 git reset --hard HEAD~1                                               |
| Restore branch to remote one                 | git fetch origin	                                                                                               | git reset --hard origin/master                                          |
| Remove ignored files                         | git clean -f -X                                                                                                  | git clean -fX	                                                          |
| Remove ignored and non-ignored files	        | git clean -f -x                                                                                                  | git clean -fx	                                                          |
| Remove directories	                        | git clean -f -d                                                                                                  | git clean -fd	                                                          |
| Print unpushed changes                       | git log --branches --not --remotes --simplify-by-decoration --decorate --oneline                                 | 	git log origin/master..HEAD --graph --oneline --all --decorate --color |
| Get info branches                            | git branch -ra -vv	                                                                                           | -                                                                       |
| Delete remote Branch                         | git push origin --delete branchName	                                                                           | -                                                                       |
| Delete local Branch if wasn’t merged         | git branch -D branchName	                                                                                       | -                                                                       |
| Delete local Branch if was fully merged	    | git branch -d branchName	                                                                                       | -                                                                       |
| Create new Branch                            | git checkout -b branchName                                                                                       | -                                                                       |
| Check diff branches	                        | git diff --name-status master brachname                                                                          | 	git diff --stat --color master brachname                               |
| Check conflict files                         | git diff --name-only --diff-filter=U	                                                                           | -                                                                       |
| Check branch last edit                       | git for-each-ref --sort='-committerdate:iso8601' --format=' %(committerdate:iso8601)%09%(refname)' refs/heads    | -                                                                       |
| Check branch last edit                       | git for-each-ref --sort='-committerdate:iso8601' --format=' %(committerdate:iso8601)%09%(refname)' refs/remotes  | -                                                                       |
| Check branch last edit                       | git for-each-ref --sort='-authordate:iso8601' --format=' %(authordate:relative)%09%(refname:short)' refs/heads   | -                                                                       |
| Print modified files into line               | git ls-files --modified                                                                                          | tr '\n' ' '                                                             |
| Print modified files                         | git ls-files --modified                                                                                          | -                                                                       |
| Remove file from commited                    | git restore --staged <file>                                                                                      | -                                                                       |
| Check remote branch last edit                | git ls-remote --heads origin                                                                                     | -                                                                       |
| See "git help gc" for manual housekeeping.   | git gc                                                                                                           | -                                                                       |
| remove staged file                           | git restore --staged file                                                                                        | -                                                                       |
| reverse changed files not yet commited       | git checkout -- .                                                                                                | -                                                                       |
| save changes in stash for untracked files    | git stash -u                                                                                                     | -                                                                       |
| optimize git                                 | git gc                                                                                                           | -                                                                       |
```


#### Check remote branch last edit
```
git for-each-ref --sort='-committerdate:iso8601' --format='%(refname:short)%09%(author)%09%(committerdate:iso8601)' refs/remotes/origin 
```

#### push existing local repo from cmd line to GitHub 
```
* git remote add origin <GitHub url>
* git branch -M main
* git push -u origin main
```

#### [checkout a Remote Branch]
```
git fetch origin
git branch -v -a
git fetch origin feature/blabla-70
```

##### [undo merge]
```
git reset --hard HEAD~1
git reset --hard commit_sha # alternativ
```

##### undo a merge that was already pushed:
```
git revert -m 1 commit_hash
```

##### github push
```
git push --progress --porcelain origin refs/heads/master:master
```

#### push request
```
git push --set-upstream origin branch-name
```

#### pretty-formats tree
```
https://git-scm.com/docs/pretty-formats
https://stackoverflow.com/questions/2421011/output-of-git-branch-in-tree-like-fashion

git log --graph --simplify-by-decoration --all --pretty=oneline
git log --graph --simplify-by-decoration --all --pretty=format:'%d' 

git log --graph --pretty=oneline --abbrev-commit
git log --graph --oneline --decorate --all
```

### misc intellij git
```
# log
git -c credential.helper= -c core.quotepath=false -c log.showSignature=false  log

# merge
git merge origin/develop --no-stat -v

# fetch
git fetch origin --recurse-submodules=no --progress --prune

# all in one
git checkout mybranch --
git fetch origin --recurse-submodules=no --progress --prune
git merge origin/mybranch --no-stat -v
```

~~~
#################################################
list all the files in a commit
#################################################

https://stackoverflow.com/questions/424071/how-do-i-list-all-the-files-in-a-commit
https://git-scm.com/docs/git-show
https://stackoverflow.com/questions/1230084/how-to-have-git-log-show-filenames-like-svn-log-v

git log --name-only
git log --name-only --oneline
git log --name-status
git log --stat
git log --stat --pretty=short --graph

git show --stat --oneline HEAD
git show --name-only --oneline HEAD
~~~