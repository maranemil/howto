<?php

// http://phptester.net/

#Distro, Start,  End, Fullscreen, Fullscreen After, Done without Network,Installed,	mouse
$arrDistro = array(
array("Ubuntu 18.04.1 desktop amd64", "00:52", "10:12", "yes", "yes" ,"yes", "yes","yes"),
array("LinuxMint 19 xfce 64bit", "00:59","08:02","no","yes","yes", "yes","yes"),
array("Debian live 9.5.0 amd64 xfce", "00:13", "09:07", "no","no","yes","no","yes"),
array("Debian live 8.5.0 i386 xfce desktop", "00:20", "07:12", "no","no","yes","no","yes"),
array("Ubuntu 16.04.5 LTS (Xenial Xerus)","00:44","07:49","yes","yes","yes","yes","yes"),
array("Ubuntu 14.04.5 LTS (Trusty Tahr)","00:43","06:56","yes","yes","yes","yes","yes"),
array("Ubuntu 12.04.5 LTS (Precise Pangolin)","00:39","05:00","no","no","yes","yes","yes"),
array("Ubuntu 10.04 desktop i386","00:28","04:04","no","no","yes","yes","yes"),
array("Ubuntu 9.04 desktop i386","00:36","03:33","no","no","yes","yes","yes"),
array("Scientific Linux SL 7 5 x86 64 2018","01:39","15:07","no","no","yes","yes","no"),
array("RaspberryPi Debian 2017 x86 stretch","01:18","09:01","no","no","yes","yes","yes"),
array("OpenSUSE 11 1 GNOME LiveCD i686","00:57","05:36","no","no","yes","yes","yes"),
array("Manjaro Xfce minimal 0.8.9 x86 64","00:55","04:00","yes","yes","yes","yes","yes"),
array("Linux Mint 18 3 xfce 64bit","00:58","05:58","no","yes","yes","yes","yes"),
array("Kali linux light 2018 2 amd64","00:22","07:42","no","no","yes","yes","yes"),
array("Fuduntu 2013 2 i686 LiteDVD","01:10","05:22","no","no","yes","yes","yes"),
array("Debian 7.11 0 i386 xfce CD 1","00:15","12:22","no","no","yes","yes","yes"),
array("CentOS 7 x86 64 Minimal 1804","00:57","10:33","no","no","yes","yes","no"),
array("Black Lab bll 8 unity x86 64","02:29","10:29","yes","yes","yes","no","yes"),
array("Lubuntu 16.04.5 desktop amd64","00:42","05:16","no","yes","yes","yes","yes"),
array("Elementary OS 0.4.1 stable","01:15","09:23","yes","yes","yes","yes","yes"),
array("Trisquel mini 8.0 amd64","00:52","05:02","no","no","yes","yes","yes"),
array("Red-Hat rhel server 7 5 x86 64","01:00","10:52","no","no","yes","yes","no"),
array("Pure-OS 8 0 gnome 20180904 amd64","02:43","11:10","yes","yes","yes","yes","yes"),
array("Pop os 18 04 amd64 intel 37","00:31","05:22","yes","yes","yes","yes","yes"),
array("FreeBSD 11 2 RELEASE amd64","00:25","06:43","no","no","yes","yes","no"),
array("Fedora Workstation Live x86 64 ","01:44","16:45","yes","yes","yes","yes","yes"),
array("Ubuntu 18.10 (Cosmic Cuttlefish) amd64","01:05","09:57","yes","yes","yes","yes","yes"),
array("Kali Linux light 2018 3 amd64","00:22","08:15","no","no","yes","yes","yes"),
array("Debian 9.5.0 amd64 xfce CD 1","00:10","12:12","no","no","yes","yes","no"),
array("Feren_OS_x64","00:55","12:10","yes","yes","yes","yes","yes"),
);
//print "<pre>"; //print_r($arrDistro);
foreach ($arrDistro as $distro){
	// count feature
	$sumOptions = array_count_values(array($distro[3],$distro[4],$distro[5],$distro[6],$distro[7]));
	// get time difference in minutes
	$start = date_create(date("Y-m-d")." ".$distro[2].":00");
	$end = date_create(date("Y-m-d")." ".$distro[1].":00");
	$interval = date_diff( $start, $end );
	// assign to array
	$arrRes[] = array(
		"distro" => $distro[0],
		"score" => $sumOptions["yes"],
		"neg_score" => (isset($sumOptions["no"])?$sumOptions["no"]:0),
		"speed" => $interval->format('%H').":".$interval->format('%i'),
		"speed_seconds" => ($interval->format('%H') * 60) + $interval->format('%i'),
		"speed_score" => flipscore(($interval->format('%H') * 60) + $interval->format('%i')),
		"final_score" => flipscore(($interval->format('%H') * 60) + $interval->format('%i')) + $sumOptions["yes"]
	);
}

function flipscore($input){
	switch($input){
		case $input > 100 && $input < 200:  return 10; break;
		case $input > 200 && $input < 300:  return 9; break;
		case $input > 300 && $input < 400:  return 8; break;
		case $input > 400 && $input < 500:  return 7; break;
		case $input > 500 && $input < 600:  return 6; break;
		case $input > 600 && $input < 700:  return 5; break;
		case $input > 700 && $input < 800:  return 4; break;
		case $input > 800 && $input < 900:  return 3; break;
		case $input > 900 && $input < 1000:  return 2; break;
		default: return 0;
	}
}


#asort($arrRes);
$mylist = $arrRes;
$sort = array();
foreach($mylist as $k => $v) {
    $sort['distro'][$k] = $v['distro'];
    $sort['final_score'][$k] = $v['final_score'];
}
# sort by event_type desc and then title asc
array_multisort($sort['final_score'], SORT_DESC, $sort['distro'], SORT_ASC, $mylist);

print_table($mylist);
function print_table($input){
	echo '<table border="1" cellpadding="3" cellspacing="3">';
	foreach($input as $key=>$values)
	{
		echo "<tr>";
		foreach($values as $key2=>$values2)
		{
			echo "<td style='font-size: 12px'>".$values2."</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
}
