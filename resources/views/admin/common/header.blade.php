<nav class="top-menu">
  <div class="menu-icon-container hidden-md-up">
    <div class="animate-menu-button left-menu-toggle">
      <div><!-- --></div>
    </div>
  </div>
  <div class="menu">
    <div class="logo-menu-responsive"><img src="assets/img/logo-icon.png"/></div>
    <div class="menu-user-block">
      <div class="dropdown dropdown-avatar"> <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span class="avatar" href="javascript:void(0)"> <img src="assets/img/user.png" alt=""> </span> </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
          <a class="dropdown-item" href="{{url('change-password')}}"><i class="dropdown-icon icmn-user"></i> Change Password</a>
          <a class="dropdown-item" href="{{url('change-email')}}"><i class="fa fa-envelope" aria-hidden="true"></i> Change Email</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ url('/logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              <i class="dropdown-icon icmn-exit"></i> Logout
                          </a>

                          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
        </ul>
      </div>
    </div>
  </div>
</nav>
