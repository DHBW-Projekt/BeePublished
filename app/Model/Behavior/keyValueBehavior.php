<?php

/**
* KeyValue storage behavior
*
* PHP 5
*
* @copyright Copyright 2010-2011, Brookside Studios, LLC. (http://brooksidestudios.com)
* @author Matthew Dunham <mdunham@brooksidestudios.com>
*/
class KeyValueBehavior extends ModelBehavior {

/**
* Tells the saveKeyValue function what to do
*
* Can be overriden by passing an array to the function
*
* @var array
*/
public $keyValueOptions = array(
'uniqueKeys' => false,
'fields' => array(
'key' => 'key',
'value' => 'value'
)
);

/**
* Initiate behavior for the model using specified settings.
*
* Options:
* - uniqueKeys: If this is true it run a deleteAll on the data to save minus the value
* - fields: This is a single array that lets us know what field to use for the key and for the value
*
* @param Model $Model Model using the behavior
* @param array $options Options to override for model.
* @return void
*/
public function setup($Model, $options = array()) {
if ( ! isset($this->options[$Model->alias])) {
$this->options[$Model->alias] = $this->keyValueOptions;
}
if ( ! is_array($options)) {
$options = array();
}
$this->options[$Model->alias] = array_merge($this->options[$Model->alias], $options);
}

/**
* Before save method. Called before all saves
*
* Overriden to transparently check for data that needs to be processed into a key/value
* setup since this class triggers many calls to save() from a single user call to save()
* we have to allow all other data to submit as normal. This checks for the presence of the
* key and value field as defined in the settings for this model.
*
* @param Model $model
* @return bool
*/
public function beforeSave($Model) {
extract($this->options[$Model->alias]);
$keys = array_keys($Model->data[$Model->alias]);
$data = $Model->data;

if (in_array($fields['key'], $keys) && in_array($fields['value'], $keys)) {
return true;
}

if (isset($data[$Model->alias]) && ! empty($data[$Model->alias])) {
$dataTemplate = array($Model->alias => array());

foreach ($data[$Model->alias] as $field => $value) {
if ($Model->hasField($field)) {
$dataTemplate[$Model->alias][$field] = $value;
unset($data[$Model->alias][$field]);
}
}

$index = 0;

foreach ($data[$Model->alias] as $key => $value) {
$index ++;
$insert = $dataTemplate;
$insert[$Model->alias][$fields['key']] = $key;

if ($uniqueKeys) {
$Model->deleteAll(reset($insert));
}

$insert[$Model->alias][$fields['value']] = $value;
$Model->create();
if ($index == count($data[$Model->alias])) {
$Model->data = $insert;
return true;
} else {
if (false === $Model->save($insert)) {
return false;
}
}
}
}

return true;
}

}