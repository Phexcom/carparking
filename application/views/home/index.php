 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <a href="#" class="navbar-brand" style="font-size:1.8em; font-weight:bold; font-family:ubuntu;">Car Parking</a>
      </a>
    </div>
  </div>
</nav>


<div class="container">
  <!-- start jumbotron -->
  <div class="jumbotron center">
    <h1>Car Parking</h1>
    <p>Do you Already Have an Account?</p>
    <p>
      <?php echo anchor('account/login','Login now!',['class'=>'btn btn-success btn-lg']); ?>
    </p>
    <p>If not?</p>
    <p><a href="/register" class="btn btn-danger btn-lg" >Register Now!</a></p>

  </div>
  <!-- end jumbotron -->

</div>

