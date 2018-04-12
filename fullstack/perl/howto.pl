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
