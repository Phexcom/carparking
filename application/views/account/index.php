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
              <img class="img-circle" src="/images/profile.jpg">
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
          <a href="profile/index.html">
            <img
              class="panel-profile-img"
              src="/images/profile.jpg">
          </a>

          <h5 class="panel-title">
            <a class="text-inherit" href="#"><?php echo $name; ?></a>
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
          <h5 class="m-t-0">About <small>· <a href="/account/edituser">Edit</a></small></h5>
          <ul class="list-unstyled list-spaced">
            <li><span class="text-muted icon icon-calendar m-r"></span>Name: <a href="#"><?php echo $name; ?></a>
            <li><span class="text-muted icon icon-users m-r"></span>Email: <a href="#"><?php echo $email; ?></a>
            <li><span class="text-muted icon icon-location-pin m-r"></span>Lives in <a href="#"><?php echo $address; ?></a>
          </ul>
        </div>
      </div>

      <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h5 class="m-t-0">Edit Credit Cards</h5>
          <p><strong>It might be time to visit Iceland.</strong> Iceland is so chill, and everything looks cool here. Also, we heard the people are pretty nice. What are you waiting for?</p>
          <button class="btn btn-primary-outline btn-sm">Manage Credit Cards</button>
        </div>
      </div>

    </div>

    <div class="col-md-6">
      <ul class="list-group media-list media-list-stream">

        <li class="media list-group-item p-a">
          <a href="/account/parkcar" type="button" class="btn btn-primary-outline btn-block btn-lg">Park A Car</a>
        </li>
        <li class="media list-group-item p-a">
          <h3 class="center">Parked Cars</h3>
        </li>

      <?php foreach ($parkings as $parking): ?>
        <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted"><strong>No Of Hours: <?= $parking->no_hour; ?></strong></small>
              <p><strong>Car Registration Number: </strong><?= $parking->reg_id; ?></p>
            </div>

            <p>
                <strong>Time Car was Parked: </strong><?= $parking->date_time; ?>
            </p>
            <p>
                <strong>Parking Location: </strong><?= $parking->name; ?>
            </p>
            <p>
                <strong>Parking Cost: </strong><?= $parking->amount; ?>
            </p>
               <a class="btn btn-danger-outline btn-sm"
                  href="/account/unpark/<?php echo($parking->id) ;?>">
                  Unpark this car
               </a>
          </div>
        </li>
        <?php endforeach; ?> 
      </ul>
    </div>
    <div class="col-md-3">
      <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Counter When PArked
      </div>

       <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h4 class="m-t-0">Manage Cars</h4>
          <a href="/account/addcar" class="btn btn-primary-outline btn-sm">Add a new Car</a>
          <?php foreach ($cars as $car): ?>
          <hr>
          <ul style="list-style-type:none;">
            <li>
              <strong>Car Registration No: </strong><?= $car->getRegId()?>
            </li>
            <li>
              <strong>Car Color: </strong><?= $car->getColor()?>
            </li>
            <li>
              <strong>Car Brand: </strong><?= $car->getBrand()?>
            </li>
            <li>
              <strong>Car Make: </strong><?= $car->getMake()?>
            </li>
          </ul>
          <a href="/account/editcar/<?php echo($car->getRegId()); ?>" class="btn btn-warning-outline btn-sm">Edit Car</a>
          <a class="btn btn-danger-outline btn-sm">Delete Car</a>
          <!-- <hr> -->
          <?php endforeach; ?> 
        </div>
      </div>

     
   
    </div>
  </div>
</div>