
~~~
############################################################################
#
#   PhpStorm2020.03 intall
#
############################################################################

sudo snap install phpstorm --classic

https://www.jetbrains.com/de-de/pycharm/download/#section=linux
https://www.jetbrains.com/de-de/idea/download/#section=linux
~~~
#
~~~
############################################################################
#
#   remote server configuration 2022
#
############################################################################

https://www.jetbrains.com/help/idea/2021.3/remote-development-a.html#launch_gateway
https://www.jetbrains.com/help/phpstorm/create-new-project-specify-remote-server.html
https://www.jetbrains.com/help/phpstorm/creating-a-remote-server-configuration.html#enable
https://www.jetbrains.com/help/phpstorm/remote-development-a.html#remote_prerequisites
~~~
#
~~~
############################################################################
#
#   Align consecutive assignments
#
############################################################################
https://stackoverflow.com/questions/17281308/how-to-align-text-to-specific-character-in-phpstorm-or-webstorm

Settings -> Editor -> Code Style -> PHP -> Wrapping and Braces -> Assignment statement -> Align consecutive assignments
Settings -> Editor -> Code Style -> PHP -> Wrapping and Braces -> Array initializer -> Align key-value pairs
~~~
#
~~~
############################################################################
#
#   PhpStorm2020 bs/fsinotify fix after update upgrade
#
############################################################################

Native file system watcher for Linux - Inotify Watches Limit
https://blog.jetbrains.com/idea/2010/04/native-file-system-watcher-for-linux/
https://confluence.jetbrains.com/display/IDEADEV/Inotify+Watches+Limit
------------------------------------------------

cat /proc/sys/fs/inotify/max_user_watches

It can be raised by adding following line to the /etc/sysctl.conf file:

fs.inotify.max_user_watches = 524288

… and issuing this command to apply the change:

sudo sysctl -p
sudo sysctl -p --system
sudo sysctl --system

systemctl restart systemd-sysctl.service
sysctl -p /etc/sysctl.d/99-sysctl.conf
~~~
#
~~~
############################################################################
#
Adding, Deleting and Moving Code Elements
#
############################################################################

https://www.jetbrains.com/pycharm/guide/tips/move-block/
https://www.jetbrains.com/help/rider/Adding_Deleting_and_Moving_Lines.html#delete
https://www.jetbrains.com/help/mps/adding-deleting-and-moving-lines.html

Shift-Ctrl-Up/Down



Ctrl Shift A - search
alt 1 - root
alt 2 - favs
alt 3 - find
alt 4 - run
alt 5 - debug
alt 6 - problems
alt 7 - structre
~~~
#
~~~
############################################################################
#
#   Multiple Cursors and Selections + inline from multiple lines
#
############################################################################

Multiple Cursors and Selections
https://www.youtube.com/watch?v=5ZKc7zHjRMU
https://www.jetbrains.com/help/phpstorm/refactoring-source-code.html#refactoring_preview
https://www.jetbrains.com/help/phpstorm/refactoring-source-code.html#refactoring_settings

Alt+cursor - select var
Alt+J - select next occurence
Ctrl+V - select all occurence



Ctrl+Alt+N - make inline from multiple lines
https://www.jetbrains.com/help/phpstorm/inline.html#ps_inline_constant

Ctrl+R I  - Inline Variable refactoring
https://www.jetbrains.com/help/resharper/Refactorings__Inline_Variable.html
https://www.jetbrains.com/help/phpstorm/inline.html#wi_inline_method
https://www.jetbrains.com/help/rider/Refactorings__Inline_Variable.html
~~~
#
~~~
############################################################################
#
#   debugging tools
#
############################################################################

https://www.jetbrains.com/help/phpstorm/debugging-with-phpstorm-ultimate-guide.html#debugging-a-php-cli-script

To test direct connection, run the telnet host 9000 (for Xdebug) or the telnet host 10137 (for Zend Debugger) command on the remote server and ensure that connection is established. Here, host is the IP address of the local machine PhpStorm is running on.

