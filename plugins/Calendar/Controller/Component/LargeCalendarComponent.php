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

        $data['Entries'] = $this->FetchCalendarEntries->getEntries($controller, $startDate, $endDate);
        return $data;
    }
}
