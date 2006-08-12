<?php
/**
 * icalendar output for a single vent instance.
 */

$out = array();
$out[] = 'BEGIN:VEVENT';
//$out[] = 'SEQUENCE:5';
if (isset($this->eventdatetime->starttime)) {
	if (strpos($this->eventdatetime->starttime,'00:00:00')) {
		$out[] = 'DTSTART;TZID=US/Central:'.date('Ymd',strtotime($this->eventdatetime->starttime));
	} else {
       	$out[] = 'DTSTART;TZID=US/Central:'.date('Ymd\THis',strtotime($this->eventdatetime->starttime));
	}
   }
   $out[] = 'UID:'.$this->eventdatetime->id;
$out[] = 'DTSTAMP:'.date('Ymd\THis',strtotime($this->event->datecreated));
$out[] = 'SUMMARY:'.strip_tags($this->event->title);
$out[] = 'DESCRIPTION:'.strip_tags($this->event->description);
//$out[] = 'URL:http://abc.com/pub/calendars/jsmith/mytime.ics';
//$out[] = 'UID:EC9439B1-FF65-11D6-9973-003065F99D04';
if (isset($this->eventdatetime->endtime)) {
	if (strpos($this->eventdatetime->endtime,'00:00:00')) {
		$out[] = 'DTEND;TZID=US/Central:'.date('Ymd',strtotime($this->eventdatetime->endtime));
	} else {
   		$out[] = 'DTEND;TZID=US/Central:'.date('Ymd\THis',strtotime($this->eventdatetime->endtime));
	}
   }
$out[] = 'END:VEVENT';
echo implode("\n",$out)."\n";
?>