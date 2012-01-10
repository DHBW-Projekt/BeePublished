<?php

class SmallCalendarComponent extends Component
{
    public $components = array('Calendar.FetchCalendarEntries');

    public function getData($controller, $params, $url, $id)
    {
        $data = array();

        //Check content values and set default values if they dont exist
        if (!array_key_exists('FirstDayOfWeek', $params)) {
            $data['FirstDayOfWeek'] = 1;
        } else {
            $data['FirstDayOfWeek'] = $params['FirstDayOfWeek'];
        }
        if ($data['FirstDayOfWeek'] == 7) {
            $data['FirstDayOfWeek'] = 0;
        }

        if (!array_key_exists('ShowWeeks', $params)) {
            $data['ShowWeeks'] = false;
        } else {
            $data['ShowWeeks'] = $params['ShowWeeks'];
        }

        if (!array_key_exists('MonthsBackwards', $params)) {
            $monthsBackwards = 1;
        } else {
            $monthsBackwards = $params['MonthsBackwards'];
        }

        if (!array_key_exists('MonthsForward', $params)) {
            $monthsForward = 1;
        } else {
            $monthsForward = $params['MonthsForward'];
        }
        if (!array_key_exists('PageWithLargeView', $params)) {
            $data['page'] = null;
        } else {
            $page = $controller->Page->findById($params['PageWithLargeView']);
            $data['page'] = $page['Page']['name'] . '/';
        }

        //Create array with time of first day of each month
        $months = array();
        $currentTime = strtotime(date('y-m') . '-1');
        $time = strtotime('-' . $monthsBackwards . ' months', $currentTime);
        $numOfMonths = $monthsBackwards + $monthsForward + 1;
        $startDate = date('Y-m-d', $time);

        for ($i = 0; $i < $numOfMonths; $i++) {
            $months[] = $time;
            $time = strtotime('+1 months', $time);
        }

        $endDate = date('Y-m-d', strtotime('+1 months -1 day', $time));

        $data['Months'] = $months;

        $data['Entries'] = $this->FetchCalendarEntries->getEntries($controller, $startDate, $endDate);
        return $data;
    }
}
