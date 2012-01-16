<?php

class ContentValueManagerComponent extends Component
{

	public function getContentValues($contentId)
	{
		$this->ContentValue = ClassRegistry::init('ContentValue');
		$values = $this->ContentValue->findAllByContentId($contentId);
		$contentValues = array();
		if ($values != false) {
			foreach ($values as $contentValue) {
				$contentValues[$contentValue['ContentValue']['key']] = $contentValue['ContentValue']['value'];
			}
		}
		return $contentValues;
	}

	public function saveContentValues($contentId, $data)
	{
		$this->ContentValue = ClassRegistry::init('ContentValue');
		foreach ($data as $key => $value) {
			$contentValue = $this->ContentValue->findByContentIdAndKey($contentId, $key);
			if (!$contentValue) {
				$this->ContentValue->create();
				$this->ContentValue->set('content_id', $contentId);
				$this->ContentValue->set('key', $key);
			} else {
				$this->ContentValue->id = $contentValue['ContentValue']['id'];
			}
			$this->ContentValue->set('value', $value);
			$this->ContentValue->save();
		}
	}

	public function removeContentValues($contentId, $data)
	{
		$this->ContentValue = ClassRegistry::init('ContentValue');
		foreach ($data as $key => $value) {
			$contentValue = $this->ContentValue->findByContentIdAndKey($contentId, $key);
			if ($contentValue) {
				$this->ContentValue->delete($contentValue['ContentValue']['id']);
			}
		}
	}

}
