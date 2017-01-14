<br>
<div class="container">
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible hidden-xs center">
       <strong><?=$this->session->flashdata('message')?></strong>
    </div>
<?php endif; ?>
</div>

<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-size:1.8em; font-weight:bold; font-family:ubuntu;">
        <?php echo $title; ?>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse-main">

        <ul class="nav navbar-nav hidden-xs">
          <li class="active">
            <a href="#">Home</a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
          <li >
            <a class="app-notifications" href="#">
              <span class="icon icon-bell"></span>
            </a>
          </li>
          <li>
            <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="popover">
              <img class="img-circle" src="">
            </button>
          </li>
        </ul>

        <form class="navbar-form navbar-right app-search" role="search">
          <div class="form-group">
            <input type="text" class="form-control" data-action="grow" placeholder="Search">
          </div>
        </form>

        <ul class="nav navbar-nav hidden-sm hidden-md hidden-lg">
          <li><a href="#">Home</a></li>
          <li><a href="/account/logout">Logout</a></li>
        </ul>

        <ul class="nav navbar-nav hidden">
          <li><a href="/account/logout">Logout</a></li>
        </ul>
      </div>
  </div>
</nav>



<div class="container p-t-md">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default panel-profile m-b-md">
        <div class="panel-heading" style="background-image: url(/images/car.jpg);"></div>
        <div class="panel-body text-center">
          <a href="/account/edituser/">
            <img
              class="panel-profile-img"
              src="">
          </a>

          <h5 class="panel-title">
            <a class="text-inherit" href="#">Admin</a>
          </h5>

          <p class="m-b-md">I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.</p>

          <ul class="panel-menu">
            <li class="panel-menu-item">
              <a href="#userModal" class="text-inherit" data-toggle="modal">
                Amount Owe
                <h5 class="m-y-0">AED 12</h5>
              </a>
            </li>

            <li class="panel-menu-item">
              <a href="#" class="text-inherit" data-toggle="modal">
                Fines
                <h5 class="m-y-0">1</h5>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
          <h5 class="m-t-0">About <small>· <a href="/account/edituser/">Edit</a></small></h5>
          <ul class="list-unstyled list-spaced">
            <li><span class="text-muted icon icon-calendar m-r"></span>Name: <a href="#">Admin Nma</a>
            <li><span class="text-muted icon icon-users m-r"></span>Email: <a href="#">Admin Emil</a>
            <li><span class="text-muted icon icon-location-pin m-r"></span>Lives in <a href="#">Admin Adress</a>
          </ul>
        </div>
      </div>

      
    </div>

    <div class="col-md-6">
      <ul class="list-group media-list media-list-stream">
      <li>
      
      </li>
        <li class="media list-group-item p-a">
          <h3 class="center">Parked Cars</h3>
        </li>

      
        <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted"><strong>No Of Hours: </strong></small>
              <p><strong>Car Registration Number: </strong></p>
            </div>

            <p>
                <strong>Time Car was Parked: </strong>
            </p>
            <p>
                <strong>Parking Location: </strong>
            </p>
            <p>
                <strong>Parking Cost: </strong>AED
            </p>
              
          </div>
        </li>
       
      </ul>
    </div>
    <div class="col-md-3">
      <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Counter When PArked
      </div>

       <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h4 class="m-t-0">Location</h4>
          <a href="/account/addcar" class="btn btn-primary-outline btn-sm">Add New Location</a>
          <hr>
          <ul style="list-style-type:none;">
            <li>
              <strong>Location Code: </strong>
            </li>
            <li>
              <strong>Location name: </strong>
            </li>
            <li>
              <strong>Price Vat: </strong>
            </li>
          </ul>
          <a href="/account/editcar/" class="btn btn-warning-outline btn-sm">Edit Location</a>
          <a class="btn btn-danger-outline btn-sm">Delete Car</a>
          <!-- <hr> -->
         
        </div>
      </div>
code
name
price
vat

     

     
   
    </div>
  </div>
</div>