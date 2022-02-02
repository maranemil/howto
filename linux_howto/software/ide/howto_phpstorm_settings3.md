
######
###	How can I completely remove the License Information
######
~~~
--- Linux and other Unix sytems ---

sudo rm -rf ~/.WebIde70
sudo rm -rf ~/.WebIde90

--- Mac OS X 10.8 Mountain Lion ---

!/usr/bin/sh

rm -rf "$HOME/Library/Preferences/WebIde40"
rm -rf "$HOME/Library/Caches/WebIde40"
rm -rf "$HOME/Library/Application Support/WebIde40"
rm -rf "$HOME/Library/Logs/WebIde40"

PhpStorm Early Access Program
https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Early+Access+Program

Directories used by the IDE to store settings, caches, plugins and logs
https://intellij-support.jetbrains.com/hc/en-us/articles/206544519
~~~

######
#
###	PHPSTORM : external file changes sync may be slow
###	Project files cannot be watched (are they under network mount?)"
######
~~~
cat /proc/sys/fs/inotify/max_user_watches  # 524288
cat /proc/sys/fs/inotify/max_user_watches
/etc/sysctl.d/60-jetbrains.conf # fs.inotify.max_user_watches = 524288

# It can be raised by adding following line to the /etc/sysctl.conf file:
fs.inotify.max_user_watches = 524288

#and issuing this command to apply the change:
sudo sysctl -p
ps axf

sudo chmod +x /opt/PhpStorm-163.10504.2/bin/fsnotifier
sudo chmod +x /opt/PhpStorm-163.10504.2/bin/fsnotifier64

/opt/PhpStorm-163.10504.2/bin$ ./fsnotifier64 --selftest
~~~
---
~~~
ll /proc/sys/fs/inotify/
max_queued_events
max_user_instances
max_user_watches
~~~
---
~~~
caffeinate &
umount -f /Volumes/$MOUNTDIR/
umount -f /Users/$HOMEUSER/$MOUNTDIR
mkdir /Users/$HOMEUSER/$MOUNTDIR
sshfs $HOMEUSER@@SERVERADDR:/usr/$HOMEUSER/$MOUNTDIR /Users/$HOMEUSER/$MOUNTDIR
~~~

######
#
###	How can I completely remove the License Information
######
~~~
--- Linux and other Unix sytems ---

sudo rm -rf ~/.WebIde70
sudo rm -rf ~/.WebIde90

--- Mac OS X 10.8 Mountain Lion ---

!/usr/bin/sh

rm -rf "$HOME/Library/Preferences/WebIde40"
rm -rf "$HOME/Library/Caches/WebIde40"
rm -rf "$HOME/Library/Application Support/WebIde40"
rm -rf "$HOME/Library/Logs/WebIde40"


PhpStorm Early Access Program
https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Early+Access+Program

Directories used by the IDE to store settings, caches, plugins and logs
https://intellij-support.jetbrains.com/hc/en-us/articles/206544519
~~~

######
#
###   ~/PhpStorm-102.206/bin/webide.vmoptions
######
~~~
-Xms32m
-Xmx512m
-XX:MaxPermSize=512m
-ea
-Didea.platform.prefix=PhpStorm
-Xmx2400m
-XX:MaxPermSize=2400m
-XX:ParallelGCThreads=6

# increase Xmx by 25-30%
~~~

######
#
### sudo nano /opt/PhpStorm-141.2462/bin/phpstorm.vmoptions
### /opt/PhpStorm-141.2462/bin/phpstorm.vmoptions
### ORIGINAL SETTINGS
######
~~~
-server
-Xms128m
-Xmx512m
-XX:MaxPermSize=250m
-XX:ReservedCodeCacheSize=150m
-XX:+UseConcMarkSweepGC
-XX:SoftRefLRUPolicyMSPerMB=50
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-Dawt.useSystemAAFontSettings=lcd
~~~

######
### /opt/PhpStorm-141.2462/bin/phpstorm.vmoptions
### MODIFIED SETTINGS
######
~~~
-server
-Xms128m
-Xmx512m
-Xss16m
-XX:MaxPermSize=150m
-XX:ReservedCodeCacheSize=250m
-XX:SoftRefLRUPolicyMSPerMB=50
-XX:+UseCodeCacheFlushing

