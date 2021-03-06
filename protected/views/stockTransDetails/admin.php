<?php
/* @var $this StockTransDetailsController */
/* @var $model StockTransDetails */

$this->breadcrumbs=array(
	'Stock Trans Details'=>array('index'),
	'Manage',
);
/*
$this->menu=array(
	array('label'=>'List StockTransDetails', 'url'=>array('index')),
	array('label'=>'Create StockTransDetails', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#stock-trans-details-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Stock Trans Details</h1>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); 
?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//));
?>
</div> --><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stock-trans-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
//		'item_id',
		array(
			'name'=>'id',
			'header'=>'Item Code',
			'value'=>'$data->Rel_trans_item_id->code'
			),
			array(
				'name'=>'item_id',
			'header'=>'Item Name',
			'value'=>'$data->Rel_trans_item_id->name'
			),
		'qty',
		array(
		'name'=>'trans_type',
		'value'=>'$data->trans_type?\'Addition\':\'Deduction\'',
		'filter' => array('0' => 'Deduction', '1' => 'Addition'),
		),
		'date',
	//	'created_by',
		array(
			'name'=>'created_by',
			'value'=>'$data->Rel_trans_users->username'
			),
		/*
		'value',
		array(
			'class'=>'CButtonColumn',
		),
		*/
	),
)); ?>
