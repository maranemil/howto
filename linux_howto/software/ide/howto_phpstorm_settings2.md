
~~~
############################################################################
#
#   Jetbrains PHPStorm 5.0.4 tells me I have a Duplicated jQuery Selector
#   jQuery Duplicate Selector error - Duplicated jQuery Selector
#
############################################################################

https://learn.jquery.com/using-jquery-core/selecting-elements/#saving-selections
var divs = $( "div" );
~~~
#
~~~
############################################################################
#
#   IntelliJ PHPStorm Key Shortcuts
#   https://www.toptal.com/php/how-to-be-efficient-in-phpstorm
#
############################################################################

Ctrl+ E - toggle between recently used files
Ctrl + / - comment/uncomment a block of code
Ctrl + B - go to the class declaration
Ctrl + N - navigate to class
Ctrl + R - search and replace
Ctrl +Alt + L - reformat code
Alt + Enter - show intention actions and quick-fixes
Ctrl + Shift + Enter - complete statement
~~~
#
~~~
############################################################################
#
#   IntelliJ PHPStorm "variable might not have been initialized"
#   https://youtrack.jetbrains.com/issue/WEB-19667
#
############################################################################

FIX: Intentions - split declaration and initialization

let arrContent = [] // array
arrContent = {$smatyvar}
$.each(arrContent, function (key, value) {
console.log(value)
});
~~~
#
~~~
############################################################################
#
#   Open project in new window loses focus
#   Don't steal focus – IDEs Support (IntelliJ Platform) | JetBrains
#   IntelliJ stealing focus /
#
############################################################################

https://intellij-support.jetbrains.com/hc/en-us/community/posts/206950825-IntelliJ-stealing-focus
https://intellij-support.jetbrains.com/hc/en-us/community/posts/206874755-Don-t-steal-focus?page=3
https://intellij-support.jetbrains.com/hc/en-us/community/posts/360000623330-Editor-pane-loses-focus-e-g-quick-documentation-
https://intellij-support.jetbrains.com/hc/en-us/community/posts/360000414079-Fake-focus-on-active-window
https://stackoverflow.com/questions/53957831/intellij-in-blocked-mode-when-window-comes-into-focus
https://www.jetbrains.com/help/idea/tuning-the-ide.html

(V1)
/home/user/.PhpStorm2019.2/config/idea.properties
suppress.focus.stealing=false
idea.popup.weight=medium

(V2)
or  Help > Edit Custom VM Options... and Restart the IDE.
-Dsuppress.focus.stealing=false

...

Help -> Edit Custom Properties
Add: suppress.focus.stealing=false.

Help -> Edit Custom VM Options...
Add:  -Dsuppress.focus.stealing=false
~~~
#
~~~
############################################################################
#
#   How to Disable Spell Checking for All My Projects PHPStorm
#
############################################################################

https://stackoverflow.com/questions/14983942/how-to-disable-spell-checking-for-all-my-projects
https://www.jetbrains.com/help/pycharm/spellchecking.html
https://intellij-support.jetbrains.com/hc/en-us/community/posts/115000651584-totally-disable-spellcheck

You need to disable whole group at
Settings/Preferences | Editor | Inspections | Spelling.

You can configure it to be disabled by default for any future new projects:
File | Default Settings | Editor | Inspections | Spelling

You can totally disable spellchecker by configuring Typo inspection in
IDE settings (Preferences/Settings | Editor | Inspections)

If you don't need it at all just disable Typo Inspection
If you would like to define the type of contents to be spellchecked just select or clear the Process Code, Process Literals, and Process Comments check boxes.
~~~
#
~~~
################################################################
#
#   PHPStorm Tabs settings
#
################################################################

https://www.jetbrains.com/help/phpstorm/guided-tour-around-the-user-interface.html#status-bar
https://www.jetbrains.com/help/phpstorm/uploading-and-downloading-files.html
https://www.jetbrains.com/help/phpstorm/sharing-your-ide-settings.html
https://www.jetbrains.com/help/phpstorm/configuring-content-roots.html#exclude_by_name_patterns
https://www.jetbrains.com/help/phpstorm/configuring-folders-within-a-content-root.html#mark
https://www.jetbrains.com/help/phpstorm/using-file-watchers.html#ws_file_watchers_bedore_you_start
https://www.jetbrains.com/help/phpstorm/content-root.html#root_types
https://developers.shopware.com/developers-guide/phpstorm/
https://www.jetbrains.com/help/phpstorm/sharing-your-ide-settings.html#IDE_settings_sync


