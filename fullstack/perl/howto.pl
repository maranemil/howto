####################################################################
#
#   Getting started with DateTime in Perl
#
#   https://www.techgig.com/skilltest/perl
#   https://www.perl.com/pub/2003/03/13/datetime.html/
#   http://www.perlmonks.org/?node_id=321831
#   http://perldoc.perl.org/functions/localtime.html
#   https://www.tutorialspoint.com/perl/perl_date_time.htm
#
#   https://www.jdoodle.com/
#   https://www.jdoodle.com/execute-perl-online
#   http://codepad.org/
#   http://www.compileonline.com/execute_perl_online.php
#   https://www.tutorialspoint.com/execute_perl_online.php
#
####################################################################

use strict;
use warnings;

print time();
print $_ . "\n"; # eol perl
print localtime();
print $_ . "\n";
print gmtime();
print $_ . "\n";


use POSIX qw(strftime);
print strftime "%H:%M:%S %Y", localtime(); # 13 uhr localtime
print $_ . "\n";
print strftime "%H:%M:%S %Y", gmtime(); # 11 uhr gm
print $_ . "\n";
print strftime "%H", gmtime();
print $_ . "\n";

my $hour = strftime "%H", gmtime();

if( $hour > 7 && $hour < 20) {
    print "we are in interval 8 - 20";
}
else{
    # do something
}



####################################################################
#   How do I find the length of a string in perl?
#   http://www.perlmonks.org/?node_id=1971
####################################################################

use bytes;
my $len = bytes::length($string);

####################################################################
#   Greater Than, Greater Than or Equal To in perl
####################################################################

#https://www.thoughtco.com/comparison-operators-compare-values-in-perl-2641145
#http://www-cgi.cs.cmu.edu/afs/cs/user/rgs/mosaic/pl-exp-op.html
#http://www.perlmonks.org/?node_id=990
#http://perldoc.perl.org/functions/sort.html
#https://www.tutorialspoint.com/perl/string_equality_operators_example.htm



##########################################################
#
#   Perl colos
#   https://perldoc.perl.org/Term/ANSIColor.html
#   http://www.perlmonks.org/?node_id=509827
#
##########################################################

  # 1;30 green
  # 1;31 pink
  # 1;32 green
  # 1;33 yellow
  # 1;34 blue
  # 1;35 pink white
  # 1;36 bluesky
  # 1;37 white

  # 40;39m - black/white - bg/fg
  # 41;39m - -pink/white - bg/fg
  # 42;39m - green/white - bg/fg
  # 43;39m - woody/white - bg/fg
  # 44;39m - -blue/white - bg/fg
  # 45;39m - --red/white - bg/fg
  # 46;39m - blsky/white - bg/fg
  # 47;39m - -grey/white - bg/fg


# perl join string
# https://alvinalexander.com/perl/edu/articles/pl010003.shtml
# https://perlmaven.com/string-operators


#The Perl String Length() Function
# https://www.thoughtco.com/perl-string-length-function-quick-tutorial-2641189

#!/usr/bin/perl
my $orig_string = "This is a Test and ALL CAPS";
my $string_len =  length( $orig_string );
print "Length of the String is : $string_len\n";
my @many_strings = ("one", "two", "three", "four", "hi", "hello world");
say scalar @many_strings;




#---------------------------------------------------
# Find perl executing script/path [closed]
#---------------------------------------------------
# https://jmorano.moretrix.com/2014/05/monitor-running-processes-with-perl/
# https://stackoverflow.com/questions/11273636/check-if-program-is-running-and-run-it-if-not-in-perl
# https://www.perlmonks.org/?node_id=217166
# https://metacpan.org/pod/Proc::Find
# https://stackoverflow.com/questions/9539316/find-perl-executing-script-path
#---------------------------------------------------

# Working!
# ps -ef | grep perl  # /usr/bin/perl -w /usr/sbin/path
# ps fxa | grep perl

# ps ax | grep name # 26443 pts/3    S+     0:00 grep --color=auto perl
# pgrep name


use Proc::Find qw(find_proc proc_exists);
# list all of a user's processes
my $procs = find_proc(user=>'ujang', detail=>1);
# check if a program is running
die "Sorry, xscreensaver is not running"
    unless proc_exists(name=>'xscreensaver');