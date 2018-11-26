
<!-- Logo -->
    <a href="dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="{{ URL::to('/') }}/assets/app-icon.png" alt="">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" >
        <img src="{{ URL::to('/') }}/assets/app-icon.png" alt="" style="margin-top: 0px;width:70px;">
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- <li class="points-list">Points Earned : <span>467</span></li> -->
          <!-- user menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle user-drop" data-toggle="dropdown">
              <img src="{{ URL::to('/') }}/dist/img/user2.png" class="user-image " alt="User Image">
            </a><!-- profile image -->
            <ul class="dropdown-menu login-dropdown-menu">
              <!-- The user image in the menu -->
              <li>
                <a href="#">
                  <div class="name-details">
                    <img src="{{ URL::to('/') }}/dist/img/user2.png" class="user-image" alt="User Image">
                    <h5>Jattin</h5>
                    <span>Jarora1994@gmail.com</span>
                  </div>
                </a>
              </li>

              <!-- <li>
                <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> Your Account</a>
              </li> -->

              <li>
                <a href="{{ route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
              </li>

            </ul>
            <input type="hidden" id="adUserId" name="adUserId" value="1" />
          </li>

            <!-- notification-menu -->
          <li class="dropdown notifications-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i><span class="badge">0</span>
            </a>
            
            <ul class="dropdown-menu notification-dropdown">
              <h4>Notifications</h4>
                <!-- <li>
                  <a href="#">
                    <div class="notification-bell">
                      <div class="notification-icon">
                       <i class="fa fa-envelope" aria-hidden="true"></i>
                      </div>

                      <div class="notification-text">
                        <span>John Doe</span>
                        <p>Lorem Ipsum is simply.</p>
                      </div>
                    </div>
                  </a>
                </li>

                <li>
                  <a href="#">
                    <div class="notification-bell">
                      <div class="notification-icon">
                       <i class="fa fa-envelope" aria-hidden="true"></i>
                      </div>

                      <div class="notification-text">
                        <span>John Doe</span>
                        <p>Lorem Ipsum is simply.</p>
                      </div>
                    </div>
                  </a>
                </li> -->
            </ul>
          </li>
        </ul>
      </div>
    </nav>