-XX:+UseParNewGC
-XX:ParallelGCThreads=2
-XX:+UseConcMarkSweepGC
-XX:ConcGCThreads=2
-XX:MaxTenuringThreshold=1

-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-Dawt.useSystemAAFontSettings=lcd
-agentlib:yjpagent
~~~
-------------------------------------------------
~~~
For the 32-bit systems:
-agentlib:yjpagent-linux=delay=10000

For the 64-bit systems:
-agentlib:yjpagent-linux64=delay=10000

CPU Snapshot with Invocation Counts:
-Dprofile.trace=true

Memory Snapshot:
-XX:+HeapDumpOnOutOfMemoryError
-XX:HeapDumpPath=/dumps/folder

jmap Binary Memory Snapshot
jmap -dump:live,format=b,file=heap.bin <pid>

Profiling Slow Startup
-agentlib:yjpagent=sampling
~~~


######
#
###   Best experience with following options (idea64.exe.vmoptions):
######
~~~
-server
-Xms1g
-Xmx3g
-Xss16m
-XX:NewRatio=3
-XX:ReservedCodeCacheSize=240m
-XX:+UseCompressedOops
-XX:SoftRefLRUPolicyMSPerMB=50
-XX:+UseParNewGC
-XX:ParallelGCThreads=4
-XX:+UseConcMarkSweepGC
-XX:ConcGCThreads=4
-XX:+CMSClassUnloadingEnabled
-XX:+CMSParallelRemarkEnabled
-XX:CMSInitiatingOccupancyFraction=65
-XX:+CMSScavengeBeforeRemark
-XX:+UseCMSInitiatingOccupancyOnly
-XX:MaxTenuringThreshold=1
-XX:SurvivorRatio=8
-XX:+UseCodeCacheFlushing
-XX:+AggressiveOpts
-XX:-TraceClassUnloading
-XX:+AlwaysPreTouch
-XX:+TieredCompilation

-Djava.net.preferIPv4Stack=true
-Dsun.io.useCanonCaches=false
-Djsse.enableSNIExtension=true
-ea
~~~


######
#
####   Debug
######
~~~
jps -mv
jstack -l <PID>
jstack -l <PID> > dump.txt

12189 Main -Xbootclasspath/a:/opt/PhpStorm-141.2462/bin/../lib/boot.jar -Xms128m -Xmx750m -XX:MaxPermSize=350m -XX:ReservedCodeCacheSize=225m -XX:+UseConcMarkSweepGC -XX:SoftRefLRUPolicyMSPerMB=50 -ea -Dsun.io.useCanonCaches=false -Djava.net.preferIPv4Stack=true -Dawt.useSystemAAFontSettings=lcd -Djb.vmOptionsFile=/opt/PhpStorm-141.2462/bin/phpstorm64.vmoptions -XX:ErrorFile=/home/robn/java_error_in_WEBIDE_%p.log -Djb.restart.code=88 -Didea.paths.selector=WebIde90 -Didea.platform.prefix=PhpStorm -Didea.no.jre.check=true
12436 Jps -mv -Dapplication.home=/usr/lib/jvm/java-7-oracle -Xms8m

-Xms512m
-Xmx1024m
-XX:MaxPermSize=512m
-ea
-server
-XX:+DoEscapeAnalysis
-XX:+UseCompressedOops
-XX:+UnlockExperimentalVMOptions
-XX:+UseParallelGC

-XX:+UseConcMarkSweepGC //removed
// removed, because not needed with the lastest JVM.
    -XX:+UnlockExperimentalVMOptions
    -XX:+DoEscapeAnalysis
    -XX:+UseCompressedOops
~~~

