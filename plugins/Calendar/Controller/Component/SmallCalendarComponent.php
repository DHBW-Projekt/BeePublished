<?php

class SmallCalendarComponent extends Component
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

        if (!array_key_exists('MonthsBackwards', $params)) {
            $monthsBackwards = 1;
        } else {
            $monthsBackwards = $params['MonthsBackwards'];
        }

        if (!array_key_exists('MonthsForward', $params)) {
            $monthsForward = 1;
        } else {
            $monthsForward = $params['$monthsForward'];
        }
        if (!array_key_exists('PageWithLargeView', $params)) {
            $data['page'] = null;
        } else {
            $page = $controller->Page->findById($params['PageWithLargeView']);
            $data['page'] = $page['Page']['name'].'/';
        }

        //Create array with time of first day of each month
        $months = array();
        $currentTime = strtotime(date('y-m') . '-1');
        $time = strtotime('-' . $monthsBackwards . ' months', $currentTime);
        $numOfMonths = $monthsBackwards + $monthsForward + 1;

        for ($i = 0; $i < $numOfMonths; $i++) {
            $months[] = $time;
            $time = strtotime('+1 months', $time);
        }

        $data['Months'] = $months;

        return $data;
    }
}
