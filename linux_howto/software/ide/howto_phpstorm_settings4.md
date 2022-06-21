
~~~
##################################################################################################
#
#	Auto-Completing Code and Paths - Ctrl+Alt+J
#
#	Surround a block of code with a live template﻿ / Select a piece of code to be surrounded.
#	https://www.jetbrains.com/help/phpstorm/generate-custom-code-constructs-using-live-templates.html
#	https://www.jetbrains.com/help/phpstorm/using-zen-coding-support.html
#
##################################################################################################

On the Code menu, click Surround With Live Template
Ctrl+Alt+J to open the suggestion list and select the necessary template.

Emmet Support table>tr*3>td*2
In the Settings/Preferences dialog Ctrl+Alt+S, go to Editor | Emmet.
https://www.jetbrains.com/help/phpstorm/using-zen-coding-support.html

Just type your code and press CTRL+ALT+]
Here’s an example: this abbreviation

#page>div.logo+ul#navigation>li*5>a{Item $}  ...can be transformed into
~~~
-------------------------------------------------------------------------

- https://www.jetbrains.com/help/phpstorm/ctrl-alt.html
- https://www.jetbrains.com/help/phpstorm/2017.1/smart-keys.html
- https://www.jetbrains.com/help/phpstorm/auto-completing-code.html
- https://www.jetbrains.com/help/phpstorm/using-live-templates.html
- https://www.jetbrains.com/help/webstorm/auto-completing-code.html
- https://www.jetbrains.com/help/webstorm/settings-code-completion.html
- https://www.jetbrains.com/help/webstorm/settings-code-completion.html#ws_js_settings
- https://www.jetbrains.com/help/phpstorm/using-live-templates.html

~~~
Ctrl+Alt+J / Ctrl+J	- Surround with Live Template / Surround the selection with one of the Live Templates.
Ctrl+Alt+Space / Ctrl+Space - suggestion completion
Ctrl+H / Ctrl+Alt+H / Ctrl+Shift+H - View code hierarchy
Ctrl+Alt+S - open the Settings/Preferences  -  Editor | General | Code Completion

PHP Storm -> File -> Setting -> Editor -> Smart Keys -> XML/HTML
PHP Storm -> File > Settings > Editor > Emmet > HTML

Abbreviation	Expands to ...
rqr				require "";
pubsf			public static function () {}
fore			foreach ( as $item) {}
eco				echo "";

https://www.jetbrains.com/help/idea/code-inspection.html
Ctrl+Shift+Alt+H
Ctrl+Shift+I
~~~

######
#
###	PyCharm community edition / IntelliJ IDEA community edition / Plugins
######
~~~
PHP Syntax Color Highlighter
https://plugins.jetbrains.com/plugin/13592-php-syntax-color-highlighter

Python Community Edition
https://plugins.jetbrains.com/plugin/7322-python-community-edition

CakePHP Syntax Color Highlighter
https://plugins.jetbrains.com/plugin/13593-cakephp-syntax-color-highlighter

Perl
https://plugins.jetbrains.com/plugin/7796-perl
~~~

- https://www.jetbrains.com/help/idea/tutorial-using-textmate-bundles.html
- https://www.jetbrains.com/help/idea/syntax-highlighting.html
- https://blog.softhints.com/intellij-community-edition-add-css-jsp-syntax-highlighting/
- https://www.jetbrains.org/intellij/sdk/docs/tutorials/custom_language_support/syntax_highlighter_and_color_settings_page.html
- https://www.cuba-platform.com/discuss/t/how-to-turn-on-scss-highlighting-in-intellij-idea-ce/8104
- https://doc.cuba-platform.com/manual-7.0/web_theme_extension.html
- https://www.jetbrains.com/help/idea/javascript-specific-guidelines.html

#
~~~
############################################################
#
#   'file size exceeds configured limit' issue in PhpStorm 8 FIX
#   https://github.com/navinpeiris/jsca2js/issues/15
#   https://www.jetbrains.com/help/clion/configuring-file-size-limit.html
#
############################################################

# HELP -> Edit custom Proprieties >
/home/user/.PhpStorm2017.2/config/idea.properties
# custom PhpStorm properties
idea.max.intellisense.filesize=7500

# HELP -> Edit custom VM Options >
/home/user/.PhpStorm2017.2/config/phpstorm64.vmoptions
-Didea.max.intellisense.filesize=7500

Edit Custom Properties (as commented by @eggplantbr).
On older versions, there's no GUI to do it. But you can change it if you edit the IntelliJ IDEA Platform Properties file:
~~~

#
~~~
#---------------------------------------------------------------------
# Maximum file size (kilobytes) IDE should provide code assistance for.
# The larger file is the slower its editor works and higher overall system memory requirements are
# if code assistance is enabled. Remove this property or set to very large number if you need
# code assistance for any files available regardless their size.
#---------------------------------------------------------------------
idea.max.intellisense.filesize=2500

