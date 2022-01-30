<?php /** @noinspection DuplicatedCode */

# Generate wav tone in PHP - Stack Overflow
# https://stackoverflow.com/questions/28053226/generate-wav-tone-in-php

try {

    for ($i = 0; $i < 30; $i++) {

        $freqOfTone = random_int(60, 600); // tone
        $sampleRate = 44100; // rate
        $samplesCount = random_int(40000, 80000); // length

        $amplitude = 0.25 * 32768;
        $w = 2 * M_PI * $freqOfTone / $sampleRate;
        #$w = 2 * pi() * $freqOfTone / $sampleRate;

        $samples = array();
        for ($n = 0; $n < $samplesCount; $n++) {
            $samples[] = (int)($amplitude * sin($n * $w));
        }

        $srate = 44100; //sample rate
        $bps = 16; //bits per sample
        $Bps = $bps / 8; //bytes per sample /// I EDITED

        $str = pack(...array_merge(array("VVVVVvvVVvvVVv*"),
            array( //header
                0x46464952, //RIFF
                160038, //File size
                0x45564157, //WAVE
                0x20746d66, //"fmt " (chunk)
                16, //chunk size
                1, //compression
                1, //nchannels
                $srate, //sample rate
                $Bps * $srate, //bytes/second
                $Bps, //block align
                $bps, //bits/sample
                0x61746164, //"data"
                160000, //chunk size
            ),
            $samples //data
        ));
        $myfile = fopen("gen/sine" . $i . ".wav", "wb") or die("Unable to open file!");
        fwrite($myfile, $str);
        fclose($myfile);

    }
} catch (Exception $exception) {

}