To check for opened inbound ports, you can use canyouseeme.org or a similar service.

https://www.jetbrains.com/help/phpstorm/configuring-remote-interpreters.html
https://www.jetbrains.com/help/phpstorm/debugging-a-php-cli-script.html
https://www.jetbrains.com/help/phpstorm/debugging-a-php-cli-script.html
https://www.jetbrains.com/help/phpstorm/symfony-support.html#debugging-symfony-commands
https://www.jetbrains.com/help/phpstorm/php-debugging-session.html
https://www.jetbrains.com/help/phpstorm/simultaneous-debugging-sessions.html
https://www.jetbrains.com/help/phpstorm/multiuser-debugging-via-xdebug-proxies.html
https://www.jetbrains.com/help/phpstorm/laravel.html#debugging-artisan-commands
https://www.jetbrains.com/help/phpstorm/code-inspections-in-javascript-and-typescript.html
https://www.jetbrains.com/help/phpstorm/javascript-specific-guidelines.html#ws_js_choose_language_version
~~~
#
~~~
############################################################################
#
#   PhpStorm2019 PhpStorm2020 vmoptions Reset
#
############################################################################
https://intellij-support.jetbrains.com/hc/en-us/articles/206544869-Configuring-JVM-options-and-platform-properties

Paths:
/home/demo/.PhpStorm2019.3/config/phpstorm64.vmoptions
/home/demo/.config/JetBrains/PhpStorm2020.1/phpstorm64.vmoptions
/opt/PhpStorm-193.6494.47/bin/phpstorm64.vmoptions

# custom PhpStorm VM options
-server
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
-XX:MaxJavaStackTraceDepth=10000

Paths:
# /.PyCharmCE2019.3/config/idea.properties
# /home/demo/.PyCharmCE2019.3/config/idea.properties

# custom PhpStorm properties
idea.max.intellisense.filesize=2500
idea.cycle.buffer.size=1024


#---------------------------------------------------------------------
# Maximum file size (kilobytes) IDE should provide code assistance for.
# The larger file is the slower its editor works and higher overall system memory requirements are
# if code assistance is enabled. Remove this property or set to very large number if you need
# code assistance for any files available regardless their size.
#---------------------------------------------------------------------
idea.max.intellisense.filesize=999999

# Maximum file size (kilobytes) IDE should provide code assistance for.
idea.max.intellisense.filesize=60000

# Maximum file size (kilobytes) IDE is able to open.
idea.max.content.load.filesize=60000

#-----------------------------------------------------------------------
# This option controls console cyclic buffer: keeps the console output size not higher than the specified buffer size (Kb). Older lines are deleted.
# In order to disable cycle buffer use idea.cycle.buffer.size=disabled
idea.cycle.buffer.size=1024


# https://www.jetbrains.com/help/objc/configuring-file-size-limit.html
# https://intellij-support.jetbrains.com/hc/en-us/community/posts/115000610770-File-size

idea.max.intellisense.filesize=2500 # Maximum file size (kilobytes) for code assistance
idea.max.content.load.filesize=20000 # Maximum file size (kilobytes) IDE to open
~~~

-----------------------------------------------------------------------
~~~
-XX:+UseConcMarkSweepGC
-XX:CMSInitiatingOccupancyFraction=75
-XX:+UseCMSInitiatingOccupancyOnly
~~~
-----------------------------------------------------------------------
~~~


