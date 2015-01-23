#!/bin/zsh -x
# this script grabs the current temperature and writes it to an include for insertion into the azcardinal site
CNT=$(ps -efl | grep get_cards | grep -v grep | wc -l )
if [[ $CNT -gt 3 ]];then
	exit
fi

TEMP=$(/usr/bin/dog "http://iwin.nws.noaa.gov/iwin/AZ/hourly.html" | grep PHOENIX | head -3 | tail -1 | gawk '{print $3}')
if [[ $TEMP == <1-140>* ]];then
	echo ${TEMP} >| /www_live/azc/htdocs/includes/cards_phoenix_temp.inc
	exit
fi

# if the above is down try this one
TEMP=$(dog "http://twister.sbs.ohio-state.edu/text/obs/roundup/ASUS45.KPHX" | grep PHOENIX | head -3 | tail -1 | gawk '{print $3}')
if [[ $TEMP == <1-140>* ]];then
	echo ${TEMP} >| /www_live/azc/htdocs/includes/cards_phoenix_temp.inc
fi
