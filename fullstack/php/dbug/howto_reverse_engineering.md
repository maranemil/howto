
######
###   bouml
######
```
http://bouml.free.fr/
https://www.bouml.fr/
https://www.bouml.fr/download.html
https://www.bouml.fr/tutorial/tutorial.html
https://www.bouml.fr/documentation.html
https://www.phpdoc.org/

<Ubuntu>
wget -q https://www.bouml.fr/bouml_key.asc -O- | sudo apt-key add -
echo "deb https://www.bouml.fr/apt/disco disco free" | sudo tee -a /etc/apt/sources.list
deb https://www.bouml.fr/apt/disco disco free
sudo apt-get update

wget -q http://bouml.free.fr/bouml_key.asc -O- | sudo apt-key add -
echo "deb http://bouml.free.fr/apt/disco disco free" | sudo tee -a /etc/apt/sources.list
deb http://bouml.free.fr/apt/disco disco free
sudo apt-get update

sudo apt-get install bouml

<Debian>
wget -q https://www.bouml.fr/bouml_key.asc -O- | sudo apt-key add -
echo "deb https://www.bouml.fr/apt/stretch stretch free" | sudo tee -a /etc/apt/sources.list
deb https://www.bouml.fr/apt/stretch stretch free
sudo apt-get update

wget -q http://bouml.free.fr/bouml_key.asc -O- | sudo apt-key add -
echo "deb http://bouml.free.fr/apt/stretch stretch free" | sudo tee -a /etc/apt/sources.list
deb http://bouml.free.fr/apt/stretch stretch free
sudo apt-get update

sudo apt-get install bouml
```
######
###	phpuml
######
```
https://pear.php.net/package/PHP_UML/
pear install pear/php_uml
phpuml -o project.xmi


https://pear.php.net/manual/en/package.php.php-uml.intro.php
sudo apt install php-pear
sudo pear install pear/php_uml
pear list
pear list php_uml | grep phpuml


phpuml [INPUT] -o [OUTPUT LOCATION] -f [OUTPUT FORMAT]

/usr/bin/phpuml -h

-o directory                 			Output directory
-f format, --format=format   			Output format: "xmi" (default), "html", "htmlnew", "php"
-n name                      			Name of the generated UML model
-e encoding                  			Output character encoding

--no-deployment-view        			Disable generation of deployment view
--no-component-view         			Disable generation of component view
--no-dollar                 			Remove the dollar symbol in variable names
--no-docblocks              			Disable docblocks parsing (@package,  @param...)
--show-internal             			Include the elements marked with @internal
--only-api                  			Include only the elements marked with @api

-i pattern, --ignore=pattern  			Patterns/pathnames to ignore  (example: .svn)
-m pattern, --match=pattern             Patterns to match (default is: *.php)
-l errorLevel, --error-level=errorLevel	Set the error reporting level (0 for silent mode, 1 for PHP errors and exceptions, 2 for all errors and warnings)
--pure-object                           Use this switch if you want PHP_UML to ignore all non object-oriented code
-h, --help                            	show this help message and exit
-v, --version                         	show the program version and exit


 phpuml /var/www/test -o /tmp -x 1 -n Foo -m *.php6 -i .svn

 PHP_UML will recursively parse /var/www/test, keeping only the php6
 files, and excluding the svn folders; the UML model will be named
 "Foo", and the generated XMI file, in version 1, will be saved to
 "/tmp/Foo.xmi"


Example
/usr/bin/phpuml ~/git/cakephp/ -o Documents/ -f html


phpuml /var/www/foo
phpuml /var/www/foo -n MyProject
phpuml /var/www/foo -f html -o /var/tmp/
phpuml /var/www/foo -m *.php *.txt
phpuml /var/www/foo --no-dollar -o foo.xmi
```

######
###	phuml
####	https://github.com/jakobwesthoff/phuml
####	http://stackz.ru/en/393603/php-uml-generator
######
```
https://dasunhegoda.com/class-diagram-from-php-code-using-phuml/867/

sudo apt install graphviz gimp
cd ~/git/
git clone https://github.com/jakobwesthoff/phuml
cd ~/git/phuml/src/app

./phuml -r /var/www/my_project -graphviz -createAssociations false -neato out.png
./phuml -r /home/emil/git/cakephp/ -graphviz -neato out.png
./phuml -r ./ -dot -createAssociations false -neato example.png

[|] Running... (This may take some time)
[|] Parsing class structure
[|] Running 'Graphviz' processor
[|] Running 'Neato' processor
```

######
###    uml hierarchies diagram
######
```
PHPCity
https://github.com/adrianhuna/PHPCity
https://adrianhuna.github.io/PHPCity/

Static analysis tools for PHP
https://github.com/exakat/php-static-analysis-tools

GraphML Generator: Generate UML diagrams from PHP code using GraphML
https://www.phpclasses.org/package/6025-PHP-Generate-UML-diagrams-from-PHP-code-using-GraphML.html
```


