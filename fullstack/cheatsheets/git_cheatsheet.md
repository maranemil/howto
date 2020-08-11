
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
Delete remote Branch|	git push origin --delete <branchName>	 |
Delete local Branch if wasn’t merged |	git branch -D <branchName>	 |
Delete local Branch if was fully merged	| git branch -d <branchName>	 |
Create new Branch |	git checkout -b <branchName>	
Check diff branches	| git diff --name-status master brachname |	git diff --stat --color master brachname
Check conflict files |	git diff --name-only --diff-filter=U	

