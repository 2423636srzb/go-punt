<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('index') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="site logo" class="light-logo" width="180">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo" width="180">
            <img src="{{ asset('assets/images/logo-dark.png') }}" width="43" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">
                <a href="{{ route('users.dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('users.payment_request') }}">
                    <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
                    <span>Payment Request</span>
                </a>
            </li>

            <li>
                <a href="{{ route('users.user_profile') }}">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Setting</span>
                </a>
            </li>
        </ul>
    </div>
</aside>