PyCharm CE: /Applications/PyCharm CE.app/Contents/bin/idea.properties
WebStorm: /Applications/WebStorm.app/Contents/bin/idea.properties

product64.vmoptions / product.vmoptions for -Xms and -Xmx

up vote
-1
down vote
Edit config file for IDEA: IDEA_HOME/bin/idea.properties

# Maximum file size (kilobytes) IDE should provide code assistance for.
idea.max.intellisense.filesize=60000

# Maximum file size (kilobytes) IDE is able to open.
idea.max.content.load.filesize=60000
Save and restart IDE

pycharm{64,.exe,64.exe}.vmoptions:
<code>
-server
-Xms128m
...
-Didea.max.intellisense.filesize=999999 # <--- new line
</code>
~~~

~~~
##################################################################
#
#   phpstorm uml phpstorm hierarchies diagram
#
##################################################################
~~~

- https://www.jetbrains.com/phpstorm/whatsnew/
- https://blog.jetbrains.com/phpstorm/2017/09/uml-diagrams-in-phpstorm-2017-2/
- https://www.jetbrains.com/help/phpstorm/class-diagram.html
- https://www.jetbrains.com/help/idea/building-call-hierarchy.html
- https://www.jetbrains.com/help/idea/hierarchy-tool-window.html
- https://www.jetbrains.com/help/phpstorm/building-hierarchies.html
- https://www.jetbrains.com/help/phpstorm/hierarchy-tool-window.html
- https://www.jetbrains.com/help/idea/viewing-hierarchies.html
- https://www.jetbrains.com/help/idea/building-class-hierarchy.html
- https://www.jetbrains.com/help/idea/viewing-structure-and-hierarchy-of-the-source-code.html
- https://www.jetbrains.com/help/idea/project-module-dependencies-diagram.html
- https://blog.jetbrains.com/phpstorm/2013/05/working-with-uml-class-diagrams-in-phpstorm/
- https://www.jetbrains.com/help/idea/diagrams.html
- https://www.jetbrains.com/help/phpstorm/class-diagram-toolbar-and-context-menu.html
- https://www.jetbrains.com/help/idea/diagram-toolbar-and-context-menu.html


~~~
PlantUML integration + UML
Compatible with all IntelliJ-based IDEs
https://plugins.jetbrains.com/plugin/7017-plantuml-integration/


Usage:
- Open file, put the cursor inside of the PlantUML code to render it
- PlantUML code must be inside @startuml and @enduml tags to be rendered
- To render other than sequence diagram types, install Graphviz and set path to it

- A new file can be created from template (File | New | PlantUML File)
- PlantUML code can be placed anywhere, '*' are ignored for usage in Java comments
- About screen tests Graphviz installation

Intentions (Alt+Enter):
- reverse arrow
- with a caret on top of @startuml:
- disable syntax check
- enable partial rendering - renders each page on it's own, useful for big sequence diagram files

Performance tips:
- disable automatic rendering and use Update (Alt+D) or Reload (Alt+F) buttons
- do not put @newpage into included files (it prohibits incremental rendering)
- try to enable partial rendering
- disable syntax checking
- tune cache size in settings, make sure you have enough heap memory (enable Memory Indicator)

Other supported PlantUML features:
- @startuml <filename> - changes default filename when saving/exporting
- Settings | PlantUML config - useful for global 'skinparam' command

UML Design Tool Plugin JAkutenshi
Compatible with IntelliJ IDEA, Android Studio
https://plugins.jetbrains.com/plugin/8394-uml-design-tool-plugin/
~~~

#
~~~
#############################################################
plugins
#############################################################
~~~

- https://plugins.jetbrains.com/plugin/7622-php-inspections-ea-extended-
- https://plugins.jetbrains.com/plugin/9568-go
- https://plugins.jetbrains.com/plugin/8286-sequencediagram
- https://plugins.jetbrains.com/plugin/7495--ignore
- https://plugins.jetbrains.com/idea/plugin/7495--ignore
- https://plugins.jetbrains.com/plugin/7276-php-advanced-autocomplete
- https://plugins.jetbrains.com/plugin/7796-perl
- https://plugins.jetbrains.com/plugin/12128-monkai-pro-theme
- https://plugins.jetbrains.com/plugin/12100-dark-purple-theme
- https://plugins.jetbrains.com/plugin/5919-lines-sorter

