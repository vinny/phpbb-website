#!/usr/bin/env bash
EMAIL_BIN="/bin/mail"
EMAIL_RECIPIENTS="email@non-phpbb.com"

PHPBB_IP="140.211.15.9"

WRITABLE="writable"
LOG_FILE="$WRITABLE/logs/check-`date -I`.log"
SEND_EMAIL=false

# Kill old whois lookups
# Uncomment this if your system uses jwhois and tends to not timeout, be sure to update USERNAME with this script's account name
#killall -9 whois -u USERNAME

output()
{
	echo "$1" >> $LOG_FILE

	if [ -n "`echo $1 | grep "\[ERR\]"`" ]; then
		SEND_EMAIL=true
	fi
}

output "      Running checks at `date`"

#
# Checks whether phpbb.com can be looked up on nameservers
#
# google dns
NAMESERVERS="8.8.8.8 8.8.4.4"
# open dns
NAMESERVERS="$NAMESERVERS 208.67.222.222 208.67.220.220"

for ns in $NAMESERVERS; do
	result=`dig phpbb.com +short @$ns`
	if [ -z "$result" ]; then
		output "[ERR] - Could not look up phpbb.com on nameserver $ns"
	elif [ "$result" != "$PHPBB_IP" ]; then
		output "[ERR] - phpbb.com on nameserver $ns returned IP $result instead of $PHPBB_IP"
	else
		output "      - Looked up phpbb.com on nameserver $ns, returned IP $result is correct"
	fi
done

#
# Purge any old request data
#
if [ -f "$WRITABLE/cookie-jar" ]; then
	rm $WRITABLE/cookie-jar
fi
touch $WRITABLE/cookie-jar
chmod 0666 $WRITABLE/cookie-jar

if [ -f "$WRITABLE/headers" ]; then
        rm $WRITABLE/headers
fi
touch $WRITABLE/headers
chmod 0666 $WRITABLE/headers

if [ -f "$WRITABLE/output" ]; then
        rm $WRITABLE/output
fi
touch $WRITABLE/output
chmod 0666 $WRITABLE/output

#
# Check if phpbb.com responds with non-zero content to http requests
#
curl --connect-timeout 30 --max-time 45 --cookie-jar $WRITABLE/cookie-jar --dump-header $WRITABLE/headers --output $WRITABLE/output http://www.phpbb.com/community/ 2>&1
if [ -s $WRITABLE/output ]; then
	output "      - http://www.phpbb.com returned a non-empty response"
else
	output "[ERR] - http://www.phpbb.com returned an empty response"
fi

#
# Checks whether the cookie name is correct
#
if [ -z "`grep "phpbb3_1fh61_u" < $WRITABLE/cookie-jar`" ]; then
	output "[ERR] - Cookie with name phpbb3_1fh61_u could not be found"

	# If it fails, preserve the data for later inspection
	mv $WRITABLE/cookie-jar $WRITABLE/cookie-jar-`date +"%s"`
	mv $WRITABLE/headers $WRITABLE/headers-`date +"%s"`
	mv $WRITABLE/output $WRITABLE/output-`date +"%s"`
else
	output "      - Cookie with name phpbb3_1fh61_u found"
fi

#
# Check that the whois data hasn't been modified
#
result=`whois -h whois.verisign-grs.com phpbb.com`
registrar=true
reg_status=true
reg_info=true
if [ -z "$result" ]; then
	output "[ERR] - Could not get whois data"
else
	if [ -z "`echo $result | grep "Registrar: ENOM, INC."`" ]; then
		output "[ERR] - Registrar has changed from ENOM, INC."
		registrar=false
	fi

	if [ -z "`echo $result | grep "Status: clientTransferProhibited"`" ]; then
		output "[ERR] - Domain registration status is no longer locked"
		reg_status=false
	fi

	if [ -z "`echo $result | grep "Updated Date: 16-jul-2011"`" ]; then
		output "[ERR] - Domain registration has been altered"
		reg_info=false
	fi
fi

if $registrar && $reg_status && $reg_info; then
	output "      - Looked up phpbb.com on whois.verisign-grs.com, all entries are correct"
fi

#
# All checks complete
#
output "      Checks complete"
output ""

if $SEND_EMAIL ; then
	`tail $LOG_FILE | $EMAIL_BIN -s "[Alert] www.phpbb.com integrity failure!" "$EMAIL_RECIPIENTS"`
fi
