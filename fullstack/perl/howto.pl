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


####################################
#
# perl get user pwd
#
####################################

# https://github.com/search?l=Perl&q=getpwuid&type=Code
# http://pubs.opengroup.org/onlinepubs/009696799/functions/getpwuid.html
# http://learnperl.scratchcomputing.com/tutorials/getting_started/

# print info in terminal
# perl -le 'print scalar getpwuid $<'
# perl -le 'print scalar getpwuid $<'


my $homedir = (getpwuid($<));
print $homedir;

sub getpwuid {
    usage "getpwuid(uid)" if @_ != 1;
    getpwuid($_[0]);
}
1;

print scalar getpwuid $<
my $login = getlogin() || (getpwuid($<))[0] || "Intruder!!";
print $login;








#--------------------------------------------------
###########################################
#perl vars and ENV vars Subroutine
###########################################

=head ##your code to comment

http://perl-seiten.privat.t-online.de/html/perl_spevar.html
https://learn.perl.org/docs/keywords.html
http://perldoc.perl.org/perlvar.html
http://www.cgi101.com/book/ch2/text.html
http://www.ntu.edu.sg/home/ehchua/programming/webprogramming/Perl2_Regexe.html
http://jkorpela.fi/perl/regexp.html
https://perldoc.perl.org/perlvar.html
http://www-cgi.cs.cmu.edu/afs/cs/user/rgs/mosaic/pl-data.html
https://perldoc.perl.org/search.html?q=Id
https://perldoc.perl.org/Pod/Simple/Search.html
https://python-redmine.com/resources/version.html
https://www.tutorialspoint.com/perl/perl_subroutines.htm
http://www.tutorialspoint.com/perl/perl_oo_perl.htm
https://perldoc.perl.org/perlobj.html
https://www.tutorialspoint.com/perl/perl_arrays.htm
https://perlmaven.com/array-references-in-perl
https://perlmaven.com/perl-arrays

=cut

#!/usr/bin/perl
use strict;
use warnings;

=for comment

$0 ($PROGRAM_NAME)
$^O ($OSNAME)
$$ ($PROCESS_ID)
$< ($REAL_USER_ID,$UID)
$? ($CHILD_ERROR)
$@ ($EVAL_ERROR)


getppid - get parent process ID
getpwuid - get passwd record given user ID
getgrgid - get group record given group user ID
waitpid - wait for a particular child process to die
shmget - get SysV shared memory segment identifier
wantarray - get void vs scalar vs list context of current subroutine call

=cut

my $foo = 1; # string
my @colors = ("red","green","blue"); # array
# Hashes
my %colors = (  "red",   "#ff0000",
                "green", "#00ff00",
                "blue",  "#0000ff",
                "black", "#000000",
                "white", "#ffffff"
            );


$hash = {
     'Man' => 'Bill',
     'Woman' => 'Mary',
     'Dog' => 'Ben'
};

#!/usr/bin/perl
# Function definition
sub Average {
   # get total number of arguments passed.
   $n = scalar(@_);
   $sum = 0;
   foreach $item (@_) {
      $sum += $item;
   }
   $average = $sum / $n;
   return $average;
}
# Function call
$num = Average(10, 20, 30);
print "Average for the given numbers : $num\n";



##############################################################################
#
#	Unsuccessful stat on filename containing newline at
#       /usr/share/perl5/XML/Simple.pm line 927, <DATA> line 1 (#1)
#    (W newline) A file operation was attempted on a filename, and that
#    operation failed, PROBABLY because the filename contained a newline,
#    PROBABLY because you forgot to chomp() it off.  See perlfunc/chomp.
#
#   Unsuccessful stat on filename containing newline at
#        /usr/share/perl5/XML/Simple.pm line 940, <DATA> line 1 (#1)
#
##############################################################################

#############################################################################
#
#	Malformed xref in PDF file  at
#	C:/Perl/site/lib/PDF/API3/Compat/API2/Basic/PDF/File.pm line 1198
#
#	Malformed xref in PDF file  at /usr/lib/perl5/site_perl/5.8.8/PDF/API2/Basic/PDF/File.pm
#	line 1198.
#
#	Malformed xref in PDF file at
#	/opt/local/perl5/5.8.6-thread/lib/site_perl/5.8.6/PDF/API2/Basic/PDF/File.pm line 1238.
#
#	bug in GS-ESP 8.15.3, making it unusable for some PDF
#	files. I falsely assumed that PDF::API2 was the culprit, but I can
#	reproduce this without using PDF::API2 at all. Or it could be caused the the version of Adobe (Adobe 9 #   seems to give some people this error) that created it.
#
# 	PDF Does :: API2 Unterstützung PDF 1.5+ mit Druck XRef zu lesen
#
##############################################################################

