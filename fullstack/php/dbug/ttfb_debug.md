######
###	Website Speed Test - Waiting TTFB DevTools
####	Waiting (TTFB). The browser is waiting for the first byte of a response. TTFB stands for Time To First Byte. This timing includes 1 round trip of latency and the time the server took to prepare the response.
######
```
https://kinsta.com/de/blog/ttfb/
https://www.webpagetest.org/
https://tools.pingdom.com/
https://gtmetrix.com/
https://kinsta.com/blog/gtmetrix-speed-test/
https://tools.keycdn.com/performance
http://www.bytecheck.com/
https://performance.sucuri.net/
https://woorkup.com/cloudflare-alternative/
https://github.com/addyosmani/timing.js/
https://blog.cloudflare.com/ttfb-time-to-first-byte-considered-meaningles/
https://developers.google.com/web/tools/chrome-devtools/network/understanding-resource-timing
https://hackernoon.com/solving-time-to-first-byte-ttfb-in-wordpress-5e6aeb03a8e
https://www.digitalocean.com/community/questions/how-can-i-improve-the-ttfb
http://pecl.php.net/apc
http://memcached.org/
http://varnish-cache.org/
https://developers.google.com/speed/pagespeed/insights/
https://www.goivvy.com/blog/magento-2-ttfb-optimization
https://support.plesk.com/hc/en-us/articles/213401729-MySQL-performance-is-slow-How-to-improve-it-
https://dev.mysql.com/doc/refman/5.7/en/slow-query-log.html
https://iperf.fr/
http://www.i18nguy.com/markup/metatags.html
https://www.ise.io/casestudies/industry-wide-misunderstandings-of-https/
https://www.hongkiat.com/blog/meta-tag-hidden-features/
https://developers.google.com/web/tools/chrome-devtools/network/reference#timing-explanation
http://www.websiteoptimization.com/speed/tweak/time-to-first-byte/
```

```
FIX: When response is to long > 1 min - check SQL Queries!


# apache test benchmark
ab -n 500 -c 50 http://www.~~.com/test.html
ab -n 500 -c 50 http://www.~~~.com/test.php


sudo service nginx restart
sudo nginx -s reload

curl -o /dev/null -w "Connect: %{time_connect} TTFB: %{time_starttransfer} Total time: %{time_total} \n" https://example.com/

curl -s -w '\nLookup time:\t\t%{time_namelookup}\nConnect time:\t\t%{time_connect}\nSSL handshake time:\t%{time_appconnect}\nPre-Transfer time:\t%{time_pretransfer}\nRedirect time:\t\t%{time_redirect}\nStart transfer time:\t%{time_starttransfer}\n\nTotal time:\t\t%{time_total}\n' -o /dev/null http://example.com


# Mirasvit Profiler Extension Magento
composer require mirasvit/module-profiler
php -f bin/magento module:enable Mirasvit_Profiler
php -f bin/magento setup:upgrade
php -f bin/magento mirasvit:profiler:enable


# XHProf
sudo apt-get install pear
sudo pecl install -f xhprof
sudo service apache2 restart


[php-fpm-pool-settings]
slowlog = /var/www/vhosts/example.com/slow.log
request_slowlog_timeout = 5s


innodb_buffer_pool_size=1024M
query_cache_size=64M
```


```
<meta http-equiv="Cache-control" content="public">
<meta http-equiv="Cache-control" content="private">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache-control" content="no-store">
<meta http-equiv="Cache-Control" content="no-store" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="expires" content="Fri, 18 Jul 2014 1:00:00 GMT" />
<meta http-equiv="Set-Cookie" content="name=data; path=path; expires=Day, DD-MMM-YY HH:MM:SS ZONE">
<meta http-equiv="Set-Cookie" content="name=data; path=path; expires=Thursday, 01-Jan-2015 00:00:00 GMT">
<meta http-equiv="page-enter" content="revealtrans(duration=seconds,transition=num)" />
<meta http-equiv="page-exit" content="revealtrans(duration=seconds,transition=num)" />
<meta http-equiv="page-enter" content="blendTrans(duration=sec)" />
```

