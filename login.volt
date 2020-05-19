{{ content() }}

  {{ flashSession.output() }}

<form action="" method="post">
<h2>Log In</h2>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
        <span class="input-group-text">
            <i class="fa fa-envelope">
            </i>
        </span>
      <input type="text" name="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
     <label for="inputPassword4">Password</label>
        <span class="input-group-text">
          <i class="fa fa-lock">
          </i>
        </span>
      <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
    <br />
    <button type="submit" name="submit" class="btn btn-primary">Log In</button>
            <a href="/user_test/register/" class="btn btn-success">Sign Up </a>
  </div>
</form>