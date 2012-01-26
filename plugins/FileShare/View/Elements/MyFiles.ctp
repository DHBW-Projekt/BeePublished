<?php
$this->Html->css('/FileShare/css/fileshare', NULL, array('inline' => false));

echo $this->Form->create('MyFile', array('url' => array('plugin' => 'file_share', 'action' => 'upload'), 'type' => 'file'));
echo $this->Form->file('File');
echo $this->Form->submit(__d('file_share','Upload'));
echo $this->Form->end();

$contentValues = $my_files_config;

if (array_key_exists('Cryptkey', $contentValues)) {
    $ck = $contentValues['Cryptkey'];
} else {
    $ck = "nothing";
}


function safe_b64encode($string)
{

    $data = base64_encode($string);
    $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
    return $data;
}

function encrypt($value, $ck)
{

    if (!$value) {
        return false;
    }
    $text = $value;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $ck, $text, MCRYPT_MODE_ECB, $iv);
    return trim(safe_b64encode($crypttext));
}

function bytesToSize($bytes, $precision = 2)
{
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';

    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';

    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';

    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';

    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

?>

<h1><? echo __d('file_share','Your files'); ?></h1>

<table>
    <tr>
        <th width="150px"><? echo __d('file_share','Filename'); ?></th>
        <th width="150px"><? echo __d('file_share','Size'); ?></th>
        <th width="300px"><? echo __d('file_share','Options'); ?></th>
    </tr>

    <?
    foreach ($my_files as $file):
        ?>
        <tr>
            <td><? echo $file['MyFile']['filename'] ?></td>
            <td><? echo bytesToSize($file['MyFile']['size']) ?></td>
            <td>
                <? echo $this->Html->link($this->Html->image('/img/delete.png', array('height' => 16, 'width' => 16, 'alt' => __d('file_share','Delete file'))), array('plugin' => 'FileShare', 'controller' => 'MyFiles', 'action' => 'delete', $file['MyFile']['ID']),array('escape' => false, 'title' => __d('file_share','Delete file')), __d('file_share','Do you really want to delete this file?')); ?>
                <? echo $this->Html->link(__d('file_share','Download'), array('plugin' => 'FileShare', 'controller' => 'MyFiles', 'action' => 'download', encrypt($file['MyFile']['ID'], $ck))); ?>
                <? echo $this->Html->link(__d('file_share','Download Expiring'), array('plugin' => 'FileShare', 'controller' => 'MyFiles', 'action' => 'download', encrypt($file['MyFile']['ID'] . "|" . time(), $ck))); ?>
            </td>
        </tr>
        <?
    endforeach;
    ?>
</table>