~~~
Awesome plugins for android studio
https://dev.to/segun_codes/awesome-plugin-on-android-studio-eh3
https://www.sitepoint.com/9-more-essential-plugins-for-android-studio/
~~~
~~~
Codota							https://plugins.jetbrains.com/plugin/7638-codota-
String Manipulation				https://plugins.jetbrains.com/plugin/2162-string-manipulation/
Maven Helper					https://plugins.jetbrains.com/plugin/7179-maven-helper
Butterknife						https://plugins.jetbrains.com/plugin/7369-android-butterknife-zelezny
CodeGlance						https://plugins.jetbrains.com/plugin/7275-codeglance
ADB Idea						https://plugins.jetbrains.com/plugin/7856-adb-wifi
DTO generator					https://plugins.jetbrains.com/plugin/7834-dto-generator
Material Design Icon Generator	https://plugins.jetbrains.com/plugin/7647-android-material-design-icon-generator/
Power Mode II					https://plugins.jetbrains.com/plugin/8251-power-mode-ii
~~~

~~~
The PhpStorm plugins of my choice
https://blog.alejandrocelaya.com/2017/09/16/the-phpstorm-plugins-of-my-choice/

.env							https://plugins.jetbrains.com/plugin/9525--env-files-support
.ignore							https://plugins.jetbrains.com/plugin/7495--ignore
BashSupport						https://plugins.jetbrains.com/plugin/4230-bashsupport
CodeGlance						https://plugins.jetbrains.com/plugin/7275-codeglance
PHP Annotations					https://plugins.jetbrains.com/plugin/7320-php-annotations
PHP composer.json support		https://plugins.jetbrains.com/plugin/7631-php-composer-json-support
Php Inspections					https://plugins.jetbrains.com/plugin/7622-php-inspections-ea-extended-
PHPUnit Enhancement				https://plugins.jetbrains.com/plugin/9674-phpunit-enhancement
Swagger plugin					https://plugins.jetbrains.com/plugin/8347-swagger

Essential PhpStorm plugins
https://localheinz.com/blog/2017/10/27/essential-phpstorm-plugins/
CamelCase						https://plugins.jetbrains.com/plugin/7160-camelcase
Lines Sorter					https://plugins.jetbrains.com/plugin/5919-lines-sorter
Makefile support				https://plugins.jetbrains.com/plugin/9333-makefile-support
Markdown Navigator Enhance		https://plugins.jetbrains.com/plugin/7896-markdown-navigator-enhanced
RegexpTester					https://plugins.jetbrains.com/plugin/2917-regexptester
Shellcheck						https://plugins.jetbrains.com/plugin/10195-shellcheck
String Manipulatio				https://plugins.jetbrains.com/plugin/2162-string-manipulation
Symfony Support					https://plugins.jetbrains.com/plugin/7219-symfony-support
~~~
~~~
https://plugins.jetbrains.com/plugin/7275-codeglance/reviews
https://plugins.jetbrains.com/plugin/7275-codeglance


http://eliasbagley.github.io/android/2015/10/04/essential-android-studio-plugins.html
https://emmanuelballery.com/blog/2016-05-20-mes-plugins-phpstorm
https://androidmonks.com/android-studio-plugins/
https://blog.devknox.io/7-must-have-plugins-android-studio/
https://www.ericdecanini.com/2019/12/30/top-9-android-studio-plugins-as-of-january-2020-kotlin-friendly/##
https://www.quora.com/What-are-the-best-extensions-for-PyCharm
https://informationarchitect.pl/speed-up-your-coding-with-phpstorm-features/


Top IntelliJ plugins, settings you should customize, shortcuts you should know, and more
https://www.software.com/src/top-intellij-plugins-settings-shortcuts-and-more


Native Terminal (48k)			https://plugins.jetbrains.com/plugin/9966-native-terminal/
Scratch (108k)					https://plugins.jetbrains.com/plugin/4428-scratch/
GitToolBox (680k)				https://plugins.jetbrains.com/plugin/7499-gittoolbox/
Docker (2.2M)					https://plugins.jetbrains.com/plugin/7724-docker/
Code Time (11.7k)				https://plugins.jetbrains.com/plugin/10687-code-time/
~~~
#
~~~
################################################################
#
#	Smarty PhpStorm Plugs ?
#
################################################################
~~~

- https://confluence.jetbrains.com/pages/viewpage.action?pageId=15801728
- https://www.jetbrains.com/help/phpstorm/smarty.html
- https://www.smarty.net/docs/en/
- https://www.smarty.net/docs/en/variable.plugins.dir.tpl
- https://www.jetbrains.com/help/phpstorm/quick-start-guide-phpstorm.html
- https://github.com/smarty-php/smarty
- https://intellij-support.jetbrains.com/hc/en-us/community/posts/360001058479-Autocomplete-in-Smarty-templates
- https://youtrack.jetbrains.com/issue/WI-11879
- https://youtrack.jetbrains.com/issue/WI-6531#comment=27-545660
- https://youtrack.jetbrains.com/issue/WI-45574
- https://youtrack.jetbrains.com/issue/WI-20612
- https://youtrack.jetbrains.com/issue/WI-20563
- https://youtrack.jetbrains.com/issue/WI-20612
- https://www.jetbrains.com/phpstorm/documentation/#video
- https://confluence.jetbrains.com/display/PhpStorm/Tutorials
- https://plugins.jetbrains.com/plugin/7853-oxid-plugin
- https://plugins.jetbrains.com/plugin/7219-symfony-support

