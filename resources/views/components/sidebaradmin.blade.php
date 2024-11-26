<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('index') }}" class="sidebar-logo">
            <?php $setting = DB::table('settings')->first(); ?>
            <img src="{{ asset($setting->logo) }}" alt="site logo" class="light-logo" width="180">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo" width="180">
            <img src="{{ asset('assets/images/logo-dark.png') }}" width="43" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('Game Management')
            <li>
                <a href="{{ route('games.index') }}">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Game Management</span>
                </a>
            </li>
            @endcan
            @can('Payment Request')
            <li>
                <a href="{{ route('admin.payment_request') }}">
                    <iconify-icon icon="mage:dollar" class="menu-icon"></iconify-icon>
                    <span>Payment Request</span>
                </a>
            </li>
            @endcan
          @can('Users Account')
            <li>
                <a href="{{ route('admin.users') }}">
                    <iconify-icon icon="cuida:users-outline" class="menu-icon"></iconify-icon>
                    <span>User Management</span>
                </a>
            </li>
            @endcan
          @can('Account Management')
            <li>
                <a href="{{ route('games.accounts') }}">
                    <iconify-icon icon="simple-line-icons:game-controller" class="menu-icon"></iconify-icon>
                    <span>Account Management</span>
                </a>

            </li>                     
          @endcan
            <li>
                <a href="{{route('admin.staff.setting')}}">
                    <iconify-icon icon="tdesign:user-setting"  class="menu-icon"></iconify-icon>
                    <span>Staff Management</span>
                </a>

            </li>
          
               
           
            @if(Auth::user()->is_admin)
            @can('Setting Management')
            <li>
                <a href="{{ route('admin.website.setting') }}">
                    <iconify-icon icon="uil:setting" class="menu-icon"></iconify-icon>
                    <span>Setting</span>
                </a>
            </li>
            @endcan
            @else
            <li>
                <a href="{{ route('users.user_profile') }}">
                    <iconify-icon icon="uil:setting" class="menu-icon"></iconify-icon>
                    <span>Setting</span>
                </a>
            </li>
            @endif

            <li>
                <a href="#">
                    <iconify-icon icon="carbon:analytics"  class="menu-icon"></iconify-icon>
                    <span>Google Analytics</span>
                </a>

            </li>
        </ul>
    </div>
</aside>