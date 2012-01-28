<?php

class FetchCalendarEntriesComponent extends Component
{
    public function getEntries($controller, $startDate, $endDate)
    {
        $controller->loadModel('Calendar.CalendarEntry');
        $entries = $controller->CalendarEntry->find('all', array('conditions' => array('start_date >=' => $startDate, 'end_date <=' => $endDate), 'order' => array('start_date', 'notime DESC', 'start_time')));
        $sortedEntries = array();
        foreach ($entries as $entry) {
            $sortedEntries[$entry['CalendarEntry']['start_date']][] = $entry['CalendarEntry'];
        }
        return $sortedEntries;
    }

    public function getEntry($controller, $id)
    {
        $controller->loadModel('Calendar.CalendarEntry');
        $entry = $controller->CalendarEntry->findById($id);
        return $entry['CalendarEntry'];
    }

}