~~~
PHP associative array auto-completion inferred from other functions. ( deep-assoc-completion )
https://plugins.jetbrains.com/plugin/9927-deep-assoc-completion
https://plugins.jetbrains.com/plugin/9927-deep-assoc-completion
~~~

#
~~~
################################################################
#
#   Change signature refactoring in PhpStorm | PhpStorm Blog
#
################################################################
~~~

- https://blog.jetbrains.com/phpstorm/2013/03/change-signature-refactoring-in-phpstorm/
- https://www.jetbrains.com/help/phpstorm/change-signature.html
- https://www.jetbrains.com/help/idea/change-signature.html
- https://www.youtube.com/watch?v=Rd2YV3hNfjg
- https://www.youtube.com/watch?v=p6Tsw_3cXow

#
~~~
################################################################
#
#   IntelliJ: changing color of an unused variable WebStorm IntelliJ IDEA PhpStorm
#
################################################################
~~~
- https://www.jetbrains.com/help/phpstorm/2019.3/accessibility.html
- https://www.jetbrains.com/help/webstorm/configuring-colors-and-fonts.html
- https://www.jetbrains.com/help/idea/configuring-colors-and-fonts.html
- https://www.evoweb.de/allgemeine-entwicklung/tools/phpstorm-noinspection.html

~~~
Settings - Editor - Color Scheme - General - Unused symbol - Foreground
~~~

~~~
################################################################
#
#	Easiest way to copy filename to clipboard?
#
################################################################
~~~

- https://intellij-support.jetbrains.com/hc/en-us/community/posts/206316809-Easiest-way-to-copy-filename-to-clipboard-
- https://intellij-support.jetbrains.com/hc/en-us/community/posts/207076275-Shortcut-to-copy-file-name-to-clippboard
- https://www.jetbrains.com/help/rider/Cutting_Copying_and_Pasting.html
- https://medium.com/@andrey_cheptsov/top-20-navigation-features-in-intellij-idea-ed8c17075880
~~~
Select a file in Project tool window and hit Ctrl+C - file name will be copied to clipboard

or

Try this: Alt+Shift+S and Ctrl+C
(Alt+Shift+S opens 'Save Context...' dialog with selected filename. Just copy it)

File Name Grabber Plugin
https://plugins.jetbrains.com/plugin/6826-file-name-grabber

IntelliJ IDEA Key Bindings for Visual Studio Code
https://marketplace.visualstudio.com/items?itemName=k--kato.intellij-idea-keybindings
~~~

#
~~~
############################################################################
#
#   jetbrains templates
#
############################################################################
~~~

- https://plugins.jetbrains.com/plugin/8006-material-theme-ui
- https://plugins.jetbrains.com/plugin/12275-dracula-theme
- https://plugins.jetbrains.com/plugin/11938-one-dark-theme
- https://plugins.jetbrains.com/plugin/12310-gruvbox-theme
- https://plugins.jetbrains.com/plugin/12100-dark-purple-theme
- https://plugins.jetbrains.com/plugin/12118-hiberbee-theme
- https://plugins.jetbrains.com/plugin/12163-monocai-color-theme
- https://plugins.jetbrains.com/plugin/12226-vuesion-theme
- https://plugins.jetbrains.com/plugin/13106-xcode-dark-theme
- https://plugins.jetbrains.com/plugin/12124-material-theme-ui-lite
- https://plugins.jetbrains.com/plugin/12692-darcula-darker-theme
- https://plugins.jetbrains.com/plugin/12178-atom-onedark-theme
- https://plugins.jetbrains.com/plugin/13643-monokai-pro

#
~~~
############################################################################
misc
############################################################################
~~~
~~~
https://www.jetbrains.com/help/phpstorm/configuring-inspection-severities.html
https://www.jetbrains.com/help/phpstorm/creating-and-optimizing-imports.html
https://www.jetbrains.com/help/phpstorm/keeping-namespaces-in-compliance-with-psr0-and-psr4.html
https://www.jetbrains.com/help/phpstorm/code-inspections-in-php.html
https://intellij-support.jetbrains.com/hc/en-us/community/posts/206897215-Code-analysis-has-been-suspended
https://intellij-support.jetbrains.com/hc/en-us/community/posts/205820559-Code-analysis-has-been-suspended-Doing-file-refresh-
~~~

