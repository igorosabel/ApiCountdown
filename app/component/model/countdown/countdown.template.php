<?php if (is_null($values['countdown'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['countdown']->get('id') ?>,
	"endDate": <?php echo $values['countdown']->get('end_date') ?>,
	"createdAt": "<?php echo $values['countdown']->get('created_at', 'd/m/Y H:i:s') ?>"
}
<?php endif ?>
