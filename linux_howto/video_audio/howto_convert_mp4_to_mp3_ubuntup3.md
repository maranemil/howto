### Install ImageMagick
`brew install ImageMagick`

https://gist.github.com/protrolium/21ab48468470ea8e3a72567fd8938abe

### Pull specific region of frames from video file w/ ffmpeg
`ffmpeg -ss 14:55 -i video.mkv -t 5 -s 480x270 -f image2 %04d.png`
- -ss 14:55 gives the timestamp where I want FFmpeg to start, as a duration string.<br>
- -t 5 says how much I want FFmpeg to decode, using the same duration syntax as for -ss.<br>
- -s 480x270 tells FFmpeg to resize the video output to 480 by 270 pixels.<br>
- -f image2 selects the output format, a series of still images — *make sure there are leading zeros in filename*.<br>

### Resize series of images
`convert *.png -resize 70% newname%02d.png`

### Convert mutliple filetype(s) into animated gif
`convert -delay 10 -loop 0 *.png anim.gif`<br>
`convert -fuzz 1% -delay 1x8 *.png -coalesce -layers OptimizeTransparency animation.gif`<br>
<br>
- -fuzz tells ImageMagick to treat pixels whose color values differ by less than 1% as the same color, giving the OptimizeTransparency action more pixels to chop away.<br>
- -delay 1x8 says that the animation should play a frame every 1/8 of a second.<br>
- -layers OptimizeTransparency tells ImageMagick to replace portions of each frame that are identical to the corresponding parts of the preceding frame with transparency, saving on file size.<br>

`convert -fuzz 1% -delay 10 -loop 0 *.png -coalesce -layers OptimizeTransparency animation.gif`<br>
<br>
**hypervoid force sizing + optimization**:<br>
`convert -resize '1920x350!' -delay 5 -loop 0 *.png hv.gif`<br>
`convert -fuzz 3% -resize '1920x350!' -delay 5 -loop 0 -coalesce -layers OptimizeTransparency *.png an.gif`<br>
<br>this test yielded impressive reduction:<br>
`convert -filter Triangle -define filter:support=2 -thumbnail 1920 -delay 5 -loop 0 -unsharp 0.25x0.08+8.3+0.045 -dither None -posterize 136 -quality 82 -define jpeg:fancy-upsampling=off -define png:compression-filter=5 -define png:compression-level=9 -define png:compression-strategy=1 -define png:exclude-chunk=all -interlace none -colorspace sRGB *.png output.gif`
<br>
<br>
another version with less color information<br>
`convert -filter Triangle -define filter:support=2 -thumbnail 1920 -delay 5 -loop 0 -unsharp 0.25x0.08+8.3+0.045 -dither None -posterize 136 -quality 82 -define jpeg:fancy-upsampling=off -define png:compression-filter=5 -define png:compression-level=9 -define png:compression-strategy=1 -define png:exclude-chunk=all -interlace none -colorspace sRGB -colors 32 -ordered-dither o8x8,8,8,8,4 +map *.png output.gif`

### convert GIF into movie by extracting frames and recompiling
`convert -coalesce some.gif some%05d.png`<br>
extract gif frames

`ffmpeg -i some%05d.png some.mov`<br>
converting image sequence in QuickTime 7 worked more effectively than the above command

`rm some*.png`<br>
clear extracted frames

### Pull apart GIF
`convert -coalesce animation.gif target.png`

### Cropping / Batch Crop
If you want the crop rectangle to start at top corner X: 50 Y: 100 and the crop rectangle to be of size W: 640 H:480, then use the command:<br>
`$ mogrify -crop 640x480+50+100 foo.png`
<br>
<br>
To write the cropped image to a new file:<br>
`$ convert foo.png -crop 640x480+50+100 out.png`
<br>
<br>
batch conversion:<br>
`for i in *.png; do convert "$i" -crop 1920x248+0+400 "${i%.png}-cropped.png"; done`<br>