~~~
--------------------------------------------------------------------------------------------------------
Code analysis has been suspended (Doing file refresh.)
Analyze -> Inspect code re-enabled
--------------------------------------------------------------------------------------------------------
GoLand code analysis has been suspended FIX
https://stackoverflow.com/questions/64220876/goland-code-analysis-has-been-suspended-how-to-re-start-it


Press shift twice and in the context window type Inspect Code Actions
Select it and press Enter
Then from another context menu choose Configure Current File Analysis
Choose All Problems
--------------------------------------------------------------------------------------------------------
disable inspection css unknow CSS property
https://intellij-support.jetbrains.com/hc/en-us/community/posts/206371239-How-to-add-CSS-properties-
https://github.com/postcss/autoprefixer/issues/1035
https://www.jetbrains.com/help/rider/Code_Inspections_in_CSS.html

File --> Settings --> Inspections --> CSS --> Unknow CSS property --> Custom CSS properties
autocomplete with Bootstrap not works from CDN!
--------------------------------------------------------------------------------------------------------

IntelliJ IDEA Community (Java, Kotlin, Groovy, Scala) (Git, SVN, Mercurial, CVS, TFS)
https://www.jetbrains.com/idea/download/#section=linux

PyCharm Community (Python)
https://www.jetbrains.com/pycharm/download/#section=linux
~~~

#
~~~
##############################################################
42 IntelliJ IDEA Tips and Tricks
##############################################################
https://www.youtube.com/watch?v=eq3KiAH4IBI
~~~
~~~
https://plugins.jetbrains.com/plugin/7345-presentation-assistant
https://plugins.jetbrains.com/plugin/164-ideavim

Shift+Ctrl+Alt+N 	        - symbol lookup "float/index"
Shift+Ctrl+N 		        - navigate to file or /folders  or file:40 - goes to 40 line
Ctrl+N 			            - nativate to type
Ctrl+Alt+S 		            - settings
Ctrl+E			            - switch recent files
Alt+1			            - side show files sidebar left
Alt+F 	 		            - path/to/new/dir
Shift+Ctrl+Alt+Insert	    - create temp file for test
Ctrl+W 			            - select lines by block
Ctrl+Alt+I		            - fix indentation
Ctrl+Alt+L		            - prettify
Shift+Ctrl+right/Left	    - adjust panels width
Shift+Ctrl+Enter	        - postfix completion
Ctrl+F12 		            - show structure
Dbl Shift+run inspection    - select a specific inspection
Alt+Shift+I 		        - inspection
~~~

#
~~~
##############################################################
More IntelliJ IDEA Tips and Tricks by Trisha Gee
https://www.youtube.com/watch?v=9AMcN-wkspU
https://www.youtube.com/watch?v=yefmcX57Eyg
##############################################################


Ctrl+Shift+E 		    - find action
Ctrl+E 			        - open some window
Ctrl+Alt+S 		        - settings
Ctrl+Shift+T		    - navigate test Class
Ctrl+Alt+Left		    - navigate
Ctrl+Shift+E		    - show all recent locations ?
Alt+Insert 		        - create new class
Ctrl+Alt+V		        - extract
Ctrl+Space 		        - completion
Ctrl+Shift+Enter 	    - completion for if/else
Ctrl+Y			        - delete line
Ctrl+N			        - search
Alt+Slash		        - iterate true vars
Ctrl+T 			        - do some in context
Ctrl+Shift+Up/Dw 	    - move statement up
Ctrl+W			        - select current string from cursor
Ctrl+Shift+Left		    - add surround selection
Ctrl+Shift+J 		    - rejoin lines
Alt+E+language		    - insert language injection
Ctrl+Enter		        - enter new line
Ctrl+Shift+V 		    - show last 5 copy history
Ctrl+Shift+B 		    - multiple cursors / multiple line edit
Dbl Tab+Ctrl + mouse 	- multiple line edit
Ctrl+Shift+Alt+J 	    - select all instances of some tag element
Alt+Enter+ 		        - refactoring > invert if condition
Alt+Enter+		        - refactoring > code style settings - wrap always
Ctrl+Shift+P		    - code analysis ?
Alt+9			        - open version control
Ctrl+K 			        - commit git
Ctrl+Alt+K 			    - commit git and push
~~~

#
~~~
##############################################################
Convert Arrays to Short Syntax
phpstorm replace array() notation to [ ] short syntax
##############################################################

https://phpstorm.tips/tips/17-convert-arrays/
https://stackoverflow.com/questions/23697248/phpstorm-replace-array-notation-to-short-syntax
P.S. This inspection/fix available since PhpStorm v7.1.

Settings > Editor > Inspections > PHP > Code Style > PSR-12 > Traditional syntax array literal detected > Disable
~~~

