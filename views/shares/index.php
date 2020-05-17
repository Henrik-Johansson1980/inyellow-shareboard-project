<div>
<?php if(isset($_SESSION['is_logged_in'])) : ?>
  <a href="<?php echo ROOT_PATH;?>shares/add" class="btn btn-warning btn-share" role="button">Share Something</a>
<?php endif; ?>

<?php foreach($viewmodel as $item): ?>
  <div class="well">
    <h3><?php echo $item['title']; ?></h3>
    <div>
      <p><?php echo 'Posted by: ' . $item['name'] .' on '. date_format(date_create($item['create_date']), 'Y-m-d') ; ?></p>
      <p><?php echo $item['body']; ?></p>
      <br>
      <p><a href="<?php echo $item['link']; ?>" target="_blank">Go to Web Page &raquo;</a></p>
    </div>
  </div>
<?php endforeach; ?>
</div>