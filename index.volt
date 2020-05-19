{{ content() }}

  {{ flashSession.output() }}

  <div class="container">
    <h2>User's table</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Email</th>
          <th>Address</th>
          <th>Address 2</th>
          <th>City</th>
          <th>State</th>
          <th>Zip</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
       {% for user_test in users_test %}
             <tr>
                  <th>{{ user_test['id'] }}</th>
                  <th>{{ user_test['email'] }}</th>
                  <th>{{ user_test['address'] }}</th>
                  <th>{{ user_test['address2'] }}</th>
                  <th>{{ user_test['city'] }}</th>
                  <th>{{ user_test['state'] }}</th>
                  <th>{{ user_test['zip'] }}</th>
                  <th>{{ user_test['status'] }}</th>
                 <th><a href="/user_test/delete/{{ user_test['id'] }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></th>
             </tr>
         {% endfor %}
      </tbody>
    </table>
        <a href="/user_test/register/" class="btn btn-success">Insert new address</a>
<!--         <a href="/session/end/" class="btn btn-danger">Log out</a> -->
  </div>