# custom PhpStorm VM options old settings
-Xms256m
-Xmx2222m
#-Xss32m
-XX:MaxPermSize=512m
-XX:InitialCodeCacheSize=32m
-XX:ReservedCodeCacheSize=248m
-XX:SoftRefLRUPolicyMSPerMB=36000
-XX:ParallelGCThreads=4
-XX:ConcGCThreads=4
-XX:+DoEscapeAnalysis
-XX:+UseCodeCacheFlushing
-XX:MaxTenuringThreshold=4
-XX:+UseCompressedOops
-ea
-XX:CICompilerCount=4
-Dsun.io.useCanonPrefixCache=false
-Djava.net.preferIPv4Stack=true
-Djdk.http.auth.tunneling.disabledSchemes=""
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-Djdk.attach.allowAttachSelf=true
-Dkotlinx.coroutines.debug=off
-Djdk.module.illegalAccess.silent=true
-Dawt.useSystemAAFontSettings=lcd
-Dsun.java2d.renderer=sun.java2d.marlin.MarlinRenderingEngine
-Dsun.tools.attach.tmp.only=true
-Dcaches.indexerThreadsCount=4
~~~
#

~~~
################################################################
#
#   PhpStorm 2020.1 - show File Size and File Date
#
################################################################

https://www.jetbrains.com/help/phpstorm/project-tool-window.html
https://intellij-support.jetbrains.com/hc/en-us/community/posts/360005144179-How-to-suppress-file-date-size-in-the-Project-Tool-Window

View | Appearance | Details in Tree Views
~~~
#

~~~
################################################################
#
# 	PHPStorm Edit Multi Lines - multiple lines
#
################################################################

https://www.jetbrains.com/help/phpstorm/quick-start-guide-phpstorm.html
https://www.jetbrains.com/help/phpstorm/mastering-keyboard-shortcuts.html
https://resources.jetbrains.com/storage/products/phpstorm/docs/PhpStorm_ReferenceCard.pdf
https://resources.jetbrains.com/storage/products/intellij-idea/docs/IntelliJIDEA_ReferenceCard.pdf
https://blog.jetbrains.com/phpstorm/2014/03/working-with-multiple-selection-in-phpstorm-8-eap/
https://www.jetbrains.com/help/rider/Multicursor.html
https://www.jetbrains.com/help/webstorm/2016.1/multicursor.html
https://www.youtube.com/watch?v=5ZKc7zHjRMU

Ctrl Shift + Arrow Up / Down 	- Move code up or down
Shift + Arrow Up / Down 		- Select code
Alt + Schift + Insert 			- Edit multiline
~~~
#
~~~
######################################################################
#
#   Increase auto-save delay IDEs Support (IntelliJ Platform) | JetBrains
#   https://gist.github.com/d1i1m1o1n/13845f4f8b0564a58d9753cf28e197b2
#   https://www.jetbrains.com/help/phpstorm/working-with-source-code.html
#
######################################################################

Ctrl+Alt+S -> Appearance&Behavior | System Settings:

Save files on frame deactivation
Save files automatically if application is idle for x sec.

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
~~~
#
~~~
############################################################################
#
#   DEFAULT WINDOWS & LINUX KEYMAP - PhpStorm IntelliJIDEA
#
############################################################################

https://resources.jetbrains.com/storage/products/phpstorm/docs/PhpStorm_ReferenceCard.pdf
https://resources.jetbrains.com/storage/products/intellij-idea/docs/IntelliJIDEA_ReferenceCard.pdf

https://www.jetbrains.com/help/phpstorm/ctrl-alt.html
https://www.jetbrains.com/help/idea/mastering-keyboard-shortcuts.html
https://dontcamerame.com/ubuntu-18-04-shortcuts-with-intellij/

# problems

Unable to use IntelliJ IDEA keyboard shortcuts on Ubuntu
https://askubuntu.com/questions/412046/unable-to-use-intellij-idea-keyboard-shortcuts-on-ubuntu
https://askubuntu.com/questions/452386/how-to-change-keyboard-shortcuts
https://askubuntu.com/questions/17626/how-can-i-restore-default-keyboard-shortcuts/315226#315226
https://superuser.com/questions/1133302/altf7-stopped-working
https://stackoverflow.com/questions/47808160/intellij-idea-ctrlaltleft-shortcut-doesnt-work-in-ubuntu

