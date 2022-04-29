### Option to ignore whitespaces on commit/patch creation
#### Ignore whitespace changes in IntelliJ 
```

https://youtrack.jetbrains.com/issue/IDEA-101663/
https://youtrack.jetbrains.com/issue/IDEA-186765
https://youtrack.jetbrains.com/issue/IDEA-186765
https://youtrack.jetbrains.com/issue/IDEA-107714
https://youtrack.jetbrains.com/issue/IDEA-12609/Equal-change-in-local-and-remote-should-not-be-a-conflict-and-ca
https://youtrack.jetbrains.com/issue/IDEA-113916

https://intellij-support.jetbrains.com/hc/en-us/community/posts/207017515-IDEA-makes-annoying-whitespaces-changes
https://intellij-support.jetbrains.com/hc/en-us/community/posts/206842935-Git-merge-ignore-whitespaces

https://stackoverflow.com/questions/19935317/ignore-whitespace-changes-in-intellij-changebars
https://gist.github.com/NickCraver/3c7fd53e329f7477e17154168025c446
https://stackoverflow.com/questions/12427779/how-do-you-make-git-ignore-spaces-and-tabs


https://www.jetbrains.com/help/idea/apply-changes-from-one-branch-to-another.html#merge
https://www.jetbrains.com/help/idea/resolve-conflicts.html#
https://www.jetbrains.com/help/idea/work-on-several-features-simultaneously.html
https://www.jetbrains.com/help/space/merge-request.html


git diff -U0 -w --no-color | git apply --cached --ignore-whitespace --unidiff-zero -
git diff --color-words
git diff --word-diff=plain

Settings -> Editor -> Color Scheme -> VSC -> Editor Gutter -> Whitespace-modified lines

--
https://www.jetbrains.com/help/idea/resolve-conflicts.html#resolve-conflicts-productivity-tips
https://www.jetbrains.com/help/idea/differences-viewer.html#diff-merge-viewer
https://www.jetbrains.com/help/idea/resolving-conflicts.html

Resolve conflicts
Click Merge in the Conflicts dialog, the Resolve link in the Local Changes view, or select the conflicting file in the editor and choose VCS | Git | Resolve Conflicts from the main menu.

To automatically merge all non-conflicting changes, click the Apply Non-Conflicting Changes button (Apply All Non-Conflicting Changes) on the toolbar. You can also use the the Apply Non-Conflicting Changes from the Left button (Apply Non-Conflicting Changes from the Left Side) and the Apply Non-Conflicting Changes from the Right button (Apply Non-Conflicting Changes from the Right Side) to merge non-conflicting changes from the left/right parts of the dialog respectively.

Apply non-conflicting changes automatically
You can configure IntelliJ IDEA to always apply non-conflicting changes automatically instead of telling it to do so from the Merge dialog. To do this, select the Automatically apply non-conflicting changes option on the Tools | Diff Merge page of the IDE settings Ctrl+Alt+S.


Handle conflicts related to LF and CRLF line endings

git config --global core.autocrlf true on Windows
git config --global core.autocrlf input on Linux and macOS.

```
