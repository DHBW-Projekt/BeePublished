<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Christoph Krämer
 *
 * @description Save and receive detail data for displayed plugins
 */

class ContentValueManagerComponent extends Component
{

    public function getContentValues($contentId)
    {
        $this->ContentValue = ClassRegistry::init('ContentValue');
        $values = $this->ContentValue->findAllByContentId($contentId);
        $contentValues = array();
        if ($values != false) {
            //put content value information in nicer array structure
            foreach ($values as $contentValue) {
                $contentValues[$contentValue['ContentValue']['key']] = $contentValue['ContentValue']['value'];
            }
        }
        return $contentValues;
    }

    public function saveContentValues($contentId, $data)
    {
        $this->ContentValue = ClassRegistry::init('ContentValue');
        //save all content values which are in $data array
        foreach ($data as $key => $value) {
            $contentValue = $this->ContentValue->findByContentIdAndKey($contentId, $key);
            if (!$contentValue) {
                //create new content value if it doesn't exist
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
