<?php
App::uses('CalendarAppController', 'Calendar.Controller');
/**
 * LargeCalendar Controller
 *
 */
class LargeCalendarController extends CalendarAppController
{

    public $components = array('ContentValueManager');

    public function admin($contentId)
    {
        $this->layout = 'overlay';
        if ($this->request->is('post')) {
            $this->ContentValueManager->saveContentValues($contentId, $this->request->data['null']);
            $this->Session->setFlash('Successfully saved');
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
        if (empty($this->request->data)) {
            $this->request->data = array(
                'null' => array(
                    'FirstDayOfWeek' => $fdow,
                    'ShowWeeks' => $sw
                )
            );
        }
    }

}