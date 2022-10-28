
<?php if(session()->has('success')): ?>
<script>
  var content = {};

  content.message = '<?php echo e(__(session('success'))); ?>';
  content.title = 'Success';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'success',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
<?php endif; ?>


<?php if(session()->has('warning')): ?>
<script>
  var content = {};

  content.message = '<?php echo e(__(session('warning'))); ?>';
  content.title = 'Warning!';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'warning',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
<?php endif; ?>


<?php if(session()->has('danger')): ?>
<script>
  var content = {};

  content.message = '<?php echo e(__(session('danger'))); ?>';
  content.title = 'Opps!';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'danger',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
<?php endif; ?>




<?php if(session()->has('info')): ?>
<script>
  var content = {};

  content.message = '<?php echo e(__(session('info'))); ?>';
  content.title = 'Info!';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'info',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
<?php endif; ?>


<?php /**PATH E:\Gool\resources\views/partials/notify.blade.php ENDPATH**/ ?>