Editor > Editor Tabs >
- uncheck "Hide Tabs if there is no space"
- Tab limit 30
- Tab placement Left
~~~
#
~~~
################################################################
#
#   PHPStorm PHP Runtime
#
################################################################

https://plugins.jetbrains.com/plugin/12820-redis
https://github.com/JetBrains/phpstorm-stubs
https://github.com/JetBrains/phpstorm-stubs/blob/master/redis/Redis.php
https://blog.jetbrains.com/phpstorm/2017/03/per-project-php-extension-settings-in-phpstorm-2017-1/

Settings | Languages & Frameworks | PHP | PHP Runtime | Advanced settings | Default stubs path
~~~
#
~~~
################################################################
#
#   PHPStorm Marketplace Plugins are not loaded
#
################################################################

http://plugins.jetbrains.com
idea.plugins.host=https://plugins.jetbrains.com
-Djsse.enableSNIExtension=true

https://www.jetbrains.com/help/idea/settings-http-proxy.html
https://intellij-support.jetbrains.com/hc/en-us/articles/206544869
https://plugins.jetbrains.com/

#com.intellij.util.io.HttpRequests
#com.intellij.util.proxy.CommonProxy
~~~
#
~~~
################################################################
#
#	PHPStorm Restore IDE settings
#
################################################################

https://www.jetbrains.com/help/phpstorm/configuring-project-and-ide-settings.html#restore-defaults

File | Manage IDE Settings | Restore Default Settings.
~~~
#
~~~
################################################################
#
#	Deploy  - phpstorm synchronizing files doesn't stop
#
################################################################

backup your project's /.idea folder & remove it
Settings | Plugins > Installed - Disabled#
check Help | Show Log in Explorer - idea.log
check Help | Collect Logs and Diagnostic Data

https://www.jetbrains.com/help/phpstorm/deploying-applications.html
https://www.jetbrains.com/help/phpstorm/deployment-in-PhpStorm.html#uploading
https://www.youtube.com/watch?v=UD2qrDs3_VQ

Settings > Build Execution > Deployment >  Add new remote path
~~~

#
~~~
################################################################
#
#	PHP built in functions/classes etc. are not recognized
#
################################################################

FIX:
rm -rf  ~/.cache/JetBrains/PhpStorm2020.2/caches/

https://youtrack.jetbrains.com/issue/WI-54626
https://stackoverflow.com/questions/64070619/phpstorm-2020-2-php-built-in-functions-are-not-recognized
https://stackoverflow.com/questions/12542506/my-phpstorm-5-does-not-know-php-native-functions

Basic solutions suggested:

Invalidate caches (https://www.jetbrains.com/help/phpstorm/invalidate-caches.html);
Remove cache directory manually (https://www.jetbrains.com/help/idea/tuning-the-ide.html?#system-directory);
IDE re-installation;
Disable custom plugins;
Clone & set up a custom stubs directory;

disable plugin "PHP Document 1.1" https://github.com/fw6669998/php-doc
rm -Rf ~/.cache/JetBrains/PhpStorm2020.2/caches
rm -rf ~/Library/Caches/JetBrains/PhpStorm2020.2/
rm -r ~/Library/Caches/JetBrains/IntelliJIdea2020.2/caches
rm -rf ~/.cache/JetBrains/PhpStorm2020.3/caches/

----------
Current workaround:
----------
Close IDE
Locate folder where PhpStorm 2020.2 stores indexes/caches on your computer (see below)
Delete that folder (as standard "Invalidate caches" does not help here)
Launch IDE
Typical locations for caches folder for different OS:

Windows: %USERPROFILE%\AppData\Local\JetBrains\PhpStorm2020.2\caches
Linux: ~/.cache/JetBrains/PhpStorm2020.2/caches
macOS: ~/Library/Caches/JetBrains/PhpStorm2020.2/caches
~~~
#
~~~
############################################################################
#
#   Code Inspection: Unused CSS selector
#
############################################################################


https://www.jetbrains.com/help/phpstorm/css-unused-css-selector.html

Configure inspections: Settings / Preferences | Editor | Inspections
~~~
#
~~~
############################################################################
#
#   PyCharm
#
############################################################################

Disable inspections
https://www.jetbrains.com/help/pycharm/spellchecking.html
-------------------

Ctrl+Alt+S

#remove these
no datasource
typo in word
~~~
#
~~~
############################################################################
#
#   [ PhpStorm Multiselection - Select All Occurrences  ]
#   https://www.jetbrains.com/help/rider/Selecting_Text_in_the_Editor.html#multiselection
#   https://blog.jetbrains.com/phpstorm/2014/03/working-with-multiple-selection-in-phpstorm-8-eap/
#   https://www.jetbrains.com/help/phpstorm/quick-start-guide-phpstorm.html
#
############################################################################

Ctrl+Shift+Alt+J - select all lines for multi edit
Ctrl+Shift+J - merge all lines into single one
Alt+click - select random lines for edit
~~~
#
~~~
############################################################################
#
#   PhpStorm text size
#   https://stackoverflow.com/questions/12546631/phpstorm-text-size
#
############################################################################

CTRL+Mouse Wheel
ENABLE: Settings -> Editor -> Change font size (Zoom) with Ctrl+Mouse Wheel
~~~
#
~~~
############################################################################
#
#   custom PyCharm VM options 2018 Nov
#
############################################################################

-Xms128m
-Xmx350m
-XX:MaxPermSize=1024m
-XX:ReservedCodeCacheSize=240m
-XX:+UseConcMarkSweepGC
-XX:SoftRefLRUPolicyMSPerMB=25
-XX:ParallelGCThreads=2
-XX:+DoEscapeAnalysis
-XX:+UseCodeCacheFlushing
-XX:MaxTenuringThreshold=2
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-Djdk.http.auth.tunneling.disabledSchemes=""
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-Dawt.useSystemAAFontSettings=lcd
-Dsun.java2d.renderer=sun.java2d.marlin.MarlinRenderingEngine
-Dcaches.indexerThreadsCount=2

# custom PyCharm VM options ORG

-Xms128m
-Xmx750m
-XX:ReservedCodeCacheSize=240m
-XX:+UseConcMarkSweepGC
-XX:SoftRefLRUPolicyMSPerMB=50
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-Djdk.http.auth.tunneling.disabledSchemes=""
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-Dawt.useSystemAAFontSettings=lcd
-Dsun.java2d.renderer=sun.java2d.marlin.MarlinRenderingEngine
~~~
#
~~~
############################################################################
#
#   Config PHP Storm to use 2 Threads -
#   /home/user/.PhpStorm2018.1/config/phpstorm64.vmoptions
#
############################################################################

-Xms1024m
-Xmx2048m
-Xss32m
-XX:ReservedCodeCacheSize=1024M
-XX:SoftRefLRUPolicyMSPerMB=64
-XX:ParallelGCThreads=2
-XX:MaxPermSize=1024m
-XX:+DoEscapeAnalysis
-XX:+UseCodeCacheFlushing
-XX:MaxTenuringThreshold=2
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-Dawt.useSystemAAFontSettings=lcd
-Dcaches.indexerThreadsCount=2
-Dsun.java2d.renderer=sun.java2d.marlin.MarlinRenderingEngine
-Didea.is.internal=true
-Dsun.awt.disablegrab=true
-Didea.classpath.index.enabled=false
~~~
#
~~~
############################################################################
#
#   custom PyCharm VM options
#
############################################################################

# custom PyCharm VM options

-Xms128m
-Xmx750m
-XX:ReservedCodeCacheSize=240m
-XX:+UseConcMarkSweepGC
-XX:SoftRefLRUPolicyMSPerMB=50
-XX:ParallelGCThreads=2
-XX:MaxPermSize=1024m
-XX:+DoEscapeAnalysis
-XX:+UseCodeCacheFlushing
-XX:MaxTenuringThreshold=2
-ea
-Dsun.io.useCanonCaches=false
-Djava.net.preferIPv4Stack=true
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-Dawt.useSystemAAFontSettings=lcd
-Dsun.java2d.renderer=sun.java2d.marlin.MarlinRenderingEngine
-Dcaches.indexerThreadsCount=2
~~~
#
~~~
############################################################################
#
#   install php cli in phpStorm
#
############################################################################

sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql php7.0-intl -y
sudo apt-get install php7.0-cgi -y
Set Lang & Frameworks - set php7 && /include path "/usr/share/php"

http://localhost:63342/
~~~
#
~~~
############################################################################
#
#   Linux PHPStorm Themes
#
############################################################################

On Linux, the color files are located in: ~/.WebIde70/config/colors/ After you put your .xml files,
and restart your IDE.
Then navigate to File > Settings > Editor > Colors & Fonts and select the color scheme you just added.

http://www.phpstorm-themes.com/

https://plugins.jetbrains.com/plugin/10936-night-owl-theme
https://plugins.jetbrains.com/plugin/12692-darcula-darker-theme
https://plugins.jetbrains.com/plugin/11938-one-dark-theme
https://plugins.jetbrains.com/plugin/12262-night-owl-theme
~~~

~~~
############################################################################
#
#   Change PHP Inspect Profile
#
############################################################################

Preferences > Languages and Frameworks > PHP
set desired PHP Language Level under Development environment
Run inspection by name…
choose Language Level

https://blog.jetbrains.com/phpstorm/2016/07/php-7-support-in-phpstorm-2016-2/
https://intellij-support.jetbrains.com/hc/en-us/community/posts/206003624-Ancient-code-passes-PHP7-Compatibility-inspection-ha-
https://blog.jetbrains.com/phpstorm/2015/11/get-your-code-php-7-ready-with-phpstorm-10/
https://blog.wturrell.co.uk/phpstorm-php-7-compatibility-inspection-missing/
https://auth0.com/blog/migrating-a-php5-app-to-7-part-three/
~~~
#
~~~
############################################################################
#
#	Mark Directory AS Excluded ( disable search in some dolders in PHPStorm)
#	https://stackoverflow.com/questions/16559203/exclude-folder-from-search-but-not-from-the-project-list
#
############################################################################

Select Directory > Mark Directory AS Excluded
~~~
#
~~~
############################################################################
#
#	PHPSTORM : external file changes sync may be slow
#	Project files cannot be watched (are they under network mount?)"
#
############################################################################

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

~~~
ll /proc/sys/fs/inotify/
max_queued_events
max_user_instances
max_user_watches
~~~
~~~

caffeinate &
umount -f /Volumes/$MOUNTDIR/
umount -f /Users/$HOMEUSER/$MOUNTDIR
mkdir /Users/$HOMEUSER/$MOUNTDIR
sshfs $HOMEUSER@@SERVERADDR:/usr/$HOMEUSER/$MOUNTDIR /Users/$HOMEUSER/$MOUNTDIR
~~~

#
~~~
############################################################################
#
#   ssh connect
#
############################################################################

sudo gvfs-mount smb://user@servername/
sudo gvfs-mount smb://servername/user/
sudo sshfs -o nonempty,default_permissions,uid=1000,gid=1000,sshfs_debug,IdentityFile=~/.ssh/id_rsa username@192.168.178.22:/username /media
ssh -xA user@servername

gvfs-mount smb://name.srv/user.name/ # mount
gvfs-mount -u smb://name.srv/user.name/ # unmount
~~~
#
~~~
############################################################################
#
#   limit cpu PhpStorm
#
############################################################################

cpulimit -e "/opt/PhpStorm-163.10504.2/jre64/bin/java" -l 50
cpulimit -P "/opt/PhpStorm-163.10504.2/jre64/bin/java" -l 50
cpulimit -P "/opt/PhpStorm-163.10504.2/jre64/bin/java" -l 50 -c 4 # Allow to use only 4 CPU at 50%
cpulimit -P "/opt/PhpStorm-163.10504.2/jre64/bin/java" -l 95 -c 6 # Allow to use only 4 CPU at 95%

cpulimit -e /opt/pycharm-community-2017.2.2/jre64/bin/java -l 55 -c 2

cpulimit -P "/opt/PhpStorm-163.10504.2/jre64/bin/java" -l 150 -c 6
cpulimit -P "/usr/lib/gvfs/gvfsd-fuse" -l 150 -c 6

increase XMX to 3048 #
sudo sysctl vm.swappiness=20
~~~
