<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <p class="text-capitalize"> Напоминания </p> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?= \yii2fullcalendar\yii2fullcalendar::widget( [
	'id' => 'calendar',
	'events'=> $events,
]);
?>

<?php 
$script = <<< JS
$(document).ready(function() {
	$('#calendar').fullCalendar('option', 'aspectRatio', 2.2);
});
JS;
$this->registerJs($script);
?>