
################################################
# GET (Unique Colors + Width + Height + Type) by CMD
################################################


=head

# cmd 1
identify -verbose -unique red.jpg | grep -e 'Colors:' -e 'Type:' -e 'ExifImageLength' -e 'ExifImageWidth'

Type: TrueColor
Colors: 329324
exif:ExifImageLength: 1288
exif:ExifImageWidth: 2296
exif:SceneCaptureType: 0
exif:SceneType: 1


# cmd2
identify -format "%[EXIF:ExifImageWidth]\n%[EXIF:ExifImageLength]\n%[type]\n%k\n" red.jpg

2296
1288
TrueColor
329324

Single Letter Attribute Percent Escapes
https://imagemagick.org/script/escape.php
https://imagemagick.org/script/identify.php
https://imagemagick.org/script/command-line-options.php
https://imagemagick.org/script/identify.php
https://imagemagick.org/script/identify.php
https://imagemagick.org/script/perl-magick.php

=cut



#######################################################################
#
#   Using Imagemagick
#
#######################################################################

#!/usr/local/bin/perl -w
#!/usr/bin/perl
use warnings;
use strict;
use Image::Magick;
use Data::Dumper;

my $Image_Magick = Image::Magick->new();
my $leh = "red.jpg";
$Image_Magick->ReadImage($leh);
print "height: " . $Image_Magick->Get('height'). "\n";
print "width: " . $Image_Magick->Get('width'). "\n";
print "type: " . $Image_Magick->Get('type'). "\n";
print "colors: " . $Image_Magick->Get('colors');
print Dumper($Image_Magick);


=head

http://zaachi.com/2013/10/08/image-search-by-color-php-part1.html
https://php.net/manual/de/imagick.getimageproperties.php
https://docs.opencv.org/2.4/doc/tutorials/imgproc/histograms/histogram_calculation/histogram_calculation.html
https://code.likeagirl.io/finding-dominant-colour-on-an-image-b4e075f98097
https://www.pyimagesearch.com/2014/08/04/opencv-python-color-detection/
https://www.pyimagesearch.com/2014/05/26/opencv-python-k-means-color-clustering/
https://board.phpbuilder.com/d/10355107-how-to-get-color-palette-from-images-using-php/6

http://perl-seiten.privat.t-online.de/html/perl_io.html
https://perldoc.perl.org/functions/print.html

https://www.php.net/manual/en/function.imagefill.php
https://imagemagick.org/script/color.php
https://www.php.net/manual/en/function.imagetypes.php
https://php.net/manual/en/function.imagecolorstotal.php
https://www.php.net/manual/de/function.imagecolormatch.php
https://imagemagick.org/script/identify.php
https://www.php.net/manual/en/imagick.getimagetype.php
https://gist.github.com/pehbehbeh/2417222
https://www.php.net/manual/en/function.imagecolorat.php
https://www.php.net/manual/en/function.imagecolorset.php
https://docs.w3cub.com/php/imagick.getimagetype/
https://www.javatips.net/api/com.sun.media.jai.codec.tifffield
https://github.com/emcconville/wand/issues/157
https://github.com/emcconville/wand/issues/155
http://docs.wand-py.org/en/0.5.4/guide/colorspace.html

=cut


#######################################################################
#
#   Classes and Objects in Perl
#
#######################################################################

=head
https://www.codesdope.com/perl-classes-and-objects/
https://perldoc.perl.org/perlobj.html
https://www.tutorialspoint.com/perl/perl_object_oriented.htm
http://wwwacs.gantep.edu.tr/docs/perl-ebook/ch19.htm
http://learnperl.scratchcomputing.com/tutorials/objects/
https://www.perltutorial.org/perl-oop/
https://metacpan.org/pod/perlootut
https://www.perl.com/article/25/2013/5/20/Old-School-Object-Oriented-Perl/
https://www.geeksforgeeks.org/perl-classes-in-oop/
https://www.manning.com/books/object-oriented-perl
https://metacpan.org/pod/Moose::Manual
https://metacpan.org/pod/Moose
=cut

