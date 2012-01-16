<?php

class FileComponent extends Component
{
	public function upload()
	{
		if (!empty($this->data) &&
		is_uploaded_file($this->data['MyFile']['File']['tmp_name'])
		) {
			//$fileData = fread(fopen($this->data['File']['File']['tmp_name'], "r"),$this->data['File']['File']['size']);

			$this->data['MyFile']['filename'] = $this->data['MyFile']['File']['name'];
			$this->data['MyFile']['type'] = $this->data['MyFile']['File']['type'];
			$this->data['MyFile']['size'] = $this->data['MyFile']['File']['size'];
			// Write file to disk
			//$this->data['File']['data'] = $fileData;

			$this->data['MyFile']['path'] = "muh";
			$this->data['MyFile']['user'] = "1";

			$this->MyFile->save($this->data);

			//$this->redirect('somecontroller/someaction');
		}
	}
	public function beforeFilter() {
		parent::beforeFilter();

		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}

?>
