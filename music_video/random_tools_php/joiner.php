<?php

// https://www.splitbrain.org/blog/2006-11/15-joining_wavs_with_php

function joinwavs($wavs)
{
    $fields = join('/', array('H8ChunkID', 'VChunkSize', 'H8Format',
        'H8Subchunk1ID', 'VSubchunk1Size',
        'vAudioFormat', 'vNumChannels', 'VSampleRate',
        'VByteRate', 'vBlockAlign', 'vBitsPerSample'));
    $data = '';
    foreach ($wavs as $wav) {
        $fp = fopen($wav, 'rb');
        $header = fread($fp, 24); // 36
        $info = unpack($fields, $header);
        // read optional extra stuff
        if ($info['Subchunk1Size'] > 16) {
            $header .= fread($fp, ($info['Subchunk1Size'] - 16));
        }
        // read SubChunk2ID
        $header .= fread($fp, 4);
        // read Subchunk2Size
        $size = unpack('vsize', fread($fp, 4));
        $size = $size['size'];
        // read data
        $data .= fread($fp, $size);
    }
    return $header . pack('V', strlen($data)) . $data;
}

// https://www.php.net/manual/en/function.shuffle.php
// https://www.php.net/manual/en/function.scandir.php
// https://stackoverflow.com/questions/3226519/how-to-get-only-images-using-scandir-in-php

$dir = '.';
#$files1 = array_diff(scandir($dir), array('..', '.'));
#$files2 = scandir($dir, SCANDIR_SORT_DESCENDING);
$files3 = glob('test_*.{wav,mp3,ogg}', GLOB_BRACE);
#$images = preg_grep('~\.(jpeg|jpg|png)$~', scandir($dir_f));

#print_r($files1);
#print_r($files2);
#print_r($files3);
shuffle($files3);
print_r($files3);

# join and save
$resp = joinwavs($files3);
file_put_contents('mix_' . time() . '.wav', $resp);
   