<?php

class DisplaySmallComponent extends Component
{
    public function getData($controller,$params,$url,$id) {
        $data = array();
        $data['FirstDayOfWeek'] = $params['FirstDayOfWeek'];
        $currentTime = strtotime(date('y-m').'-1');
        $data['StartTime'] = strtotime('-' . $params['MonthsBackwards']. ' months',$currentTime);
        $data['EndTime'] = strtotime('+' . $params['MonthsForward']+1 . ' months -1 day',$currentTime);
        var_dump($data);
        return $data;
    }
}
