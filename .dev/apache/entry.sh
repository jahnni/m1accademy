#!/bin/bash -x
test -n "$STARTSERVERS" || export STARTSERVERS=2
test -n "$MINSERVERS" || export MINSERVERS=5
test -n "$MAXSPARESERVERS" || export MAXSPARESERVERS=10
test -n "$SERVERLIMIT" || export SERVERLIMIT=256
test -n "$MAXCLIENTS" || export MAXCLIENTS=256
test -n "$MAXREQUESTSPERCHILD" || export MAXREQUESTSPERCHILD=1000
test -n "$DOCROOT" || export DOCROOT=/var/www/html/
test -n "$ADDCONF" || export ADDCONF=""
test -n "$VADDCONF" || export VADDCONF=""
test -n "$OFFLOAD_HEADER" || export OFFLOAD_HEADER="SSLSessionID"
test -n "$NODEV" && rm -f /etc/php.d/zz_xdebug_triboodevelop.ini /etc/php.d/zz_triboodevelop.conf
test -n "$IDENTIFIER" || IDENTIFIER=`tail -n 1 /etc/hosts|sed 's/\s.*//'`


sed -i s/STARTSERVERS/$STARTSERVERS/ /etc/httpd/conf.d/zz_main.conf
sed -i s/MINSERVERS/$MINSERVERS/ /etc/httpd/conf.d/zz_main.conf
sed -i s/MAXSPARESERVERS/$MAXSPARESERVERS/ /etc/httpd/conf.d/zz_main.conf
sed -i s/SERVERLIMIT/$SERVERLIMIT/ /etc/httpd/conf.d/zz_main.conf
sed -i s/MAXCLIENTS/$MAXCLIENTS/ /etc/httpd/conf.d/zz_main.conf
sed -i s/MAXREQUESTSPERCHILD/$MAXREQUESTSPERCHILD/ /etc/httpd/conf.d/zz_main.conf
sed -i s^ADDCONF^$ADDCONF^ /etc/httpd/conf.d/zz_main.conf

sed -i s^DOCROOT^$DOCROOT^ /etc/httpd/conf.d/zz_virtualhost.conf
sed -i s^VADDCONF^$VADDCONF^ /etc/httpd/conf.d/zz_virtualhost.conf
sed -i s^IDENTIFIER^$IDENTIFIER^ /etc/httpd/conf.d/*
sed -i s^OFFLOAD_HEADER^$OFFLOAD_HEADER^ /etc/httpd/conf.d/*

mkdir /run/php
httpd -D FOREGROUND
