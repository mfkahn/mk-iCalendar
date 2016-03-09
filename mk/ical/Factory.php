<?php // BUILD: Remove line

namespace mk\ical;

/**
 * A simple Factory for converting a section/data pair into the
 * corrosponding block-object. If the section isn't known a simple
 * ArrayObject is used instead.
 *
 * @author Morten Fangel (C) 2008
 * @author Michael Kahn (C) 2013, 2016
 * @license http://creativecommons.org/licenses/by-sa/2.5/dk/deed.en_GB CC-BY-SA-DK
 */
class Factory
{
    /**
     * Returns a new block-object for the section/data-pair. The list
     * of returned objects is:
     *
     * vcalendar => mk\ical\VCalendar
     * vtimezone => mk\ical\VTimeZone
     * vevent => mk\ical\VEvent
     * * => ArrayObject
     *
     * @param $ical iCal The reader this section/data-pair belongs to
     * @param $section string
     * @param mk\ical\Line[]
     */
    public static function factory( iCal $ical, $section, $data )
    {
        switch ($section) {
            case "vcalendar":
                return new VCalendar(Line::Remove_Line($data), $ical );
            case "vtimezone":
                return new VTimeZone(Line::Remove_Line($data), $ical );
            case "vevent":
                return new VEvent($data, $ical );

            default:
                return new ArrayObject(Line::Remove_Line((array) $data) );
        }
    }
}
