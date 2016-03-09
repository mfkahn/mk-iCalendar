# A simple and fast iCal parser/generator
-------------------------------------------------------------------------------

This library is based on http://github.com/fangel/SG-iCalendar but
updated for PHP 5.3+ namespaces.  The re-organization is different enough
that I renamed the top-level namespace to mk from SG, but so far
nothing was changed code-wise from the original fork, except:

* namespaced class names replace original ones
* build.cmd and build.sh removed, assume a PSR-0 style autoload env
* composer.json added
* demo updated to fetch jquery, fullcalendar and an up to date ICS file from
  the network

## Usage

A simple example :

```
 use mk\ical\iCal;
 $ical = new iCal( "./basic.ics" );
 //or
 $ical = new iCal( "http://example.com/calendar.ics" );
 foreach( $ical->getEvents() As $event ) {
   // Do stuff with the event $event
 }
```

Demo server:

```
cd <project root>
sh demo-server.sh
```

The open your browser to [http://localhost:4000]()


## Development

### Testing

```
./vendor/bin/phpunit
```

### Generating apigen docs

```
cd <project root>
sh ./generate-docs.sh
```

### CHANGELOG :

0.8.0 (9 march 2015)
 + converted to require PHP 5.6+m namespace mk\ical
 + updated unit tests, added composer autoload section and dev dependencies
 + removed unnecessary script files
 + updated documentation generator

0.7.1 (12 may 2013)
 + converted to PHP 5.3+ namespace intouch\ical

0.7.0 (30 oct 2010)
 + ical EXDATE support (excluded dates in a range)
 + $event->isWholeDay()
 + getAllOccurrences() for repeated events
 + implemented a cache for repeated events

0.6.0 (29 oct 2010)
 + Added demo based on fullcalendar
 + Added duration unit tests
 + Support of Recurrent events in query Between()
 * various fixes on actual (5) issues

### TODO

(this is from the original repo, now on my TODO ...)

These iCal keywords are not supported for the moment :
 - RECURRENCE-ID : to move one event from a recurrence
 - EXRULE : to exclude multiple days by a complex rule

Also, multiple RRULE could be specified for an event,
but that is not the case for most calendar applications

To get more information about ical format and rules, see [http://www.ietf.org/rfc/rfc2445.txt]()