######
#
###    Intellij13
######
~~~
-ea
-server
-Xms1g
-Xmx1g
-Xss16m
-XX:PermSize=256m
-XX:MaxPermSize=256m
-XX:+DoEscapeAnalysis
-XX:+UseCompressedOops
-XX:+UnlockExperimentalVMOptions
-XX:+UseConcMarkSweepGC
-XX:LargePageSizeInBytes=256m
-XX:ReservedCodeCacheSize=96m
-XX:+UseCodeCacheFlushing
-XX:+UseCompressedOops
-XX:ParallelGCThreads=8
-XX:+UseParNewGC
-XX:+UseConcMarkSweepGC
-XX:+DisableExplicitGC
-XX:+ExplicitGCInvokesConcurrent
-XX:+PrintGCDetails
-XX:+PrintFlagsFinal
-XX:+AggressiveOpts
-XX:+HeapDumpOnOutOfMemoryError
-XX:+CMSClassUnloadingEnabled
-XX:+CMSPermGenSweepingEnabled
-XX:CMSInitiatingOccupancyFraction=60
-XX:+CMSClassUnloadingEnabled
-XX:+CMSParallelRemarkEnabled
-XX:+UseAdaptiveGCBoundary
-XX:+UseSplitVerifier
-XX:CompileThreshold=10000
-XX:+UseCompressedStrings
-XX:+OptimizeStringConcat
-XX:+UseStringCache
-XX:+UseFastAccessorMethods
-XX:+UnlockDiagnosticVMOptions
~~~

######
#
###   phpstorm.vmoptions
######
~~~
-Xms128m
-Xmx750m
-XX:MaxPermSize=350m
-XX:ReservedCodeCacheSize=240m
-XX:+UseCompressedOops
~~~

######
#
###   phpstorm.vmoptions
######
~~~
-Xms256m
-Xmx1500m
-XX:MaxPermSize=700m
-XX:ReservedCodeCacheSize=480m
-XX:+UseCompressedOops
-Dawt.useSystemAAFontSettings=lcd
-Dawt.java2d.opengl=true
~~~

######
#
###   phpstorm.vmoptions experimentel
###   sudo nano /opt/PhpStorm-141.2462/bin/phpstorm.vmoptions
######
~~~
-server
-Xms1g
-Xmx1g
-Xss16m
-XX:MaxPermSize=256m
-XX:ReservedCodeCacheSize=256m
-XX:SoftRefLRUPolicyMSPerMB=50
-XX:+UseCodeCacheFlushing

-XX:+UseParNewGC
-XX:ParallelGCThreads=2
-XX:+UseConcMarkSweepGC
-XX:ConcGCThreads=1
-XX:MaxTenuringThreshold=2
-XX:+UseCompressedOops
-XX:+DoEscapeAnalysis
-XX:+DisableExplicitGC

-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-Dawt.useSystemAAFontSettings=lcd
-agentlib:yjpagent
~~~

######
#
###   Tuning PhpStorm in bin/phpstorm.vmoptionsx
######
~~~
-Xms128m
-Xmx2048m
-XX:MaxPermSize=350m
-XX:ReservedCodeCacheSize=64m
-XX:+UseCodeCacheFlushing
-XX:+UseCompressedOops
~~~
--------------------------------------------------
~~~
change size to -Xmx512m

-Xms128m
-Xmx512m
-XX:MaxPermSize=250m
-XX:ReservedCodeCacheSize=64m
-XX:+UseCodeCacheFlushing
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
~~~
--------------------------------------------------
~~~
server
-Xms128m
-Xmx512m
-XX:ReservedCodeCacheSize=240m
-XX:+UseConcMarkSweepGC
-XX:SoftRefLRUPolicyMSPerMB=50
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-XX:MaxJavaStackTraceDepth=-1
~~~
--------------------------------------------------
~~~
IDE_HOME\bin\idea.properties
idea.max.intellisense.filesize=2500
idea.cycle.buffer.size=1024
~~~
--------------------------------------------------
~~~
Intellij13 (idea.vmoptions) Adolfo Benedetti :

for java 8 you need to control your flags(PermGen to Metaspace),
-XX:MetaspaceSize=XXXm
-XX:MaxMetaspaceSize=XXXm

