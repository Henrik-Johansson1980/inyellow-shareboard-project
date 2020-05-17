<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">User Login</h3>
  </div>
  <div class="panel-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label>Email</label>
        <input name="email" class="form-control" autofocus/>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" />
      </div>
        <input type="submit" name="submit" class="btn btn-warning" value="Login" />
      </div>
    </form>
  </div>
</div>