#!/usr/bin/perl

use strict;
use warnings;
package Student;

#constructor
sub new{

  #the package name 'Student' is in the default array @_
  #shift will take package name 'student' and assign it to variable 'class'
  my $class = shift;

  #object
  my $self = {
    'name' => shift,
    'roll_number' => shift
  };

  #blessing self to be object in class
  bless $self, $class;

  #returning object from constructor
  return $self;
}

my $obj = new Student("Sam",01);
print "$obj->{'name'}\n";


#######################################################################
#
#   How can I determine the local machine's IP addresses from Perl?
#
#######################################################################

=head

https://stackoverflow.com/questions/330458/how-can-i-determine-the-local-machines-ip-addresses-from-perl
http://fseitz.de/blog/index.php?/archives/114-Perl-Hostname-zu-IP-Adresse-ermitteln.html
http://fseitz.de/blog/index.php?/archives/128-Perl-Erreichbarkeit-eines-Host-pruefen.html
https://www.perl-community.de/bat/poard/thread/19795
https://www.perlmonks.org/?node_id=44734
https://www.tutorialspoint.com/perl/perl_socket_programming.htm
https://docstore.mik.ua/orelly/perl2/prog/ch16_05.htm

=cut

# v1
use Sys::Hostname;
use Socket;
my($addr)=inet_ntoa((gethostbyname(hostname))[4]);
print "$addr\n";

# v2
use Net::Address::IP::Local;
# Get the local system's IP address that is "en route" to "the internet":
my $address      = Net::Address::IP::Local->public;

# v3
use Socket;
use Sys::Hostname;
my $hostname = hostname();
my     $name ='yahoo.com';
my       $ip = inet_ntoa(scalar(gethostbyname($name)) || 'localhost');
my     $myip = inet_ntoa(scalar(gethostbyname($hostname)));
print $ip, "\n", $myip;


#######################################################################
#
#   sleep in Perl
#   http://www.hidemail.de/blog/perl-sleep.shtml
#
#######################################################################

#!/usr/bin/perl
use strict;

print "Ich schlafe jetzt 10 Sekunden...\n";
sleep(10);
print "Nun bin ich wieder wach!\n";


#######################################################################
#
#   Read project path
#
#######################################################################

=head

how to get the exact full path to a file in perl - Stack Overflow
https://stackoverflow.com/questions/12291180/how-to-get-the-exact-full-path-to-a-file-in-perl
https://perldoc.perl.org/File/Basename.html
https://alvinalexander.com/perl/edu/articles/pl020002
https://alvinalexander.com/perl/edu/qanda/plqa00014
https://perldoc.perl.org/Env.html
https://perldoc.perl.org/perlvar.html#General-Variables
https://www.regular-expressions.info/perl.html
https://stackoverflow.com/questions/3440363/perl-use-s-replace-and-return-new-string/3440474
https://caveofprogramming.com/perl-tutorial/perl-replace-substring.html
https://stackoverflow.com/questions/84932/how-do-i-get-the-full-path-to-a-perl-script-that-is-executing/90721
https://stackoverflow.com/questions/4045253/converting-relative-path-into-absolute-path

=cut

#!/usr/bin/perl
use Cwd;

my $dir = getcwd;			# absolute path to current dir
use Cwd 'abs_path';
my $abs_path = abs_path($file);



#!/usr/bin/perl
use Cwd;
use Cwd 'abs_path';

print getcwd."\n";			# absolute path to current dir
print basename($0)."\n"; 	# current file name
print getcwd($0)."\n";		# absolute path to current dir
print abs_path($0)."\n";	# absolute path to current dir + basename(filename)
print __FILE__."\n";		# aka basename($0)


use File::Basename;
my $dirname = dirname(__FILE__); # current dir
print $dirname."\n";


use FindBin;
print "The actual path to this is: $FindBin::Bin/$FindBin::Script\n";
# absolute path to current dir + basename(filename)


use Cwd qw(abs_path);
my $path = abs_path($0); # absolute path to current dir + basename(filename)
print "$path\n";