#
~~~
##############################################################

Tuning Java

##############################################################
~~~

- https://docs.oracle.com/javase/8/docs/technotes/tools/unix/java.html
- https://docs.oracle.com/javase/8/docs/technotes/guides/vm/performance-enhancements-7.html
- https://docs.oracle.com/javase/8/embedded/develop-apps-platforms/codecache.htm
- https://www.jetbrains.com/help/pycharm/tuning-the-ide.html
- https://www.eclipse.org/openj9/docs/xxusecompressedoops/
- https://www.ibm.com/support/knowledgecenter/SSYKE2_7.0.0/com.ibm.java.zos.70.doc/diag/appendixes/cmdline/xxusecompressedoops.html
- https://dev.to/mokkapps/why-i-switched-from-visual-studio-code-to-jetbrains-webstorm-939
- https://docs.geoserver.org/maintain/en/user/production/container.html
- https://www.oracle.com/technetwork/java/hotspotfaq-138619.html
- https://help.sap.com/saphelp_nwpi711/helpdata/de/f0/cec51dabd1461b87e4db9e3958710e/content.htm?no_cache=true

~~~
-Xms128m # initial startup heap memory
-Xmx756M # upper limit memory
-XX:SoftRefLRUPolicyMSPerMB=36000 # lifetime of “soft references” 36 seconds
-XX:+UseParallelGC # default garbage collector
-XX:+UseParNewGC # concurrent mark sweep (CMS) garbage collector
–XX:+UseG1GC # default garbage collector since Java 9

try out memory settings
java -Xms128m -Xmx756m -XX:+PrintFlagsFinal -version | grep HeapSize

try out  UseCompressedOops
java -XX:+PrintFlagsFinal -version|grep UseCompressedOops

Enable the Marlin rasterizer
-Dsun.java2d.renderer=org.marlin.pisces.MarlinRenderingEngine
-Dsun.java2d.renderer=sun.java2d.marlin.MarlinRenderingEngine


-Xmx<size>: maximum size of the Java heap
-Xms<size>: initial heap size
-XX:MaxPermSize=<size>: maximum size of permanent generation
-XX:PermSize=<size>: initial size of the permanent generation
-XX:MaxNewSize=<size>: maximum size of the young generation
-XX:NewSize=<size>: initial size of the young generation
-XX:ParallelGCThreads=<val>: number of threads used by the GC
-XX:MaxTenuringThreshold=<val>: maximum number of copies inside the young generation before promotion
-XX:SurvivorRatio=<val>: ratio between eden and one survivor space. The eden is <val> times bigger than a survivor space
-XX:TargetSurvivorRatio=<val>: desired fill level in % of a survivor space. The SAP JVM automatically adjusts the tenuring threshold (only ParNewGC)
-XX:SoftRefLRUPolicyMSPerMB=<value>: threshold in ms per free MB for clearing unreferenced SoftReferences
-XX:GCHeapFreeLimit=<value>
minimum percentage of free space after a full GC before an OutOfMemoryError is thrown. Default value: 10.

-XX:GCTimeLimit=<value>
limit of proportion of time spent in GC before an OutOfMemoryError is thrown. Default value: 90

-XX:{+-}UseGCOverheadLimit
use policy to limit of proportion of time spent in GC before an OutOfMemory error is thrown. Default value: +.
~~~

#
~~~
##############################################################
PhpStorm 2020.2
https://blog.jetbrains.com/phpstorm/2017/11/bring-exceptions-under-control/
##############################################################

Code Inspection: Unhandled exception

Reports the exceptions that are neither enclosed in a try-catch block nor documented via the @throws tag.
~~~

#
~~~
##############################################################
Php Inspections (EA Ultimate)
##############################################################
https://plugins.jetbrains.com/plugin/16935-php-inspections-ea-ultimate-

Key Promoter X
https://plugins.jetbrains.com/plugin/9792-key-promoter-x

PHPUnit Enhancement
https://plugins.jetbrains.com/plugin/9674-phpunit-enhancement

https://plugins.jetbrains.com/plugin/13643-monokai-pro-theme
https://plugins.jetbrains.com/plugin/7724-docker
https://plugins.jetbrains.com/plugin/9333-makefile-language
https://plugins.jetbrains.com/plugin/9333-makefile-language
https://plugins.jetbrains.com/plugin/9525--env-files-support
~~~


#
~~~
##############################################################
File | Settings | Editor | Code Style | PHP > Wrapping and Braces
##############################################################
https://www.drupal.org/project/drupal/issues/935284
https://stackoverflow.com/questions/14962667/what-is-a-line-length-soft-limit-and-how-do-i-interpret-this-in-the-psr-2-conv
https://www.jetbrains.com/webstorm/guide/tips/soft-wraps/
https://www.jetbrains.com/idea/guide/tips/enable-soft-wrap/
https://stackoverflow.com/questions/10351608/word-wrapping-in-phpstorm

