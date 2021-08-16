
### git cheatsheet

Descriptions|		CMD		|		CMD Alternative
--------|---------|-----------------
Unstage last commits |	git reset HEAD file|	
Unset Last Commits	| git reset HEAD~ |	
Restore branch to remote one |	git fetch origin	| git reset --hard origin/master
Remove ignored files |	git clean -f -X | git clean -fX	
Remove ignored and non-ignored files	|git clean -f -x | git clean -fx	
Remove directories	| git clean -f -d | git clean -fd	
Print unpushed changes |	git log --branches --not --remotes --simplify-by-decoration --decorate --oneline |	git log origin/master..HEAD --graph --oneline --all --decorate --color
Get info branches |	 git branch -ra -vv	 |
Delete remote Branch|	git push origin --delete branchName	 |
Delete local Branch if wasn’t merged |	git branch -D branchName	 |
Delete local Branch if was fully merged	| git branch -d branchName	 |
Create new Branch |	git checkout -b branchName
Check diff branches	| git diff --name-status master brachname |	git diff --stat --color master brachname
Check conflict files |	git diff --name-only --diff-filter=U	
Check branch last edit | git for-each-ref --sort='-committerdate:iso8601' --format=' %(committerdate:iso8601)%09%(refname)' refs/heads
Check branch last edit | git for-each-ref --sort='-committerdate:iso8601' --format=' %(committerdate:iso8601)%09%(refname)' refs/remotes
Check branch last edit | git for-each-ref --sort='-authordate:iso8601' --format=' %(authordate:relative)%09%(refname:short)' refs/heads
Print modified files into line | git ls-files --modified |  tr '\n' ' '
Print modified files  | git ls-files --modified
Remove file from commited | git restore --staged <file>
Check remote branch last edit | git for-each-ref --sort='-committerdate:iso8601' --format='%(refname:short)%09%(author)%09%(committerdate:iso8601)' refs/remotes/origin
Check remote branch last edit | git ls-remote --heads origin
See "git help gc" for manual housekeeping.  | git gc
remove staged file |git restore --staged file
reverse changed files not yet commited | git checkout -- .
save changes in stash for untracked files | git stash -u
optimize git |  git gc

#### push existing local repo from cmd line to GitHub 

* git remote add origin <GitHub url>
* git branch -M main
* git push -u origin main