<?php

namespace mk\ical;

define('SG_ICALREADER_VERSION', '0.8.0');

/**
 * A simple iCal parser.
 *
 * http://github.com/mfkahn/mk-iCalendar based on
 * http://github.com/fangel/SG-iCalendar
 *
 * Roadmap:
 * - Finish FREQUENCY-parsing.
 * - Add API for recurring events
 *
 * A simple example:
 * <code>
 * <?php
 * use mk\ical\iCal;
 * $ical = new iCal("http://example.com/calendar.ics");
 * foreach ( $ical->getEvents() As $event ) {
 *   // Do stuff with the event $event
 * }
 * ?>
 * </code>
 *
 * @author Morten Fangel (C) 2008
 * @author xonev (C) 2010
 * @author Tanguy Pruvot (C) 2010
 * @author Michael Kahn (C) 2013, 2016
 * @license http://creativecommons.org/licenses/by-sa/2.5/dk/deed.en_GB CC-BY-SA-DK
 */
class iCal
{
    /**
     * @var VCalendar
     */
    public $information; //VCalendar
    /**
     * @var VTimeZone[]
     */
    public $timezones;   //VTimeZone

    /**
     * @var VEvent[]
     */
    protected $events; //VEvent[]

    /**
     * Constructs a new iCalReader. You can supply the url now, or later using setUrl
     * @param $url string
     */
    public function __construct($url = false)
    {
        $this->setUrl($url);
    }

    /**
     * Sets (or resets) the url this reader reads from.
     * @param $url string
     */
    public function setUrl( $url = false )
    {
        if ($url !== false) {
            Parser::Parse($url, $this);
        }
    }

    /**
     * Returns the main calendar info. You can then query the returned
     * object with ie getTitle().
     * @return VCalendar
     */
    public function getCalendarInfo()
    {
        return $this->information;
    }

    /**
     * Sets the calendar info for this calendar
     * @param VCalendar $info
     */
    public function setCalendarInfo( VCalendar $info )
    {
        $this->information = $info;
    }

    /**
     * Returns a given timezone for the calendar. This is mainly used
     * by VEvents to adjust their date-times if they have specified a
     * timezone.
     *
     * If no timezone is given, all timezones in the calendar is
     * returned.
     *
     * @param $tzid string
     * @return VTimeZone
     */
    public function getTimeZoneInfo( $tzid = null )
    {
        if ($tzid == null) {
            return $this->timezones;
        } else {
            if ( !isset($this->timezones)) {
                return null;
            }
            foreach ($this->timezones AS $tz) {
                if ( $tz->getTimeZoneId() == $tzid ) {
                    return $tz;
                }
            }

            return null;
        }
    }

    /**
     * Adds a new timezone to this calendar
     * @param VTimeZone $tz
     */
    public function addTimeZone( VTimeZone $tz )
    {
        $this->timezones[] = $tz;
    }

    /**
     * Returns the events found
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Adds a event to this calendar
     * @param VEvent $event
     */
    public function addEvent( VEvent $event )
    {
        $this->events[] = $event;
    }
}

/**
 * Legacy - empty subclass of iCal
 * @internal
 */
class iCalReader extends iCal {}
