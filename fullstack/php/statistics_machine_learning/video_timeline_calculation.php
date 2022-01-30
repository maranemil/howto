<?php

$arrTimeline = array(
    "Jake Tapper" => array(
        "0009-0016", "0021-0034", "0058-0109", "0122-0124", "0136-0209", "0323-0410", "0438-0446",
        "0524-0538", "0620-0646", "0843-0901", "0906-0921", "1138-1150", "1209-1212",
        "1251-1308", "1705-1712", "2112-2152", "2226-2230", "2240-2252", "2500-2516",
        "2808-2823", "3232-3320", "3621-3634", "3810-3821", "4058-4116", "4245-4300",
        "4452-4510"),
    "Trevor Noah" => array(
        "0017-0021", "0034-0058", "0109-0122", "0124-0135", "0210-0246", "0248-0323", "0901-0903",
        "1308-1704", "2517-2548", "2823-3232", "3320-3619", "4300-4452"),
    "Desi Lydic" => array("1150-1208", "1212-1214", "2550-2806", "3757-3809", "3822-3835"),
    "Ronny Chieng" => array("0646-0843", "3634-3744"),
    "Dulcé Sloan" => array("0921-1109", "1214-1250", "1810-1858", "1903-1908", "3836-3854", "3927-4031"),
    "Roy Wood Jr." => array("0446-0523", "1734-1809", "2232-2240", "2252-2455", "3904-3927"),
    "Jaboukie Young-White" => array("0410-0438", "0538-0619", "2153-2226", "4032-4058", "4118-4134"),
    "Michael Kosta" => array("1110-1136", "1716-1727", "1915-2103", "4136-4244"),
);

foreach ($arrTimeline as $users => $userstalk) {
    foreach ($userstalk as $talk) {
        $arTmp = explode("-", $talk);
        $strEnded = substr($arTmp[1], 0, 2) . ":" . substr($arTmp[1], 2, 2);
        $strStart = substr($arTmp[0], 0, 2) . ":" . substr($arTmp[0], 2, 2);

        #$arrRes1[$users]["ended"] =  $strEnded;
        #$arrRes1[$users]["start"] =  $strStart;
        $arrRes[$users][] = strtotime("2019-10-05 18:" . $strEnded) - strtotime("2019-10-05 18:" . $strStart);
    }
}

print "<pre>";
#print_r($arrRes1);
#print_r($arrRes);
foreach ($arrRes as $user => $time) {
    echo "* " . sprintf("%20s", $user) . " - total seconds " . array_sum($time) . " - Minutes: " . round(array_sum($time) / 60, 2);
    $arrTotal[] = array_sum($time);
    echo "<br>";
}

#echo array_sum($arrTotal)/60;

/**
 *
 * https://www.youtube.com/watch?v=U6qYrm61Pw8
 * http://www.cc.com/shows/the-daily-show-with-trevor-noah/news-team
 *
 * 1. Jake Tapper
 * 2. Trevor Noah
 * 3. Desi Lydic
 * 4. Ronny Chieng
 * 5. Dulcé Sloan
 * 6. Roy Wood Jr.
 * 7. Jaboukie Young-White
 * 8. Michael Kosta
 *
 * -------------------- --------------------
 *
 * Chart Top Talk length by user
 *          Trevor Noah - 1
 *          Jake Tapper - 2
 *         Dulcé Sloan  - 3
 *         Roy Wood Jr. - 4
 *        Michael Kosta - 5
 *         Ronny Chieng - 6
 *           Desi Lydic - 7
 * Jaboukie Young-White - 8
 *
 *
 * Total time in seconds for each Participant in Talk
 *          Jake Tapper - total seconds 443 - Minutes: 7.38
 *          Trevor Noah - total seconds 932 - Minutes: 15.53
 *           Desi Lydic - total seconds 181 - Minutes: 3.02
 *         Ronny Chieng - total seconds 187 - Minutes: 3.12
 *         Dulcé Sloan  - total seconds 279 - Minutes: 4.65
 *         Roy Wood Jr. - total seconds 226 - Minutes: 3.77
 * Jaboukie Young-White - total seconds 144 - Minutes: 2.4
 *        Michael Kosta - total seconds 213 - Minutes: 3.55
 *
 * -------------------- --------------------
 */