-ea
-server
-Xms1g
-Xmx1g
-Xss16m
-XX:PermSize=256m
-XX:MaxPermSize=256m
-XX:+DoEscapeAnalysis
-XX:+UseCompressedOops
-XX:+UnlockExperimentalVMOptions
-XX:+UseConcMarkSweepGC
-XX:LargePageSizeInBytes=256m
-XX:ReservedCodeCacheSize=96m
-XX:+UseCodeCacheFlushing
-XX:+UseCompressedOops
-XX:ParallelGCThreads=8
-XX:+UseParNewGC
-XX:+UseConcMarkSweepGC
-XX:+DisableExplicitGC
-XX:+ExplicitGCInvokesConcurrent
-XX:+PrintGCDetails
-XX:+PrintFlagsFinal
-XX:+AggressiveOpts
-XX:+HeapDumpOnOutOfMemoryError
-XX:+CMSClassUnloadingEnabled
-XX:+CMSPermGenSweepingEnabled
-XX:CMSInitiatingOccupancyFraction=60
-XX:+CMSClassUnloadingEnabled
-XX:+CMSParallelRemarkEnabled
-XX:+UseAdaptiveGCBoundary
-XX:+UseSplitVerifier
-XX:CompileThreshold=10000
-XX:+UseCompressedStrings
-XX:+OptimizeStringConcat
-XX:+UseStringCache
-XX:+UseFastAccessorMethods
-XX:+UnlockDiagnosticVMOptions
~~~
-------------------------------------------------------
~~~
-server
-Xss256k
-Xms1536m
-Xmx1536m
-Xmn512m
-XX:PermSize=350m
-XX:MaxPermSize=350m
-XX:MetaspaceSize=350m
-XX:MaxMetaspaceSize=350m
-XX:+UseParNewGC
-XX:SurvivorRatio=8
-XX:+UseConcMarkSweepGC
-XX:+CMSScavengeBeforeRemark
-XX:+CMSPermGenSweepingEnabled
-XX:+UseCMSInitiatingOccupancyOnly
-XX:+UseCMSCompactAtFullCollection
-XX:CMSFullGCsBeforeCompaction=0
-XX:CMSInitiatingOccupancyFraction=70
-XX:ReservedCodeCacheSize=240m
-XX:+HeapDumpOnOutOfMemoryError
~~~


######
#
###   How to disable version control in phpstorm?
####   http://stackoverflow.com/questions/20703913/how-to-disable-version-control-in-phpstorm
####   https://www.dev-metal.com/how-to-ignore-remove-idea-folder-from-git-in-phpstorm/
######
~~~
Go to Settings -> Version Control and remove the folder from which you would like to remove version control tracking (coloring tabs etc.) It will naturally not remove version control from your project (as in deleting the .git/ folder for instance).
Settings | Version Control -- remove all entries from the table

https://calendee.com/2015/08/19/disabling-git-in-webstorm-ide/
Open Preferences -> Version Control -> Git (or your VCS du jour). Then ERASE the PATH TO GIT EXECUTABLE. That's right - just delete it.
~~~


######
#
###   How to disable auto-save in phpstorm
####   https://gist.github.com/d1i1m1o1n/13845f4f8b0564a58d9753cf28e197b2
####   https://www.jetbrains.com/help/phpstorm/2017.1/enabling-and-disabling-plugins.html
######
~~~
How to disable auto-save:
Go to File > Settings (Ctrl+Alt+S).
Go to Appearance & Behavior > System Settings.
Make sure the two are unchecked:
Save files on frame deactivation
Save files automatically if application is idle for x sec.
Go to Editor > General > Editor Tabs
Put a checkmark on "Mark modified files with asterisk"
(Optional but recommended) Under "Tab Closing Policy", select "Close non-modified files first". You may also want to increase the number of allowed tabs.
Click Apply > OK.
That's it.
~~~

######
#
###   Debug with Xdebug on the Commandline with Phpstorm and Git Bash
####  https://hakre.wordpress.com/2013/02/09/debug-with-xdebug-on-the-commandline-with-phpstorm-and-git-bash/
######
~~~
export XDEBUG_CONFIG="idekey=PHPSTORM"
unset XDEBUG_CONFIG

https://confluence.jetbrains.com/display/PhpStorm/Xdebug+Installation+Guide
https://confluence.jetbrains.com/display/PhpStorm/Browser+Debugging+Extensions
https://confluence.jetbrains.com/display/PhpStorm/Zero-configuration+Web+Application+Debugging+with+Xdebug+and+PhpStorm

https://www.jetbrains.com/phpstorm/marklets/
https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc/related
https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/
https://xdebug.org/docs/index.php?action=index

# get xdebug port with phpinfo()
# get xdebug ip machine with ping or phpinfo()

XDEBUG
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_SESSION='+'PHPSTORM'+';path=/;';})()
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_SESSION='+''+';expires=Mon, 05 Jul 2000 00:00:00 GMT;path=/;';})()

