<div>
<a href="<?php echo ROOT_PATH;?>shares/add" class="btn btn-warning btn-share" role="button">Share Something</a>
<?php foreach($viewmodel as $item): ?>
  <div class="well">
    <h3><?php echo $item['title']; ?></h3>
    <small><?php echo $item['create_date']; ?></small>
    <hr />
    <p><?php echo $item['body']; ?></p>
    <br>
    <p><a href="<?php echo $item['link']; ?>" target="_blank">Go to source &raquo;</a></p>

  </div>
<?php endforeach; ?>
</div>