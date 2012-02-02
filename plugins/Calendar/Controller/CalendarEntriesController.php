<?php
App::uses('CalendarAppController', 'Calendar.Controller');
/**
 * CalendarEntries Controller
 *
 * @property CalendarEntry $CalendarEntry
 */
class CalendarEntriesController extends CalendarAppController
{

    /**
     * add method
     *
     * @return void
     */
    public function add($startDate)
    {
        $this->layout = 'overlay';
        $this->CalendarEntry->create();
        $this->CalendarEntry->set('start_date', $startDate);
        $this->CalendarEntry->set('end_date', $startDate);
        $this->CalendarEntry->set('notime', true);
        $this->CalendarEntry->set('user_id', $this->Auth->user('id'));
        if ($this->request->is('post')) {
            if ($this->CalendarEntry->save($this->request->data)) {
                $this->Session->setFlash(__d('calendar','The calendar entry has been saved'));
                $this->render('close');
            } else {
                $this->Session->setFlash(__d('calendar','The calendar entry could not be saved. Please, try again.'),'default', array('class' => 'flash_failure'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->CalendarEntry->data;
        }
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->layout = 'overlay';
        $this->CalendarEntry->id = $id;
        if (!$this->CalendarEntry->exists()) {
            throw new NotFoundException(__('Invalid calendar entry'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->CalendarEntry->save($this->request->data)) {
                $this->Session->setFlash(__d('calendar','The calendar entry has been saved'));
                $this->render('close');
            } else {
                $this->Session->setFlash(__d('calendar','The calendar entry could not be saved. Please, try again.'),'default', array('class' => 'flash_failure'));
            }
        } else {
            $this->request->data = $this->CalendarEntry->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->CalendarEntry->id = $id;
        if (!$this->CalendarEntry->exists()) {
            throw new NotFoundException(__d('calendar','Invalid calendar entry'));
        }
        if ($this->CalendarEntry->delete()) {
            $this->Session->setFlash(__d('calendar','Calendar entry deleted'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__d('calendar','Calendar entry was not deleted'),'default', array('class' => 'flash_failure'));
        $this->redirect($this->referer());
    }
}
