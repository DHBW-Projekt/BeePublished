<?php
$days = array(__('Mon'), __('Tue'), __('Wed'), __('Thu'), __('Fri'), __('Sat'), __('Sun'));
for ($i = 1; $i < $data['FirstDayOfWeek']; $i++) {
    array_push($days, array_shift($days));
}
var_dump(date('d.m.Y',$data['StartTime']));
var_dump(date('N',$data['StartTime']));
var_dump();
?>
<table>
    <thead>
    <tr>
        <?php foreach ($days as $day): ?>
        <th><?php echo $day;?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>