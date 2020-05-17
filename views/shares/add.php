<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">Share Something</h3>
  </div>
  <div class="panel-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label>Share Title</label>
        <input type="text" name="title" class="form-control" autofocus/>
      </div>
      <div class="form-group">
        <label>Body</label>
        <textarea name="body" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Link</label>
        <input type="text" name="link" class="form-control" />
      </div>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_data']['id']?>">
        <input type="submit" name="submit" class="btn btn-warning" value="Submit" />
        <a href="<?php echo ROOT_PATH; ?>shares" class="btn btn-danger">Cancel</a>
      </div>
    </form>
  </div>
</div>