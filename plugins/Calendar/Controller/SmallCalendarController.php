<?php
App::uses('CalendarAppController', 'Calendar.Controller');
/**
 * LargeCalendar Controller
 *
 */
class SmallCalendarController extends CalendarAppController
{

    public $components = array('ContentValueManager');

    public function admin($contentId)
    {
        $this->layout = 'overlay';
        if ($this->request->is('post')) {
            $this->ContentValueManager->saveContentValues($contentId, $this->request->data['null']);
            $this->Session->setFlash(__d('calendar','Successfully saved'));
        }

        $contentValues = $this->ContentValueManager->getContentValues($contentId);

        if (array_key_exists('FirstDayOfWeek', $contentValues)) {
            $fdow = $contentValues['FirstDayOfWeek'];
        } else {
            $fdow = 1;
        }
        if (array_key_exists('ShowWeeks', $contentValues)) {
            $sw = $contentValues['ShowWeeks'];
        } else {
            $sw = false;
        }
        if (array_key_exists('MonthsForward', $contentValues)) {
            $mf = $contentValues['MonthsForward'];
        } else {
            $mf = 1;
        }
        if (array_key_exists('MonthsBackwards', $contentValues)) {
            $mb = $contentValues['MonthsBackwards'];
        } else {
            $mb = 1;
        }
        if (empty($this->request->data)) {
            $this->request->data = array(
                'null' => array(
                    'FirstDayOfWeek' => $fdow,
                    'ShowWeeks' => $sw,
                    'MonthsForward' => $mf,
                    'MonthsBackwards' => $mb
                )
            );
        }
    }

}