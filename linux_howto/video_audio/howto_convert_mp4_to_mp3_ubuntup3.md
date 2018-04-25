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