#-------------------------------------------------
# read ENV
#-------------------------------------------------
print $ENV{'PATH'}; # env perl
foreach (sort keys %ENV) {
  print "$_  =  $ENV{$_}\n";
}


#-------------------------------------------------
# Get absolute path Project referenced to a file ***
#-------------------------------------------------

sub replace {
    my ($from,$to,$string) = @_;
    $string =~s/$from/$to/ig;                          #case-insensitive/global (all occurrences)
    return $string;
}

use Cwd;
use Cwd 'abs_path';
use File::Basename;
my $ABS_PATH = replace("current/path/file.pm","",abs_path(__FILE__));


#######################################################################
#
#	Read Ini Files
#
#######################################################################

=head

https://metacpan.org/pod/Config::IniFiles
https://stackoverflow.com/questions/2014862/how-can-i-access-ini-files-from-perl
https://code-maven.com/slides/perl-programming/solution-parse-ini-file
https://perlmaven.com/reading-configuration-files-in-perl
http://perl.mines-albi.fr/perl5.6.1/site_perl/5.6.1/Config/IniFiles.html
https://manpages.debian.org/stretch/libconfig-inifiles-perl/Config::IniFiles.3pm.en.html
https://www.codesdope.com/perl-classes-and-objects/
https://www.tutorialspoint.com/perl/perl_files.htm
https://www.tutorialspoint.com/perl/perl_object_oriented.htm
https://perldoc.perl.org/functions/open.html
https://perlmaven.com/open-and-read-from-files
https://perldoc.perl.org/perlobj.html
http://www.hidemail.de/blog/open-perl.shtml
https://perlmaven.com/trim

=cut

#!/usr/bin/perl
use strict;
use warnings;
use Data::Dumper qw(Dumper);
use Config::IniFiles;
my $cfg = Config::IniFiles->new( -file => "/path/configfile.ini" );
print "The value is " . $cfg->val( 'Section', 'Parameter' ) . "."
  if $cfg->val( 'Section', 'Parameter' );



#!/usr/bin/perl
use strict;
use warnings;
use Data::Dumper qw(Dumper);
use Config::Tiny;
$Config = Config::Tiny->read( 'file.conf' );
my $one = $Config->{section}->{one};
my $Foo = $Config->{section}->{Foo};



#!/usr/bin/perl
use strict;
use warnings;
use Data::Dumper qw(Dumper);
use Config::Tiny;
my $filename = shift or die "Usage: $0 filename\n";
open my $fh, '<', $filename or die "Could not open '$filename' $!";
my $data = Config::Tiny->read( $filename );
print Dumper $data;


#!/usr/bin/perl
my $searched_string;
my $key;
my $localConfig = "/path/to/file.txt";
open (FILE, $localConfig) or die "Can't open: $!";
#while(<FILE>) {
#    print "$_";
#}
while (<FILE>) {
    if ($_ =~ m"^searched_string") {
        ($key, $searched_string) = split(/=/, $_);
        #print "$_";
    }
}
close(FILE);
#while (defined($_ =<FILE>)) {
    #print "$_";
#}
$searched_string =~ s/^\s+|\s+$//g; # trim left right
#$this->{'searched_string'} = $searched_string;





###################################################
#
#	WARNING
#	Use of uninitialized value $fh in pattern match (m//) at /usr/share/perl5/Proc/PID/File.pm line 288.
#
#	Package:	 		Proc::PID::File
#	Installation: 		sudo apt-get install libproc-pid-file-perl
#	Get Pkg version: 	perl -MProc::PID::File -le 'print $Proc::PID::File::VERSION' # 1.27
#	Get Perl version:	perl -V
#
###################################################

