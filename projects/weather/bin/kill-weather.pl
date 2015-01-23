#!/usr/bin/perl

open (PS, "ps -ef | grep processweather | grep -v grep");

while (<PS>) {
	if (/processweather/ && !/jpico/) {
		$pid = (split,'\s')[1];
		$runtime = (split,'\s')[4];
		`kill -9 $pid`;
	}
}

close (PS);
