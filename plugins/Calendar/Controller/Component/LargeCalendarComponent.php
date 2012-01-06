<?php

class LargeCalendarComponent extends Component
{
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

        if (!array_key_exists('ShowWeekCount', $params)) {
            $data['ShowWeekCount'] = false;
        } else {
            $data['ShowWeekCount'] = $params['ShowWeekCount'];
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
            }
        }
        return $data;
    }
}