PROFILER
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_PROFILE='+'1'+';path=/;';})()
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_PROFILE='+''+';expires=Mon, 05 Jul 2000 00:00:00 GMT;path=/;';})()
~~~
------------------------------------------------------
~~~
Directories used by the IDE to store settings, caches, plugins and logs
https://intellij-support.jetbrains.com/hc/en-us/articles/206544519-Directories-used-by-the-IDE-to-store-settings-caches-plugins-and-logs

Linux and other Unix systems
Product directory starting with dot can be found in your user home directory, the pattern is:

 ~/.<PRODUCT><VERSION>
~/.PhpStorm2017.1/config/colors
~~~

~~~
// -----------------------------------------------
// Navigating by name - Search file name in phpstorm
https://www.jetbrains.com/help/phpstorm/navigating-to-class-file-or-symbol-by-name.html
// -----------------------------------------------
To navigate to a class, file, or symbol with the specified name:

On the main menu, point to Navigate, and then choose Class, File, or Symbol respectively, or use the following shortcuts:
Class: Ctrl+N
File (directory): Ctrl+Shift+N
Symbol: Ctrl+Shift+Alt+N
~~~

######
#
###	Delete Tag Remove html tag
######
~~~
https://www.jetbrains.com/help/idea/delete-tag.html
https://stackoverflow.com/questions/8881716/how-to-remove-surrounding-tags-in-intellij-idea
https://phpstorm.tips/tips/40-unwrapping-and-removing-statements/
https://www.jetbrains.com/help/phpstorm/working-with-source-code.html
https://www.jetbrains.com/help/rider/Adding_Deleting_and_Moving_Lines.html
https://www.jetbrains.com/help/idea/working-with-source-code.html
https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+2019.2+Release+Notes

FIX: Code | Unwrap/Remove... <Ctrl+Shift+Delete> +  press <Enter>

"Code | Unwrap/Remove..."
STRG+SHIFT+DEL > Remove enclosing tag removes #inner to.
Remove Endorsing Tag ...
XML Refactorings" > "Unwrap Tag..."
Refactor | XML Refactorings | Delete Tag

To duplicate a line, press Ctrl+D.
To add a line after the current one, press Shift+Enter. IntelliJ IDEA moves the caret to the next line.
To add a line before the current one, press Ctrl+Alt+Enter. IntelliJ IDEA moves the caret to the previous line.
~~~


######
#
###  Navigate your code with bookmarks
###   https://blog.jetbrains.com/phpstorm/2012/11/navigate-your-code-with-bookmarks/
######
~~~
 F11 (or select Edit | Toggle Bookmark)
 Ctrl+F11 (or select Edit | Toggle Bookmark With Mnemonic) and press/choose a key (0-9 or A-Z).
 Shift+F11 hotkey (Edit | Show Bookmarks):
~~~

######
#
###   How to find weak warnings
###   “weak warnings found” but no highlighted code
######
~~~
Solution:

Pres F2 / invalidate all caches and restart

For the majority of the detected code issues, WebStorm provides quick fix suggestions.
You can quickly review errors in a file by navigating from one highlighted line to another by pressing F2 Shift+F2 .
~~~

References:
- https://www.jetbrains.com/help/phpstorm/code-inspection.html
- https://www.jetbrains.com/help/phpstorm/code-inspection.html#d18912e29
- https://www.jetbrains.com/help/webstorm/code-inspection.html
- https://www.jetbrains.com/help/phpstorm/disabling-and-enabling-inspections.html
- https://www.jetbrains.com/help/idea/code-analysis.html
- https://www.jetbrains.com/help/phpstorm/phpstorm-editor.html
- https://www.jetbrains.com/help/phpstorm/navigating-to-next-previous-error.html
- https://blog.jetbrains.com/webstorm/2014/08/code-quality-analysis-in-webstorm/
- https://www.jetbrains.com/help/phpstorm/inspection-results-tool-window.html
- https://www.jetbrains.com/help/phpstorm/resolving-problems.html
- https://www.jetbrains.com/help/phpstorm/applying-intention-actions.html
- https://intellij-support.jetbrains.com/hc/en-us/community/posts/207000495-How-to-find-weak-warnings-


