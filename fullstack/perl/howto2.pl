
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



################################################
# Using Imagemagick
################################################

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
