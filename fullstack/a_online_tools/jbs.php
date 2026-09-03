<?php

# http://phptester.net/

$lnks = '
https://apero.europersonal.com/karriere/apero-gmbh
https://bebee.com/de/jobs
https://de.indeed.com/
https://de.jobrapido.com/#
https://de.jobted.com/#
https://de.jooble.org/#
https://de.talent.com/jobs
https://en.devjobs.de/
https://germantechjobs.de/
https://germantechjobs.de/en/jobs/PHP/all
https://germantechjobs.de/jobs/PHP/all
https://germantechjobs.de/jobs/dotNET/all
https://jobs.golem.de/
https://jobs.heise.de/
https://jobs.meinestadt.de/
https://jobs.peri.com/
https://jobs.stolzberger.de/?unit=km&radius=100&page=1&search=1
https://jobtensor.com/?lang=en#
https://jobtensor.com/JavaScript-PHP-Jobs
https://scowter.com/
https://skalbach-gmbh.jobs.personio.com/
https://startup.jobs/php-jobs
https://talents.studysmarter.de/jobs/#
https://technikstellen.de/
https://touch.ferchau.com/de/de?sortingType=actuality&sortingDirection=DESC
https://wellfound.com/jobs
https://www.arbeitsagentur.de/jobsuche/suche?angebotsart=1&was=entwickler
https://www.backinjob.de/baden-wuerttemberg
https://www.bonner-jobanzeiger.de/suche/?jobId=REG28506390#
https://www.computerfutures.com/de-de/stellensuche/alle-jobs/#
https://www.get-in-it.de/jobsuche#
https://www.get-in-it.de/jobsuche?thematicPriority=5
https://www.getbaito.com/de/jobs
https://www.glassdoor.de/Job/index.htm#
https://www.glassdoor.de/index.htm#
https://www.hays.de/jobsuche/stellenangebote-jobs#
https://www.heyjobs.co/
https://www.heyjobs.co/de-de#
https://www.instaffo.com/en/talent
https://www.job.fish/#
https://www.jobijoba.de/Stellenangebote#
https://www.jobilize.com/job/search/api?q=php&loc=DE&send=Find+Jobs
https://www.jobs-in-ulm.de/
https://www.jobsuche-bw.de/
https://www.jobvector.de/
https://www.jobware.de/jobs/it#
https://www.jobware.de/jobs/php
https://www.kimeta.de/#
https://www.kleinanzeigen.de/s-jobs/c102
https://www.kununu.com/at/jobs
https://www.kununu.com/de/jobs?careerLevel=3
https://www.learn4good.com/jobs/language/german/list/informationstechnik_and_it/deutschland/
https://www.php-entwickler.de/
https://www.reef-resourcing.com/jobboerse/
https://www.remotely.de/alle-jobs
https://www.remotely.de/remote-jobs
https://www.remoterocketship.com/de/?page=1&sort=DateAdded&locations=Germany
https://www.stellenanzeigen.de/
https://www.stepstone.de/de
https://www.talent.de/de
https://www.teilzeitstellen.net/stellenangebote-teilzeit/php-software-entwickler/stuttgart
https://www.ulmer-jobanzeiger.de/#
https://www.wearedevelopers.com/en/jobs?q=PHP
https://www.workingnomads.com/jobs#
https://www.workwise.io/#
https://www.xing.com/#
https://www.xn--jobs-fr-stuttgart-72b.de/#
https://www.yourfirm.de/#
https://znapp.de/
https://zuhausejobs.com/
https://zutun.de/
------WS-------
https://en.devjobs.de/jobs/search#
https://jobtensor.com/Python-Jobs#
https://jobs.heise.de/
https://de.indeed.com/
https://stellenmarkt.stuttgarter-zeitung.de/#
https://jobs.ingenieur.de/
https://de.jooble.org/
https://jobs.jobhub-online.de/
https://www.stellenonline.de/
------REMOTE------
https://jobspresso.co/remote-work/
https://landing.jobs/jobs
https://remoteok.com/?location=region_EU
https://www.workingnomads.com/remote-europe-jobs
https://weworkremotely.com/
https://europa.eu/eures/portal/jv-se/home?lang=en&pageCode=find_a_job
https://remotive.com/
https://nodesk.co/remote-jobs/

';

$lines = array_unique(preg_split("~\n~", $lnks));

foreach (($lines) as $line){
	if(trim($line)){
		echo "<a href='$line' target='_blank'>".$line . "</a><br>";
	}
}