PHP/Zend standard: The target line length is 80 characters.
That is to say, Zend Framework developers should strive keep each line of their code under 80 characters where possible and practical.
However, longer lines are acceptable in some circumstances. The maximum length of any line of PHP code is 120 characters.

PEAR standard: It is recommended to keep lines at approximately 75-85 characters long for better code readability.
Paul M. Jones has some thoughts about that limit.
~~~


#
~~~
##############################################################
local history
##############################################################

PhpStorm show changed/modified files in project view

https://www.jetbrains.com/help/phpstorm/local-history.html
https://blog.jetbrains.com/idea/2020/03/intellij-idea-2020-1-eap7/
https://foojay.io/today/intellij-idea-changelists-and-git-staging/
https://www.youtube.com/watch?v=yvW-6Evx50Y
https://www.youtube.com/watch?v=2vIOyoSZJsE
https://www.jetbrains.com/help/phpstorm/viewing-changes-information.html#annotations
https://stackoverflow.com/questions/11483227/make-phpstorm-show-changed-modified-files-in-project-view


Restore changes
Restore deleted files
Add labels to specific states Local History


set retention to 30 days
-DlocalHistory.daysToKeep=30

or Ctrl+Alt+S) , go to Advanced Settings.
Duration of storing changes in Local History field.

ry pressing Cmd+E or Ctrl+E and then check "Show changed only". You can also click the "Project" dropdown in the left side panel and select "All changed files"

Go to file >> settings >> Editor >> General >> Editor Tabs. Check Mark modified tabs with asterisk Click ok

[EA] Using integer keys would enable array optimizations here.
https://github.com/kalessil/phpinspectionsea/blob/master/docs/performance.md
~~~

#
~~~
############################################
PHPStorm IDE Themes
############################################

dark

- https://plugins.jetbrains.com/plugin/13106-xcode-dark-theme
- https://plugins.jetbrains.com/plugin/15727-xcode-theme
- https://marketplace.visualstudio.com/items?itemName=vscode-icons-team.vscode-icons
- https://marketplace.visualstudio.com/items?itemName=MateoCERQUETELLA.xcode-12-theme
- https://marketplace.visualstudio.com/items?itemName=dracula-theme.theme-dracula
- https://marketplace.visualstudio.com/items?itemName=GitHub.github-vscode-theme
- https://marketplace.visualstudio.com/items?itemName=monokai.theme-monokai-pro-vscode

light

- https://plugins.jetbrains.com/plugin/12317-espresso-light-theme
- https://plugins.jetbrains.com/plugin/12138-clean-sheet-theme
- https://plugins.jetbrains.com/plugin/15772-espresso-lightgram
~~~
#
~~~
############################################
ide excluding files
############################################
https://www.jetbrains.com/help/phpstorm/excluding-files-from-project.html#phar
https://www.jetbrains.com/help/idea/indexing.html
https://developers.shopware.com/developers-guide/phpstorm/
~~~
#
~~~
############################################
add string at the begin of lines - Shift Alt G + Pos Up
############################################

https://www.jetbrains.com/webstorm/guide/tips/multi-cursor/
~~~
~~~
############################################
line endings
############################################
https://www.jetbrains.com/help/idea/configuring-line-endings-and-line-separators.html
~~~

### plugin themes

- https://plugins.jetbrains.com/plugin/14965-visual-studio-2019-dark-theme
- https://plugins.jetbrains.com/plugin/15418-github-theme
- https://plugins.jetbrains.com/plugin/15727-xcode-theme
- https://plugins.jetbrains.com/plugin/12226-vuesion-theme
- https://plugins.jetbrains.com/plugin/8006-material-theme-ui
- https://plugins.jetbrains.com/plugin/12124-material-theme-ui-lite
- https://plugins.jetbrains.com/plugin/10321-nord

### PhpStorm does not sync with the server

~~~
https://www.jetbrains.com/help/phpstorm/deploying-applications.html
https://www.jetbrains.com/help/phpstorm/creating-a-remote-server-configuration.html
https://www.jetbrains.com/help/phpstorm/configuring-synchronization-with-a-remote-host.html
https://www.jetbrains.com/help/phpstorm/creating-a-remote-server-configuration.html
https://blog.jetbrains.com/phpstorm/2021/12/phpstorm-2021-3-release/#remote_development
https://www.webfoobar.com/node/92
https://developers.shopware.com/developers-guide/vagrant-phpstorm/