#   https://metacpan.org/pod/distribution/PDF-OCR2/lib/PDF/OCR2.pod####
#   https://imagemagick.org/script/formats.php
#   http://imager.perl.org/docs/Imager/Files.html
#   https://metacpan.org/pod/distribution/Imager/lib/Imager/Files.pod
#   https://stackoverflow.com/questions/6800886/does-pdfapi2-support-reading-pdf-1-5-with-compressed-xref
#   https://www.apt-browse.org/browse/debian/wheezy/main/all/libpdf-api2-perl/2.019-1+deb7u1/file/usr/share/perl5/PDF/API2/Basic/PDF/File.pm
#   https://github.com/ssimms/pdfapi2/blob/master/lib/PDF/API2/Basic/PDF/File.pm
#   https://stackoverrun.com/de/q/1717543
#   https://metacpan.org/pod/PDF::OCR2

# FIX? PDF version > 1.5
gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -o out.pdf in.pdf

##############################################################################
#
#	Cannot create image mask for file
#
##############################################################################

#   http://imager.perl.org/docs/Imager/Files.html
#   https://metacpan.org/pod/Wx::Perl::Imagick
#   https://docstore.mik.ua/orelly/linux/cgi/ch13_02.htm
#   https://imagemagick.org/script/formats.php
#   https://imagemagick.org/script/perl-magick.php
#   http://imagemagick.sourceforge.net/http/www/perl.html


######################################################################
#
#   Unsuccessful stat on filename containing newline
#   means that you have a filename containing a newline. Which is perfectly explainable, because#
#
#   https://stackoverflow.com/questions/2652261/why-does-perl-complain-about-unsuccessful-stat-on-filename-containing-newline
#   https://www.perlmonks.org/?node_id=671517
#
######################################################################

#According to perldiag if any file operation fails and the filename happens to contain a newline character, the warning "Unsuccessful on filename containing newline" will be emitted.
#The assumption is that, as you say, the filename has come from standard input or similar, and the user has forgotten to chomp the newline away. You might want to pass the string through chomp anyway, just to see if it works.
#There is some evidence that &CORE::stat mtime might be broken with some combinations of OS patchlevel and ActiveState Perl versions - a suggested workaround is to use the File::stat module like so:

#my $sb = stat($File::Find::name);
#my $mtime = scalar localtime $sb->mtime;
#...you might find File::stat's object representation to be more convenient than the list returned by CORE::stat.




######################################################################
#
#   The Perl “else if” syntax (elsif)
#   https://alvinalexander.com/blog/post/perl/perl-if-else-elsif-syntax-example
#
######################################################################

if ($condition1)
{
  # do something
}
elsif ($condition2)
{
  # do something else
}
elsif ($condition3)
{
  # yada
}
else
{
  # do the 'else' thing
}

######################################################################
#
#   Perl’s numeric and string comparison operators
#
######################################################################

=head ## your code to comment

                           Numeric Test      String Test
Equal                           ==                eq
Not equal                       !=                ne
Less than                       <                 lt
Greater than                    >                 gt
Less than or equal to           <=                le
Greater than or equal to        >=                ge

=cut


######################################################################
#
# Regex simple
#
######################################################################

# https://perldoc.perl.org/perlre.html
# http://kirste.userpage.fu-berlin.de/chemnet/use/suppl/perl-regex.html
# https://perlmaven.com/regex
# https://www.tutorialspoint.com/perl/perl_regular_expressions.htm
# https://alvinalexander.com/perl/perl-uppercase-lowercase-string-case
# https://perldoc.perl.org/functions/lc.html

if ( lc($string) =~ /jpg$/ ){
    # jpg
}
elsif ( lc($string) =~ /png$/ ){
    # png
}
else{
    # other formats
}






######################################################################
# PERL Regular-Expressions
######################################################################
#https://www.regextester.com/95174
#https://www.regextester.com/
#https://perldoc.perl.org/perlre.html#Regular-Expressions

if ($file =~ /\.zip$/i) { ... }
if ($file =~ m/.zip/) { ... }
$foo =~ m/abc/
$foo =~ m<abc>
$foo =~ m/this|that/
$foo =~ m/this\|that/
$foo =~ m/fee|fie|foe|fum/
$foo =~ m/th(is|at) thing/

https://docstore.mik.ua/orelly/perl/cookbook/ch09_11.htm
https://perldoc.perl.org/File/Basename.html
https://stackoverflow.com/questions/3940412/how-can-i-check-the-extension-of-a-file-using-perl
https://alvinalexander.com/blog/post/perl/how-process-every-file-directory-matches-pattern

use File::Basename;
my @exts = qw(.txt .zip);
while (my $file = <DATA>) {
  chomp $file;
  my ($name, $dir, $ext) = fileparse($file, @exts);
  given ($ext) {
    when ('.txt') {
      say "$file is a text file";
    }
    when ('.zip') {
      say "$file is a zip file";
    }
    default {
      say "$file is an unknown file type";
    }
  }
}



