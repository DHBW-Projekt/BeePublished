<?php
$this->Html->css('/FileShare/css/fileshare', NULL, array('inline' => false));

echo $this->Form->create('MyFile', array('url' => array('plugin' => 'file_share', 'action' => 'upload'), 'type' => 'file'));
echo $this->Form->file('File');
echo $this->Form->submit('Upload');
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

?>

<h1>Your Files</h1>

<table>
    <tr>
        <th>Filename</th>
        <th>Size</th>
        <th>Options</th>
    </tr>

    <?
    foreach ($my_files as $file):
        ?>
        <tr>
            <td><? echo $file['MyFile']['filename'] ?></td>
            <td><? echo $file['MyFile']['size'] ?></td>
            <td>
                <? echo $this->Html->link('Delete', array('plugin' => 'FileShare', 'controller' => 'MyFiles', 'action' => 'delete', $file['MyFile']['ID'])); ?>
                <? echo $this->Html->link('Download', array('plugin' => 'FileShare', 'controller' => 'MyFiles', 'action' => 'download', encrypt($file['MyFile']['ID'], $ck))); ?>
                <? echo $this->Html->link('Download Expiring', array('plugin' => 'FileShare', 'controller' => 'MyFiles', 'action' => 'download', encrypt($file['MyFile']['ID'] . "|" . time(), $ck))); ?>
            </td>
        </tr>
        <?
    endforeach;
    ?>
</table>
