{{ content() }}

  {{ flashSession.output() }}

<form action="" method="post">
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
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="inputAddress">Address</label>
        <span class="input-group-text">
              <i class="fa fa-building">
              </i>
        </span>
        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
    <div class="form-group col-md-6">
        <label for="inputAddress2">Address 2</label>
            <span class="input-group-text">
                  <i class="fa fa-building">
                  </i>
            </span>
        <input type="text" class="form-control" name="address2" id="inputAddress2" placeholder="Apartment, studio, or floor">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
            <span class="input-group-text">
                <i class="fa fa-user">
                </i>
            </span>
      <input type="text" class="form-control" name="city" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" name="state" class="form-control">
        <option selected>Choose...</option>
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" name="zip" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" name="check" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
</form>