######
#
###   PhpStorm "Can't start GIT"
######
~~~
"Can't start git, probably the path to the Git executable is not valid. Fix it."
If not using GIT -> go to File | Settings | Version Control and set VCS for your project to <none>.
~~~

######
#
###   Keyboard Shortcuts phpstorm
######

- https://www.jetbrains.com/help/phpstorm/ctrl-shift.html
- https://www.jetbrains.com/help/rider/Keymaps_Comparison_Windows.html
- https://www.jetbrains.com/help/phpstorm/mastering-keyboard-shortcuts.html
- https://kapeli.com/cheat_sheets/PhpStorm.docset/Contents/Resources/Documents/index
- https://shortcutworld.com/PhpStorm/mac/JetBrains-PhpStorm_Shortcuts
- https://github.com/ibus/ibus/issues/2025
- https://www.jetbrains.com/help/webstorm/using-code-editor.html
- https://www.jetbrains.com/help/phpstorm/using-code-editor.html
- https://www.jetbrains.com/help/rider/Reference_Keymap_Rider.html

######
#
###   How to collapse/expand all comment blocks in a file in PhpStorm?
###   https://stackoverflow.com/questions/28354775/how-to-collapse-expand-all-comment-blocks-in-a-file-in-phpstorm
######
~~~
Code | Folding | Collapse/Expand doc comments
CTRL+SHIFT+NUMPAD+
CTRL+SHIFT+NUMPAD-
~~~


######
#
###   The server time zone value is unrecognized
###   https://intellij-support.jetbrains.com/hc/en-us/community/posts/360003472660-The-server-time-zone-value-is-unrecognized
######
~~~
Check declaration" (Ctrl+B) if works
DB Settings tab -> Advanced -> serverTIMEZONE = UTC
~~~

######
#
###   SQL Dialect is Not Configured (Phpstorm) - Stack Overflow
###   Add Database autocomplete includes database name
######
~~~
https://stackoverflow.com/questions/30411778/sql-dialect-is-not-configured-phpstorm
https://www.jetbrains.com/help/phpstorm/settings-languages-sql-dialects.html
https://stackoverflow.com/questions/39723802/phpstorm-sql-code-autocomplete
https://intellij-support.jetbrains.com/hc/en-us/community/posts/115000315104-Database-autocomplete-includes-database-name

File > Settings > Languages & Frameworks > SQL Dialects
PhpStorm > Languages & Frameworks > SQL Dialects
~~~

######
#
###   Code completion
###   ML autocomplete + Code Completion
####   https://www.jetbrains.com/help/pycharm/auto-completing-code.html
######
~~~
Invoke smart completion - Ctrl+Shift+Space
Invoke basic completion - Ctrl+Space
Hippie completion - Alt+/  or Shift+Alt+/
Postfix code completion - Ctrl+Alt+S  / Select Tab, Space, or Enter to expand postfix templates.

https://blog.jetbrains.com/phpstorm/2016/07/parameter-code-completion-in-phpstorm-2016-2/
https://blog.jetbrains.com/phpstorm/tag/phpstorm/
https://www.jetbrains.com/help/webstorm/viewing-method-parameter-information.html
https://www.jetbrains.com/help/phpstorm/viewing-reference-information.html
https://www.jetbrains.com/help/phpstorm/introduce-parameter.html
https://www.jetbrains.com/help/phpstorm/php-parameter-type.html
https://www.jetbrains.com/help/idea/extract-into-class-refactorings.html
https://www.jetbrains.com/help/idea/template-variables.html
https://gitlab.com/yivi/php-storm-bug
https://www.jetbrains.com/help/idea/auto-completing-code.html
https://blog.jetbrains.com/idea/2016/09/share-your-stats-to-improve-code-completion-via-machine-learning/
https://github.com/JetBrains/intellij-stats-collector
https://www.jetbrains.com/help/idea/auto-completing-code.html

https://plugins.jetbrains.com/plugin/7276-php-advanced-autocomplete
https://plugins.jetbrains.com/plugin/9203-ai-predictive-coding
https://plugins.jetbrains.com/plugin/8117-completion-stats-collector

CodeGlance - preview code in right panel
https://plugins.jetbrains.com/plugin/7275-codeglance

https://plugins.jetbrains.com/plugin/10044-atom-material-icons
https://plugins.jetbrains.com/plugin/8006-material-theme-ui
~~~