######################################################################
#debug a Perl script
######################################################################
#http://padre.perlide.org/features/perl5-debugger.html
#http://perl.mines-albi.fr/DocFr/perldebug.html
#http://www.drdobbs.com/using-the-perl-debugger/184404744
#http://www.linux-magazin.de/ausgaben/2005/04/humpeln-zur-diagnose/
#https://docstore.mik.ua/orelly/perl/prog3/ch20_01.htm
#https://perldoc.perl.org/perldebug.html
#https://perldoc.perl.org/perldebug.html#Debugger-Commands
#https://users.cs.cf.ac.uk/Dave.Marshall/PERL/node152.html
#https://www.cs.cmu.edu/afs/cs/usr/rgs/mosaic/pl-debug.html
#https://www.cs.huji.ac.il/labs/parallel/Docs/Perl/pod/perldebug.html
#https://www.perl.com/pub/2004/08/09/commandline.html/
######################################################################
#!/usr/bin/perl -w
use v5.14;
use strict;
use warnings;
use diagnostics -verbose;
use diagnostics;
enable  diagnostics;
disable diagnostics;

perl -e 'print "Hello World\n"' # executed
perl -n -e 'some code' file1 # loop

perl -d your_script.pl args
perl -d:DebugHooks::Terminal script.pl
perl -d:Trepan script.pl
perl -d -e 42
perl -d -e "1;"
perl -w -d 08lst08.pl

PERL5DB="sub DB::DB { print $var }" perl -d your-script
#sudo perl -MCPAN -e 'install Devel::Trace'
perl -d:Trace myscript.pl
perl -V myscript.pl


######################################################################
#
#   https://www.tutorialspoint.com/execute_perl_online.php
#
######################################################################

$sFile = "somefile.JPG";
if( lc($sFile) =~ m/.jpg/i ){
    print "match 1 JPG\n";
}
if( lc($sFile) =~ /.jpg$/ ){
    print "match 2 JPG\n";
}


#########################################################
#
#	operators logical PERL Python
#
#########################################################

#https://www.tutorialspoint.com/perl/perl_operators.htm
#https://www.programiz.com/python-programming/operators#logical


#########################################################
#
#   PERL rename vs copy
#
#########################################################

#https://perldoc.perl.org/functions/rename.html
#https://perlmaven.com/how-to-remove-copy-or-rename-a-file-with-perl
#http://perldoc.perl.org/File/Copy.html

use File::Copy;
copy("sourcefile","destinationfile") or die "Copy failed: $!";
copy("Copy.pm",\*STDOUT);
move("/dev1/sourcefile","/dev2/destinationfile");





################################################
#
#Perl eval
#
#https://perldoc.perl.org/functions/eval.html
################################################

# a private exception trap for divide-by-zero
    eval { local $SIG{'__DIE__'}; $answer = $a / $b; };
    warn $@ if $@;



################################################
#
#Perl Command-Line Options
#
#https://www.perl.com/pub/2004/08/09/commandline.html/
#https://perlmaven.com/perl-command-line-options
#
################################################

#!/usr/bin/perl

perl -v
perl -V
#-e execute code on the command line
perl -e 'print qq{Hello World\n}'


################################################
#
#   Perl unless Statement
#
#   https://www.thoughtco.com/telling-if-file-exists-in-perl-2641090
#   https://www.tutorialspoint.com/perl/perl_unless_statement.htm
#
################################################


#!/usr/bin/perl
$filename = '/path/to/your/file.doc';
if (-e $filename) {
    print "File Exists!";
}

unless (-e $filename) {
    print "File Doesn't Exist!";
}


################################################
#
#   perl check File exists
#   https://perlmaven.com/file-test-operators
#
################################################

=head

-r File is readable by effective uid/gid.
-w File is writable by effective uid/gid.
-x File is executable by effective uid/gid.
-o File is owned by effective uid.
-R File is readable by real uid/gid.
-W File is writable by real uid/gid.
-X File is executable by real uid/gid.
-O File is owned by real uid.
-e File exists.
-z File has zero size (is empty).
-s File has nonzero size (returns size in bytes).
-f File is a plain file.
-d File is a directory.
-l File is a symbolic link (false if symlinks aren't supported by the file system).
-p File is a named pipe (FIFO), or Filehandle is a pipe.
-S File is a socket.
-b File is a block special file.
-c File is a character special file.
-t Filehandle is opened to a tty.
-u File has setuid bit set.
-g File has setgid bit set.
-k File has sticky bit set.
-T File is an ASCII or UTF-8 text file (heuristic guess).
-B File is a "binary" file (opposite of -T).
-M Script start time minus file modification time, in days.
-A Same for access time.
-C Same for inode change time (Unix, may differ for other platforms)

=cut