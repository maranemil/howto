
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