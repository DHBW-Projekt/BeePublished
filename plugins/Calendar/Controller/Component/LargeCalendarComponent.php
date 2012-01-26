<?php

class LargeCalendarComponent extends Component
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

        if (sizeof($url) == 0) {
            $data['Page'] = 'Month';
            $data['StartTime'] = strtotime(date('y-m') . '-1');
        } else {
            switch ($url[0]) {
                case 'month':
                    $data['Page'] = 'Month';
                    $data['StartTime'] = strtotime($url[1]);
                    break;
                case 'day':
                    $data['Page'] = 'Day';
                    $data['StartTime'] = strtotime($url[1]);
                    break;
                case 'week':
                    $data['Page'] = 'Week';
                    $data['StartTime'] = strtotime($url[1]);
                    break;
                case 'detail':
                    $data['Page'] = 'Detail';
                    break;
            }
        }
        switch ($data['Page']) {
            case 'Month':
                $startDate = date('Y-m-d', $data['StartTime']);
                $endDate = date('Y-m-d', strtotime('+1 months -1 day', $data['StartTime']));
                break;
            case 'Day':
                $startDate = date('Y-m-d', $data['StartTime']);
                $endDate = $startDate;
                break;
            case 'Week':
                $startDate = date('Y-m-d', $data['StartTime']);
                $endDate = date('Y-m-d', strtotime('+1 week -1 day', $data['StartTime']));
                break;
        }

        if ($data['Page'] == 'Detail') {
            $data['Entry'] = $this->FetchCalendarEntries->getEntry($controller, $url[1]);
        } else {
            $data['Entries'] = $this->FetchCalendarEntries->getEntries($controller, $startDate, $endDate);
        }

        if ($data['Page'] == 'Day' || $data['Page'] == 'Week') {
            $startDate = date('Y-m-d', strtotime(substr($url[1],0,7)));
            $endDate = date('Y-m-d', strtotime($startDate . ' +1 months -1 day'));
            $data['MonthEntries'] = $this->FetchCalendarEntries->getEntries($controller, $startDate, $endDate);
        } else {
            $data['MonthEntries'] = array();
        }
        return $data;
    }
}