https://www.youtube.com/watch?v=v222Dtz7jm0
https://www.youtube.com/watch?v=nzkNHkZD6pY
https://www.youtube.com/watch?v=6r9NJDHiJwA
https://www.youtube.com/watch?v=AHK20LWEWXQ
https://www.youtube.com/watch?v=v222Dtz7jm0
https://www.youtube.com/watch?v=8qG_BK11nLg

https://stackoverflow.com/questions/26231260/phpstorm-does-not-sync-with-the-server

FIX
Build-> Deploymennt > Options -> Upload changed files automatically on default server


To manually sync with remote files (any direction) you have these main options:

Use Remote Host side panel (can be accessed via Tools | Deployment | Browse Remote Host 
if its closed/hidden) and download any files or folders manually 
(drag and drop can also be used, just make sure that you are copying 
files because by default IDE tries to "move" (copy+delete) instead of just "copy").
 It has a "Refresh" button to refresh the remote location.

Use two-way synchronisation (with preview) accessible via right click on desired 
folder(s)/files and choosing Deployment | Synch with Deployed... where you can sync 
those files/folders both ways (by default newer stuff will override older
 regardless of the direction).

The IDE can automatically sync one way (from local to remote): just ensure that 
automatic deployment is enabled and you have one server (or a group) marked as 
Default for this project.

Settings (Preferences on macOS) | Build, Execution, Deployment | Deployment | Options
 | Upload changed files automatically to the default server is the option. 
 Check other options there to better suit your needs.

~~~

### multiple definitions exist for class phpstorm
~~~
https://stackoverflow.com/questions/23066665/multiple-definitions-exist-for-class
https://youtrack.jetbrains.com/issue/WI-17646
https://stackoverflow.com/questions/8882839/generate-documentation-for-multiple-classes-with-the-same-name
https://github.com/barryvdh/laravel-ide-helper/issues/592


TM you either just ignore the under-waving .. or you can configure that inspection to not to report such cases (Settings/Preferences | Editor | Inspections | PHP | Undefined | Undefined class, it has Don't report multiple class declaration potential problems checkbox).

The only other way is to ensure that there is only one class with the same name in the project. For that you may use:

Mark whole folder as excluded [FIX OK]
Mark individual file as Plain Text

/** @noinspection PhpMultipleClassDeclarationsInspection */

/**
 * MyClass #1
 * @package PackageOne
 */
class MyClass {}

/**
 * MyClass #2
 * @package PackageTwo
 */
class MyClass {}
~~~



### IntelliJ Idea Ctrl+Shift+U shortcut doesn't work in Ubuntu
How to disable Ctrl+Shift+U?
~~~

https://superuser.com/questions/358749/how-to-disable-ctrlshiftu/1392682#1392682
https://superuser.com/questions/358749/how-to-disable-ctrlshiftu
https://stackoverflow.com/questions/47808160/intellij-idea-ctrlaltleft-shortcut-doesnt-work-in-ubuntu
https://www.cloudflight.io/en/blog/intellij-idea-and-eclipse-shortcuts/
https://www.jetbrains.com/help/rider/Keyboard_Shortcuts_Troubleshooting.html
https://youtrack.jetbrains.com/issue/IDEA-112533
https://keycombiner.com/collections/phpstorm/

Go to Language Support on System Settings and change the Keyboard input method system to none

#### FIX #####
Solution
This shortcut can be changed or disabled using the ibus-setup utility:
Run ibus-setup from the terminal (or open IBus Preferences).
Go to “Emoji”. -> Next to “Unicode code point:”, click on the three dots (i.e. ...). -> In the dialog, click “Delete”, then “OK”.
Close the IBus Preferences window.
#### // FIX #####

Ubuntu 18.04 Solution
@ShmulikA's answer was close, but unfortunately, selecting "None" did not work for me. I can confirm the process below works in 18.04 as of April 2019.

Open Search using Super key (aka WIN for folks like me)
Type "language support" and hit ENTER

~~~


### PHPStorm undefined variable include
~~~

https://www.jetbrains.com/help/phpstorm/php-undefined-variable.html
https://youtrack.jetbrains.com/issue/WI-60611/PHPStorm-says-that-Variable-is-undefined-when-coming-from-requir
https://stackoverflow.com/questions/22476778/phpstorm-undefined-variables-caused-by-include-require
https://www.evoweb.de/allgemeine-entwicklung/tools/phpstorm-noinspection.html

inspection in file scope

Fix issue around by enabling:
Settings | Editor | Inspections | PHP | Undefined | Undefined Variable | Search for variable's definition outside the current file.

/** @noinspection PHPUndefinedSymbol */#
~~~


### Code Style. PHP PSR-12 code style

~~~
https://www.jetbrains.com/help/phpstorm/configuring-code-style.html#configure-code-style-schemes
https://www.jetbrains.com/help/phpstorm/settings-code-style-php.html
~~~