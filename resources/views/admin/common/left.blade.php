<nav class="left-menu" left-menu>
  <div class="logo-container"> <a href="{{ route('admin.dashboard') }}" class="logo"> <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" /> <img class="logo-inverse" src="{{ asset('assets/img/logo.png') }}" alt="" /> </a> </div>
  <div class="left-menu-inner scroll-pane">
    <ul class="left-menu-list left-menu-list-root list-unstyled">
      <li class="{{@$is_dashboard}}"> <a class="left-menu-link" href="{{url('dashboard')}}"> <i class="left-menu-link-icon icmn-meter"><!-- --></i> Dashboard </a> </li>
       <li class="{{@$is_balance}}"> <a class="left-menu-link" href="{{url('balance')}}"> <i class="counter-icon icmn-cash3"><!-- --></i> Balance </a> </li>
        <li class="{{@$is_send}}"> <a class="left-menu-link" href="{{url('send')}}"> <i class="icmn-paperplane"><!-- --></i> Send Token </a> </li>
<!--      <li class="{{@$is_wallet}}"> <a class="left-menu-link" href="{{url('wallet')}}"> <i class="left-menu-link-icon icmn-wallet"> </i> Wallet </a> </li>
      <li class="{{@$is_send}}"> <a class="left-menu-link" href="{{url('send')}}"> <i class="left-menu-link-icon icmn-drawer-out"> </i> Send </a> </li>
      <li class="{{@$is_receive}}"> <a class="left-menu-link" href="{{url('receive')}}"> <i class="left-menu-link-icon icmn-drawer-in"> </i> Receive </a> </li>
      <li class="{{@$is_profile}}"> <a class="left-menu-link" href="{{url('profile')}}"> <i class="left-menu-link-icon icmn-user"> </i> Profile </a> </li>
      <li class="{{@$is_mine}}"> <a class="left-menu-link" href="{{url('mine')}}"> <i class="left-menu-link-icon icmn-stats-growth"> </i> Mine </a> </li>
      <li class="{{@$is_block}}"> <a class="left-menu-link" href="{{url('block')}}">
      
        <i class="left-menu-link-icon icmn-direction"> </i> Blocks </a> </li>-->
    </ul>
  </div>
</nav>