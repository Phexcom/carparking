

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
       Car
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
            <a class="app-notifications" href="notifications/index.html">
              <span class="icon icon-bell"></span>
            </a>
          </li>
          <li>
            <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="popover">
              <img class="img-circle" src="images/profile.jpg">
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
          <li><a href="#">Logout</a></li>
        </ul>

        <ul class="nav navbar-nav hidden">
          <li><a href="login/index.html">Logout</a></li>
        </ul>
      </div>
  </div>
</nav>



<div class="container p-t-md">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default panel-profile m-b-md">
        <div class="panel-heading" style="background-image: url(images/car.jpg);"></div>
        <div class="panel-body text-center">
          <a href="profile/index.html">
            <img
              class="panel-profile-img"
              src="images/profile.jpg">
          </a>

          <h5 class="panel-title">
            <a class="text-inherit" href="profile/index.html">Dave Gamache</a>
          </h5>

          <p class="m-b-md">I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.</p>

          <ul class="panel-menu">
            <li class="panel-menu-item">
              <a href="#userModal" class="text-inherit" data-toggle="modal">
                Parked Cars
                <h5 class="m-y-0">12M</h5>
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
          <h5 class="m-t-0">About <small>· <a href="#">Edit</a></small></h5>
          <ul class="list-unstyled list-spaced">
            <li><span class="text-muted icon icon-calendar m-r"></span>Name <a href="#">Oh, Canada</a>
            <li><span class="text-muted icon icon-users m-r"></span>Email <a href="#">Obama</a>
            <li><span class="text-muted icon icon-location-pin m-r"></span>Lives in <a href="#">Seattle, WA</a>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <ul class="list-group media-list media-list-stream">

        <li class="media list-group-item p-a">
          <a type="button" class="btn btn-info-outline btn-block btn-lg" data-toggle="modal" data-target="#car">Park A Car</a>
        </li>

      
        <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted">34 min</small>
              <h5>Mark Otto</h5>
            </div>

            <p>
              Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
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
          <h5 class="m-t-0">Manage Credit Cards</h5>
          <p><strong>It might be time to visit Iceland.</strong> Iceland is so chill, and everything looks cool here. Also, we heard the people are pretty nice. What are you waiting for?</p>
          <button class="btn btn-primary-outline btn-sm">Manage Credit Cards</button>
        </div>
      </div>
   
    </div>
  </div>
</div>