# fix

print/list key config settings
gsettings list-recursively org.gnome.desktop.wm.keybindings

# change settings

$ gsettings get org.gnome.desktop.wm.keybindings switch-to-workspace-right
$ gsettings set org.gnome.desktop.wm.keybindings switch-to-workspace-right "['']"
$ gsettings get org.gnome.desktop.wm.keybindings switch-to-workspace-right
~~~
#
~~~
############################################################################
#
#	PhpStorm 2017.2 Help/Navigating to Class, File or Symbol by Name
#	Keymap: Windows/Linux Default
#	https://www.jetbrains.com/help/phpstorm/navigating-to-class-file-or-symbol-by-name.html
#
############################################################################

Navigating by name

To navigate to a class, file, or symbol with the specified name:

On the main menu, point to Navigate, and then choose Class, File, or Symbol respectively, or use the following shortcuts:
Class: Ctrl+N
File (directory): Ctrl+Shift+N
Symbol: Ctrl+Shift+Alt+N
~~~
#
~~~
############################################################################
#
#	How to disable “make private” message in IntelliJ PHPStorm?
#	How to disable “make protected” message in IntelliJ PHPStorm?
#
############################################################################

https://www.jetbrains.com/help/rider/Settings_Inspection_Settings.html
https://github.com/JetBrains/inspection-plugin
https://blog.jetbrains.com/phpstorm/2017/08/php-7-1-class-constant-visibility/
https://github.com/funivan/PhpClean
https://dev.to/mokkapps/why-i-switched-from-visual-studio-code-to-jetbrains-webstorm-939

Move the cursor to public , press Alt + Enter and choose one of the options: disable intentions
@SuppressWarnings("WeakerAccess")
~~~
#
~~~
############################################################################
#
#   PhpStorm unable to resolve column for multiple database connections
#   How to disable "unable to resolve column '[column]'" warning when double quoted string in SQL statement?
#   https://intellij-support.jetbrains.com/hc/en-us/community/posts/206345689-How-to-disable-unable-to-resolve-column-column-warning-when-double-quoted-string-in-SQL-statement-
#   https://stackoverflow.com/questions/36788799/phpstorm-unable-to-resolve-column-for-multiple-database-connections
#
############################################################################

Alt+Enter while caret is standing on error position
Choose correct entry from appeared menu
Arrow right to see submenu
Choose the most appropriate action from there (e.g. Disable Inspection)

As I understand you have MySQL there.

The double quoted text is indeed treated as column name.
At the moment there is no settings in IDE to treat them as ordinary strings.

Or set the SQL resolution scope in File -> Settings -> Languages & Frameworks -> SQL Resolution Scopes.
/** @noinspection SqlResolve */
~~~
#
~~~
############################################################################
#
#   WebStorm PhpStorm - unresolved function or method
#
############################################################################

Press CTRL+ALT+S
Search for JavaScript & click the select field. and then select ECMAScript 6
Editor > Inspections > JavaScript > General > Unresolved Javascript function > disable
Editor > Inspections > JavaScript > General > Unresolved Javascript variable > disable
Settings | Languages & Frameworks | JavaScript | Libraries, press Download...,???
~~~
#
~~~
############################################################################
#
#   "SQL dialect is not configured" Inspection - SQL Dialect is Not Configured (Phpstorm)
#
############################################################################
https://www.liviubalan.com/phpstorm-setup-database-connection-sql-dialect
https://www.pontikis.net/blog/setup-phpstorm-on-ubuntu
https://plugins.jetbrains.com/plugin/7796-perl

File > Settings > Languages & Frameworks > SQL Dialects
~~~
~~~
############################################################################
How to jump to matching braces?
https://intellij-support.jetbrains.com/hc/en-us/community/posts/207071115-How-to-jump-to-matching-braces-
############################################################################

CTRL + SHIFT + M
~~~