=head
http://cpancover.com/latest/Proc-PID-File-1.29/blib-lib-Proc-PID-File-pm--branch.html
http://man7.org/linux/man-pages/man5/proc.5.html
http://manpages.ubuntu.com/manpages/trusty/man3/Proc::PID::File.3pm.html
http://perl.apache.org/docs/1.0/guide/guide
https://centos.pkgs.org/6/epel-i386/perl-Proc-PID-File-1.27-1.el6.noarch.rpm.html
https://centos.pkgs.org/7/epel-x86_64/perl-Proc-PID-File-1.27-9.el7.noarch.rpm.html
https://code.activestate.com/ppm/Proc-PID-File/
https://metacpan.org/pod/Proc::PID::File
https://metacpan.org/pod/release/NWETTERS/Proc-PID-File-1.3/File.pm
https://metacpan.org/pod/version
https://packages.debian.org/sid/perl/libproc-pid-file-perl
https://perldoc.perl.org/functions/require.html
https://perldoc.perl.org/functions/use.html
https://www.cyberciti.biz/faq/how-can-i-find-out-perl-version/
https://www.lemoda.net/perl/module-version/index.html
https://www.perl.com/article/1/2013/3/24/3-quick-ways-to-find-out-the-version-number-of-an-installed-Perl-module-from-the-terminal/
=cut

# TEST Pkg in terminal
# perl -MProc::PID::File -wE'die if Proc::PID::File->running({dir => "."})'
# perl -MProc::PID::File -wE'die if Proc::PID::File->running({dir => "/tmp", name =>"test.pl"})'

# usage
use warnings;
use strict;
use Data::Dumper;
use Proc::PID::File;
die("$0: Already running!\n") if (Proc::PID::File->running('dir' => '/tmp', name => $0 . '_' . basename($conf)));

# usage
use Proc::PID::File;
die "Already running!" if Proc::PID::File->running();

my $child1 = Proc::PID::File->new(name => "lock.1");
my $child2 = Proc::PID::File->new(name => "lock.2");

$do->something() if $child1->alive();
$child1->release();


###################################################
#
#   read argv + opts + read file
#
###################################################

#!/usr/bin/perl -w
# MSERGEANT / IO-KQueue-0.34 / examples / tail.pl

use IO::KQueue;
use Getopt::Std;

my $START = 10;
my %opts;

getopts('h', \%opts);
help() if $opts{h};
my $file = shift(@ARGV) || "-";
open(my $fh, $file) || die "$0: open($file): $!";

my @buf;
while (<$fh>) {
    $buf[$. % $START] = $_;
}

sub help {
    print <<EOT;
$0 [-h] [file]

Tail a file forever, like tail -F.
EOT
    exit(0);
}



###################################################
#
# Classes Packages Perl Dummy test
#
###################################################

=head
https://alvinalexander.com/blog/post/perl/how-to-traverse-loop-items-elements-perl-hash
https://perlmaven.com/perl-arrays
http://wwwacs.gantep.edu.tr/docs/perl-ebook/ch19.htm
https://www.geeksforgeeks.org/perl-classes-in-oop/
https://www.tutorialspoint.com/perl/perl_object_oriented.htm
https://perldoc.perl.org/perlobj.html
https://www.tutorialspoint.com/execute_perl_online.php
https://www.perl.com/article/perl-foreach-loops/
https://www.tutorialspoint.com/perl/perl_oo_perl.htm
https://users.cs.cf.ac.uk/Dave.Marshall/PERL/node123.html

=cut

package TestPkgClass1;
sub new{
    my $class = shift;
    my $self = {
      'string' => shift
    };
    bless $self, $class;
    return $self;
}

sub _initialize {
    my ($this,$value)  = @_;
    $this->{'string'} = $value;
    print ">> ". $this->{'string'}." \n";
}

my $o = new TestPkgClass1();
$o->_initialize('test1'); # set a string


package TestPkgClass2;
sub new{
    my ($class, %options)   = @_;
    while (($key, $value) = each (%options))
    {
        $value = $options{$key};
        print "  $key costs $value \n";
    }
    my $self = {
      'string' => shift
    };
    bless $self, $class;
    return $self;
}
sub _initialize {
    my ($this,$value)  = @_;
    $this->{'string'} = $value;
    print ">> ". $this->{'string'}." \n";
}

my @options = (1 => "Foo", 2=> "Bar", 3=> "Baz"); # set an array
my $o = new TestPkgClass2(@options);
$o->_initialize('test2'); # set a string