```
# start stop XDEBUG_SESSION
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_SESSION='+'PHPSTORM'+';path=/;';})()
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_SESSION='+''+';expires=Mon, 05 Jul 2000 00:00:00 GMT;path=/;';})()
# start stop XDEBUG_PROFILE
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_PROFILE='+'1'+';path=/;';})()
javascript:(/** @version 0.5.2 */function() {document.cookie='XDEBUG_PROFILE='+''+';expires=Mon, 05 Jul 2000 00:00:00 GMT;path=/;';})()
```




######
### PHP LIVE Testers
######
```
https://repl.it/languages/php_cli
https://sandbox.onlinephpfunctions.com/
https://extendsclass.com/php.html
https://sandbox.onlinephpfunctions.com/
https://www.tutorialspoint.com/execute_php_online.php
http://codepad.org/
http://phptester.net/
http://phpfiddle.org/
https://3v4l.org/
http://www.writephponline.com/
http://sandbox.onlinephpfunctions.com/
https://paiza.io/en/projects/new
http://phptester.net/
https://www.tutorialspoint.com/execute_php_online.php
https://rextester.com/l/php_online_compiler
http://phpfiddle.org/
https://repl.it/languages/php_cli
https://www.jdoodle.com/php-online-editor/
https://www.codegrepper.com/code-examples/php/phptester
```

######
### PHP CLI DEBUG
######
```
# cli mode
php -r echo 'helloworld';

# interactive mode
php -a
echo 'helloworld';
```


######
### PHP system, exec, passthru return code 127
### PHP system, exec, passthru and return code 127
######
```
Value 127 is returned by /bin/sh when the given command is not found within your PATH
 system variable and it is not a built-in shell command. In other words, the system doesn't
 understand your command, because it doesn't know where to find the binary you're trying to call.
```


######
###   php pest
######
```
https://pestphp.com/
https://blog.jetbrains.com/phpstorm/2020/10/how-the-pest-phpstorm-plugin-will-improve-your-testing-workflow/
```



######
### Trunk-Based Development
######
```
https://trunkbaseddevelopment.com/
https://devblogs.microsoft.com/devops/release-flow-how-we-do-branching-on-the-vsts-team/

feature flags
config file
```


######
### tdd
######
```
https://www.guru99.com/test-driven-development.html
https://testsigma.com/regression-testing/functional-regression-testing
https://www.qmetry.com/functional-regression-testing/
https://testlio.com/blog/when-to-use-functional-testing-vs-regression-testing/
https://www.guru99.com/regression-testing.html
http://agiledata.org/essays/tdd.html


build
functional tests
regression tests
performance tests
stage
production


unit tests
integration tests
e2e tests
```



######
### GOTO 2019 • "Good Enough" Architecture • Stefan Tilkov
#### https://www.youtube.com/watch?v=PzEox3szeRc
######
```
vision
business concept
tehnical concept
modeling
implementation
module testing
integration testing
rollout
```

######
### OWASP Top 10 Security Risks & Vulnerabilities
######
```
https://sucuri.net/guides/owasp-top-10-security-vulnerabilities-2021/
https://www.synopsys.com/glossary/what-is-owasp-top-10.html
https://www.veracode.com/security/owasp-top-10
https://www.immuniweb.com/resources/owasp-top-ten/
https://owasp.org/www-project-top-ten/

Injection
Broken authentication
Sensitive data exposure
XML external entities (XXE)
Broken access control
Security misconfigurations
Cross site scripting (XSS)
Insecure deserialization
Using components with known vulnerabilities
Insufficient logging and monitoring
```

### Security by Design: 7 Application Security Principles You Need to Know
```

https://www.cprime.com/resources/blog/security-by-design-7-principles-you-need-to-know/
https://www.ncsc.gov.uk/collection/cyber-security-design-principles

1. Principle of Least Privilege
2. Principle of Separation of Duties
3. Principle of Defense in Depth
4. Principle of Failing Securely
5. Principle of Open Design
6. Principle of Avoiding Security by Obscurity
7. Principle of Minimizing Attack Surface Area
8. How to Dive Deeper
```