- - -

[more information](http://imagemagick.org/script/convert.php) about the `convert` command<br>
[and here](https://room208.org/blog/posts/48793543478.html)<br>
[and here](https://www.smashingmagazine.com/2015/06/efficient-image-resizing-with-imagemagick/)















#######################################################################

Basic Use
https://github.com/antiboredom/automating-video/blob/master/FFMPEG.md

#######################################################################



Converting from one format to another:
ffmpeg -i input.mp4 output.avi

Turning a video into a gif:
ffmpeg -i input.mp4 output.gif

Turning a video into choppier but smaller gif: (-r 3 will make it 3 frames per second)
ffmpeg -i input.mp4 -r 3 output.gif

Extracting the audio:
ffmpeg -i input.mp4 audio.mp3

Extracting frames from a video:
ffmpeg -i input.mp4 frame%d.jpg

Turning a series of images into a video:
ffmpeg -f image2 -i image%d.jpg video.mp4

Increasing the speed of a video:
ffmpeg -i input.mp4 -vf "setpts=0.5*PTS" fastvideo.mp4

Slowing it down:
ffmpeg -i input.mp4 -vf "setpts=2.0*PTS" slowvid.mp4

Resize a video:
ffmpeg -i input.mp4 -c:v libx264 -s:v 100x100 -c:a copy output.mp4

Extracting a portion of a video: (this will get five seconds, starting at 1 minute and 30 seconds)
ffmpeg -ss 00:01:30 -i input.mp4 -c:v copy -c:a copy -t 5 output.mp4

More complex stuff

Making a mirror effect:
ffmpeg -i input.mp4 -vf "crop=iw/2:ih:0:0,split[left][tmp];[tmp]hflip[right];[left][right] hstack" output.mp4

Edge detection:
ffmpeg -i input.mp4 -vf "edgedetect=low=0.1:high=0.4" output.mp4
Fading in:

ffmpeg -i input.mp4 -vf "fade=in:0:30" output.mp4















#######################################################################

Example ffmpeg commands
http://randombio.com/linuxsetup141.html

#######################################################################

Extract frames from a movie
This example extracts the first 2 seconds of a movie in video21.wmv into individual image files.
The files will be called img-0001.png, img-0002.png, img-0003.png, etc. It is best to do this in a separate directory.
ffmpeg -i video21.wmv -r 30 -t 2 -f image2 img-%04d.png

For wmv files it's sometimes necessary to specify the frame rate, in this case 30 (-r 30).
 The parameter '-f image2' means the input movie is in "image2" format; normally it's not necessary to specify it, but if it's not automatically detected,
 or if the extension is wrong, it may be needed.

Combine individual frames into a movie
Create an MP4 movie from JPEG files with filenames 001.jpg, 002.jpg, etc. This example creates an mp4 with 10 frames per second and 1800 kbps.
ffmpeg -r 10 -b 1800 -i %03d.jpg test.mp4
The %3d is 'C' language notation for a 3-digit integer. Don't put a percent sign or a 'd' in the filename.

This example creates an mpeg at the default rate (25 fps, 200 kbps).
ffmpeg -i %03d.jpg test.mpeg
Sometimes you have to set the bitrate to get a good quality movie.
ffmpeg -b 4000 -i frame-%5d.jpg test.mpeg

Changing image file format
Sometimes you want to convert the files into JPEGs first. This script will do the conversion and change the extension of each file from .png to .jpg.
for f in *png ; do convert -quality 100 $f `basename $f png`jpg; done

Find what file formats are supported
ffmpeg -formats

Get help
ffmpeg -h

Convert movie from WMV to mp4 format
Ffmpeg determines what file format you want by the extension. If your input file doesn't have the right extension, bad things will happen.
ffmpeg -i video04.wmv -f mp4 -strict -2 -t 5 a.mp4
ffmpeg -i output2.avi -strict -2 test.mp4

Resize a movie
Resize a movie input.avi to 640 × 480 pixels. An AVI file titled output.avi is produced.
ffmpeg -i input.avi -vf scale=640:480 output.avi

Crop a movie

ffmpeg -i input.avi -vf crop=100:110:200:80 output.avi
ffmpeg -i input.avi -vf crop=in_w:in_h/2:in_w:in_h/2 output.avi

The parameters are x:y:width:height in pixels. The first command tries to create a 200×80 image, but ffmpeg will change
this to the correct movie aspect ratio. The second command saves only the bottom half of your movie.

Cut a section from a movie
Cut a section out of the movie, saving only the five seconds between 70 and 75.

ffmpeg -i input.avi -ss 00:01:10 -t 00:00:05 -c:v copy -c:a copy output.avi

The -c:v copy -c:a copy option makes it faster by copying the video and audio instead of decoding and re-encoding them.
 You could also use -vf trim=70:75, but this doesn't re-set the time stamp, so viewers will just see a black screen for
 the first 70 seconds. Supposedly the setpts filter can fix this, but I couldn't get it to work.

Retrieving metadata from a movie
Reads metadata and prints it on the screen. As with all ffmpeg commands, there are many options (man ffprobe). ExifTool
 gives a lot more information.

ffprobe DSC_6881.MOV Metadata:
major_brand : qt
minor_version : 537331968
compatible_brands: qt niko
creation_time : 2015-06-09 01:10:21
Duration: 00:01:41.35, start: 0.000000, bitrate: 18896 kb/s
Stream #0:0(eng): Video: h264 (High) (avc1 / 0x31637661), yuvj420p(pc, bt470bg/unknown/bt470m), 1920x1080 [SAR 1:1 DAR 16:9], 17339 kb/s, 23.98 fps, 23.98 tbr, 24k tbn, 47.95 tbc (default)
Metadata:
creation_time : 2015-06-09 01:10:21
Stream #0:1(eng): Audio: pcm_s16le (sowt / 0x74776F73), 48000 Hz, 2 channels, s16, 1536 kb/s (default)
Metadata:
creation_time : 2015-06-09 01:10:21

Filtering a movie

It is possible to split a movie into frames, process each individual frame in an image analysis program, and then re-assemble
 it into a movie. But this gets tedious after the first few hundred thousand frames.

Brightening, changing the gamma, inverting, and many other functions are available in ffmpeg through the filter option.
 Filtering uses the -vf option followed by a series of commands. They can be very simple:

To resize a movie to 320 × 240 pixels:
ffmpeg -i input.avi -vf scale=320:240 output.avi

To invert the colors in a movie:
ffmpeg -i output2.avi -vf lutrgb="r=negval:g=negval:b=negval" output3.avi

To increase brightness by a factor of four:
ffmpeg -i output2.avi -vf lutyuv=y=val*4 output3.avi

To increase red by a factor of two:
ffmpeg -i output2.avi -vf lutrgb=r=val*2 output3.avi

To increase gamma by factor of 5:
ffmpeg -i output2.avi -vf 'lutyuv=y=gammaval(0.2)' output3.avi
The quotes are needed to prevent the shell from messing with the command.

To rotate a movie by 45 degrees:
ffmpeg -i output2.avi -vf rotate=45 output3.avi

The sharpen, blur, or sharpen a movie:
ffmpeg -i output2.avi -vf unsharp output3.avi
ffmpeg -i output2.avi -vf unsharp=7:7:-2:7:7:-2 output3.avi
ffmpeg -i output2.avi -vf unsharp=5:5:1.5:5:5:0.0 output3.avi

The defaults for unsharp are 5:5:1.0:5:5:0.0.
1st = kernel of luma filter x size (odd 3 to 63)
2nd = kernel of luma filter y size (odd 3 to 63)
3rd = amount of luma filtering (−1.5 to 1.5 but can be any number); negative=blur, positive=sharpen
4th = kernel of chroma filter x size (odd 3 to 63)
5th = kernel of chroma filter y size (odd 3 to 63)
6th = amount of chroma filtering (−1.5 to 1.5 but can be any number); negative=blur, positive=sharpen

To draw a box or grid on the movie:
ffmpeg -i output2.avi -vf drawbox=x=10:y=20:w=200:h=60:color=red@0.5 output3.avi

ffmpeg -i output2.avi -vf drawgrid=width=100:height=100:thickness=2:color=red@0.5 output3.avi

More complex filters
Filters can also be very complex. Many seemingly simple operations require splitting the processing stream.
This example crops and flips half of the image. This information is from the man page (man ffmpeg-filters).

               [main]
     input --> split ---------------------> overlay --> output
                 |                             ^
                 |[tmp]                  [flip]|
                 +-----> crop --> vflip -------+
The input is split into two streams. One stream goes through the crop filter and the vflip filter,
 and is then merged back with the other stream by overlaying it on top. The start and end of each path
  require labels enclosed in square brackets. All these commands go on a single line, not broken up as shown here.

ffmpeg -i inputmovie -vf "split [main][tmp]; [tmp] crop=iw:ih/2:0:0, vflip [flip]; [main][flip] overlay=0:H/2" outputmovie

Here are some examples of filtering. The first one uses the YUV look-up table filter to multiply the luminance
by a factor of 5, which can be useful for making extremely dark images brighter. There are also commands for changing the gamma and contrast.

ffmpeg -i DSC_6881.MOV -vf "split [main][tmp]; [tmp] lutyuv="y=val*5" [tmp2]; [main][tmp2] overlay" output.avi

This example raises the gamma. In ffmpeg, a value less than 1.0 makes dark areas lighter and a value above 1.0 makes them darker, which is the opposite of what you'd expect:
ffmpeg -i DSC_6881.MOV -vf "split [main][tmp]; [tmp] lutyuv=y=gammaval(0.6) [tmp2]; [main][tmp2] overlay" output.avi

The RGB look-up table filter is similar, and allows you to do stuff to the red, green, and blue channels separately. In this case we invert them to make a negative image.

ffmpeg -i DSC_6887.MOV -vf "split [main][tmp]; [tmp] lutrgb="r=negval:g=negval:b=negval" [tmp2]; [main][tmp2] overlay" output.avi

This example denoises an AVI file. This helps reduce those rectangular compression artifacts.
ffmpeg -i output2.avi -vf "split [main][tmp]; [tmp] dctdnoiz=4.5 [tmp2]; [main][tmp2] overlay" output3.avi

There are numerous other options, such as deshake, delogo, drawtext, fade, lens correction, rotate, subtitles, and fft
filter. Some I could get to work and some, like drawtext, I couldn't, and some take a very long time to run.

Combining filters
You can put many filters together in the same command. The following rules apply:

If the filter takes more than one parameter, separate parameters by colons. Ex: unsharp=7:7:-2:7:7:-2
To put two or more filters together, separate them by commas. But watch out: spaces are not allowed. If you use spaces, the whole thing has to be inside quotes.

Bad:
ffmpeg -i input.mov -vf scale=480:270, lutyuv=y=val*4, lutyuv=y=gammaval'(2.0)' output2.avi

Good:
ffmpeg -i input.mov -vf "scale=480:270, lutyuv=y=val*4, lutyuv=y=gammaval(2.0)" output2.avi

Good:
ffmpeg -i input.mov -vf scale=480:270,lutyuv=y=val*4,lutyuv=y=gammaval'(2.0)' output2.avi
If a filter contains '(', ')', ';' or some other command that's used by the shell, you have to enclose it in single or double quotes.
If you use the wrong syntax, it will print an error message. Pay no attention to what it says—it is often wrong.