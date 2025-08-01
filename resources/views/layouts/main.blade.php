<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    {{-- DATATABLES BOOTSTRAP5 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
      /* GLOBAL Z-INDEX HIERARCHY */
      .navbar-pln {
        z-index: 9999 !important;
      }
      
      .dropdown-menu {
        z-index: 10000 !important;
      }
      
      .modal {
        z-index: 1055 !important;
      }
      
      .modal-backdrop {
        z-index: 1050 !important;
      }

      /* Custom PLN-inspired navbar styling */
      .navbar-pln {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        box-shadow: 0 4px 20px rgba(0, 116, 182, 0.15);
        border-bottom: 3px solid #ffd60a;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
      }
      
      body {
        padding-top: 70px;
        position: relative;
        z-index: 1;
      }

      .navbar-pln:hover {
        box-shadow: 0 6px 25px rgba(0, 116, 182, 0.2);
      }

      .navbar-brand {
        font-weight: 700;
        font-size: 1.8rem;
        color: #ffffff !important;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
      }

      .navbar-brand:hover {
        transform: translateY(-1px);
        color: #ffd60a !important;
      }

      .navbar-nav .nav-link {
        color: #ffffff !important;
        font-weight: 500;
        padding: 0.8rem 1.2rem !important;
        margin: 0 0.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .navbar-nav .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 214, 10, 0.2), transparent);
        transition: left 0.5s ease;
      }

      .navbar-nav .nav-link:hover::before {
        left: 100%;
      }

      .navbar-nav .nav-link:hover {
        color: #ffd60a !important;
        background: rgba(255, 214, 10, 0.1);
        transform: translateY(-2px);
      }

      .navbar-nav .nav-link.active {
        background: rgba(255, 214, 10, 0.2);
        color: #ffd60a !important;
        border: 1px solid rgba(255, 214, 10, 0.3);
        box-shadow: 0 2px 8px rgba(255, 214, 10, 0.2);
      }

      .navbar-toggler {
        border: 2px solid #ffffff;
        padding: 0.5rem 0.8rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        z-index: 10001 !important;
      }

      .navbar-toggler:hover {
        border-color: #ffd60a;
        background: rgba(255, 214, 10, 0.1);
      }

      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      .navbar-toggler:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 214, 10, 0.25);
      }

      /* DESKTOP DROPDOWN STYLING */
      .dropdown {
        position: relative !important;
      }
      
      .dropdown-toggle {
        position: relative !important;
        z-index: 10001 !important;
      }
      
      .dropdown-menu {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid rgba(255, 214, 10, 0.2);
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 119, 182, 0.25) !important;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        min-width: 200px !important;
        max-width: 300px !important;
        position: absolute !important;
        z-index: 10000 !important;
        display: none;
      }

      .dropdown-menu.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        pointer-events: auto !important;
      }

      .dropdown-item {
        color: #0077b6 !important;
        padding: 0.7rem 1.5rem;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 0.2rem 0.5rem;
        font-weight: 500;
        cursor: pointer !important;
        display: block !important;
        text-decoration: none !important;
      }

      .dropdown-item:hover,
      .dropdown-item:focus {
        background: linear-gradient(135deg, #ffd60a 0%, #ffed4a 100%) !important;
        color: #0077b6 !important;
        transform: translateX(5px);
        outline: none !important;
      }

      .dropdown-item.active {
        background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%) !important;
        color: #ffffff !important;
      }

      .dropdown-divider {
        border-color: rgba(255, 214, 10, 0.3);
        margin: 0.5rem 0;
      }

      .navbar-collapse {
        position: relative !important;
        z-index: 9998 !important;
      }

      /* PERFECT MOBILE DROPDOWN STYLING */
      @media (max-width: 991.98px) {
        .navbar-collapse {
          background: rgba(0, 180, 216, 0.95);
          margin-top: 1rem;
          border-radius: 12px;
          padding: 1rem;
          backdrop-filter: blur(10px);
          border: 1px solid rgba(255, 214, 10, 0.2);
          z-index: 9998 !important;
          position: relative !important;
        }

        .navbar-nav .nav-link {
          margin: 0.2rem 0;
          display: block !important;
          width: 100% !important;
        }

        /* MOBILE DROPDOWN - CRUCIAL FIXES */
        .dropdown {
          width: 100% !important;
          display: block !important;
        }

        .dropdown-toggle {
          display: block !important;
          width: 100% !important;
          text-align: left !important;
          position: relative !important;
          z-index: auto !important;
          padding: 12px 16px !important;
          min-height: 48px !important;
          background: none !important;
          border: none !important;
        }

        /* CRITICAL: Mobile dropdown menu positioning */
        .dropdown-menu {
          position: static !important; /* KEY FIX: Static positioning for mobile */
          display: none !important; /* Hidden by default */
          background: rgba(0, 100, 150, 0.9) !important;
          border: 1px solid rgba(255, 214, 10, 0.4) !important;
          border-radius: 8px !important;
          margin: 5px 0 0 0 !important;
          padding: 0.5rem 0 !important;
          width: 100% !important;
          box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.2) !important;
          z-index: auto !important;
          left: auto !important;
          top: auto !important;
          transform: none !important;
          opacity: 1 !important;
          visibility: visible !important;
          pointer-events: auto !important;
          float: none !important;
          clear: both !important;
        }

        /* CRITICAL: Show dropdown when active */
        .dropdown-menu.show {
          display: block !important;
        }

        /* MOBILE DROPDOWN ITEMS */
        .dropdown-item {
          color: #ffffff !important;
          padding: 12px 24px !important;
          margin: 2px 8px !important;
          border-radius: 6px !important;
          font-weight: 500 !important;
          min-height: 48px !important;
          line-height: 1.4 !important;
          display: flex !important;
          align-items: center !important;
          text-decoration: none !important;
          cursor: pointer !important;
          pointer-events: auto !important;
          position: relative !important;
          z-index: auto !important;
          width: calc(100% - 16px) !important;
        }

        .dropdown-item:hover,
        .dropdown-item:focus,
        .dropdown-item:active {
          background: rgba(255, 214, 10, 0.3) !important;
          color: #ffffff !important;
          transform: none !important;
          text-decoration: none !important;
        }

        .dropdown-item.active {
          background: rgba(255, 214, 10, 0.4) !important;
          color: #ffffff !important;
        }

        /* MOBILE DROPDOWN DIVIDER */
        .dropdown-divider {
          border-color: rgba(255, 214, 10, 0.4) !important;
          margin: 8px 16px !important;
        }

        /* Ensure dropdown parent is properly sized */
        .nav-item.dropdown {
          width: 100% !important;
          display: block !important;
          position: relative !important;
        }
      }

      /* Force all other elements to lower z-index */
      .container,
      .card,
      .table,
      .btn,
      .form-control,
      .input-group,
      main,
      section,
      article,
      aside,
      header,
      footer {
        position: relative;
        z-index: auto !important;
      }

      /* Smooth animations only for non-essential elements */
      .navbar-nav .nav-link,
      .dropdown-item,
      .navbar-brand {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }

      /* Touch device optimizations */
      @media (pointer: coarse) {
        .dropdown-toggle,
        .dropdown-item,
        .nav-link {
          min-height: 48px !important;
          padding: 12px 16px !important;
        }
      }
    </style>
  </head>
  <body>
    {{-- Professional PLN-inspired navbar --}}
    <nav class="navbar navbar-pln shadow-sm navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" style="height: 36px;">
                {{ env('APP_NAME') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('presence.*') ? 'active' : '' }}" href="{{ route('presence.index') }}">
                            <i class="fas fa-calendar-check me-1"></i> Daftar Kegiatan
                        </a>
                    </li>
                    
                    {{-- PERFECT MOBILE DROPDOWN - FINAL VERSION --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['companies.*', 'company-units.*', 'pln-members.*']) ? 'active' : '' }}" 
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" 
                           id="masterDataDropdown">
                            <i class="fas fa-database me-1"></i> Master Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('companies.*') ? 'active' : '' }}" 
                                   href="{{ route('companies.index') }}">
                                    <i class="fas fa-building me-2"></i> Data Perusahaan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('company-units.*') ? 'active' : '' }}" 
                                   href="{{ route('company-units.index') }}">
                                    <i class="fas fa-sitemap me-2"></i> Data Unit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('pln-members.*') ? 'active' : '' }}" 
                                   href="{{ route('pln-members.index') }}">
                                    <i class="fas fa-users me-2"></i> Daftar Anggota PLN
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-user-cog me-1"></i> Data User
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        {{-- Guest content --}}
                    @else
                        <li class="nav-item d-flex align-items-center me-2">
                            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }} text-white-50" href="{{ route('profile') }}">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-warning btn-sm" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-1"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Page Content --}}
    @yield('content')

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    {{-- DATATABLES CORE + BOOTSTRAP5 --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    {{-- ULTIMATE NAVBAR SCRIPT - FIXES ALL NAVIGATION ISSUES --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Ultimate Navbar Script Loaded');
            
            // Device detection
            const isMobile = () => window.innerWidth <= 991;
            const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
            
            console.log('📱 Device Info:', {
                isMobile: isMobile(),
                isTouchDevice: isTouchDevice,
                windowWidth: window.innerWidth
            });
            
            // CRITICAL FIX: Ensure all nav links work properly
            function setupNavLinks() {
                const allNavLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle)');
                console.log('🔗 Setting up', allNavLinks.length, 'nav links');
                
                allNavLinks.forEach(function(link, index) {
                    // Remove any existing event listeners
                    link.removeEventListener('click', handleNavLinkClick);
                    link.removeEventListener('touchend', handleNavLinkClick);
                    
                    function handleNavLinkClick(e) {
                        console.log('🔗 Nav link clicked:', link.textContent.trim(), 'href:', link.href);
                        
                        // Ensure link works
                        if (link.href && link.href !== '#' && !link.href.endsWith('#')) {
                            e.stopPropagation(); // Prevent any interference
                            
                            // Close navbar on mobile after clicking
                            if (isMobile()) {
                                const navbarCollapse = document.querySelector('#navbarSupportedContent');
                                const navbarToggler = document.querySelector('.navbar-toggler');
                                
                                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                                    console.log('📱 Closing navbar after nav link click');
                                    navbarCollapse.classList.remove('show');
                                    if (navbarToggler) {
                                        navbarToggler.setAttribute('aria-expanded', 'false');
                                    }
                                }
                            }
                            
                            // Navigate
                            setTimeout(() => {
                                console.log('🔗 Navigating to:', link.href);
                                window.location.href = link.href;
                            }, isMobile() ? 100 : 0);
                        }
                    }
                    
                    link.addEventListener('click', handleNavLinkClick);
                    
                    if (isTouchDevice) {
                        link.addEventListener('touchend', handleNavLinkClick);
                    }
                });
            }
            
            // Setup dropdown functionality
            function setupDropdown() {
                const dropdown = document.querySelector('.nav-item.dropdown');
                const dropdownToggle = document.querySelector('#masterDataDropdown');
                const dropdownMenu = document.querySelector('.dropdown-menu');
                
                if (!dropdown || !dropdownToggle || !dropdownMenu) {
                    console.log('ℹ️ Dropdown elements not found, skipping dropdown setup');
                    return;
                }
                
                console.log('✅ Setting up dropdown functionality');
                
                let isDropdownOpen = false;
                
                // Function to open dropdown
                function openDropdown() {
                    console.log('🔵 Opening dropdown');
                    dropdownMenu.classList.add('show');
                    dropdownToggle.setAttribute('aria-expanded', 'true');
                    isDropdownOpen = true;
                    
                    if (isMobile()) {
                        dropdownMenu.style.display = 'block';
                        dropdownMenu.style.position = 'static';
                        dropdownMenu.style.width = '100%';
                    }
                }
                
                // Function to close dropdown
                function closeDropdown() {
                    console.log('🔴 Closing dropdown');
                    dropdownMenu.classList.remove('show');
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                    isDropdownOpen = false;
                }
                
                // Toggle dropdown
                function toggleDropdown(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    if (isDropdownOpen) {
                        closeDropdown();
                    } else {
                        openDropdown();
                    }
                }
                
                // Setup dropdown toggle
                dropdownToggle.removeEventListener('click', toggleDropdown);
                dropdownToggle.addEventListener('click', toggleDropdown);
                
                if (isTouchDevice) {
                    dropdownToggle.addEventListener('touchend', function(e) {
                        e.preventDefault();
                        toggleDropdown(e);
                    });
                }
                
                // Desktop hover (non-touch only)
                if (!isTouchDevice && !isMobile()) {
                    dropdown.addEventListener('mouseenter', openDropdown);
                    dropdown.addEventListener('mouseleave', function() {
                        setTimeout(() => {
                            if (!dropdown.matches(':hover')) {
                                closeDropdown();
                            }
                        }, 100);
                    });
                }
                
                // Setup dropdown items
                const dropdownItems = document.querySelectorAll('.dropdown-item');
                dropdownItems.forEach(function(item) {
                    function handleDropdownItemClick(e) {
                        console.log('🔗 Dropdown item clicked:', item.textContent.trim(), 'href:', item.href);
                        
                        e.stopPropagation();
                        closeDropdown();
                        
                        // Close navbar on mobile
                        if (isMobile()) {
                            const navbarCollapse = document.querySelector('#navbarSupportedContent');
                            const navbarToggler = document.querySelector('.navbar-toggler');
                            
                            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                                navbarCollapse.classList.remove('show');
                                if (navbarToggler) {
                                    navbarToggler.setAttribute('aria-expanded', 'false');
                                }
                            }
                        }
                        
                        // Navigate
                        if (item.href && item.href !== '#') {
                            setTimeout(() => {
                                window.location.href = item.href;
                            }, isMobile() ? 150 : 50);
                        }
                    }
                    
                    item.removeEventListener('click', handleDropdownItemClick);
                    item.addEventListener('click', handleDropdownItemClick);
                    
                    if (isTouchDevice) {
                        item.addEventListener('touchend', handleDropdownItemClick);
                    }
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!dropdown.contains(event.target)) {
                        closeDropdown();
                    }
                });
                
                if (isTouchDevice) {
                    document.addEventListener('touchstart', function(event) {
                        if (!dropdown.contains(event.target)) {
                            closeDropdown();
                        }
                    });
                }
            }
            
            // CRITICAL: Setup navbar toggler
            function setupNavbarToggler() {
                const navbarToggler = document.querySelector('.navbar-toggler');
                const navbarCollapse = document.querySelector('#navbarSupportedContent');
                
                if (!navbarToggler || !navbarCollapse) {
                    console.log('ℹ️ Navbar toggler elements not found');
                    return;
                }
                
                console.log('✅ Setting up navbar toggler');
                
                function toggleNavbar(e) {
                    console.log('🍔 Navbar toggler clicked');
                    e.stopPropagation();
                    
                    const isExpanded = navbarToggler.getAttribute('aria-expanded') === 'true';
                    
                    if (isExpanded) {
                        navbarCollapse.classList.remove('show');
                        navbarToggler.setAttribute('aria-expanded', 'false');
                        console.log('📱 Navbar closed');
                    } else {
                        navbarCollapse.classList.add('show');
                        navbarToggler.setAttribute('aria-expanded', 'true');
                        console.log('📱 Navbar opened');
                    }
                }
                
                navbarToggler.removeEventListener('click', toggleNavbar);
                navbarToggler.addEventListener('click', toggleNavbar);
                
                if (isTouchDevice) {
                    navbarToggler.addEventListener('touchend', function(e) {
                        e.preventDefault();
                        toggleNavbar(e);
                    });
                }
            }
            
            // CRITICAL: Ensure navbar works on all pages
            function ensureNavbarFunctionality() {
                console.log('🔧 Ensuring navbar functionality on all pages');
                
                // Force remove any conflicting Bootstrap handlers
                const bootstrapTogglers = document.querySelectorAll('[data-bs-toggle]');
                bootstrapTogglers.forEach(el => {
                    if (el.getAttribute('data-bs-toggle') === 'dropdown') {
                        el.removeAttribute('data-bs-toggle');
                    }
                });
                
                // Ensure no z-index conflicts
                const navbar = document.querySelector('.navbar-pln');
                if (navbar) {
                    navbar.style.zIndex = '9999';
                    navbar.style.position = 'fixed';
                }
                
                // Ensure navbar collapse works
                const navbarCollapse = document.querySelector('#navbarSupportedContent');
                if (navbarCollapse) {
                    navbarCollapse.style.zIndex = '9998';
                }
            }
            
            // Initialize everything
            ensureNavbarFunctionality();
            setupNavbarToggler();
            setupNavLinks();
            setupDropdown();
            
            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    console.log('📏 Window resized, reinitializing navbar');
                    setupNavLinks();
                    
                    // Close any open elements on resize
                    const navbarCollapse = document.querySelector('#navbarSupportedContent');
                    const dropdownMenu = document.querySelector('.dropdown-menu');
                    
                    if (navbarCollapse && navbarCollapse.classList.contains('show') && !isMobile()) {
                        navbarCollapse.classList.remove('show');
                    }
                    
                    if (dropdownMenu && dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                    }
                }, 250);
            });
            
            // Debug functions
            window.debugNavbar = function() {
                console.log('=== 🔍 NAVBAR DEBUG ===');
                console.log('Window width:', window.innerWidth);
                console.log('Is mobile:', isMobile());
                console.log('Is touch device:', isTouchDevice);
                
                const navbar = document.querySelector('.navbar-pln');
                const navbarCollapse = document.querySelector('#navbarSupportedContent');
                const navbarToggler = document.querySelector('.navbar-toggler');
                const dropdownMenu = document.querySelector('.dropdown-menu');
                
                console.log('Navbar:', navbar);
                console.log('Navbar collapse:', navbarCollapse, 'has show:', navbarCollapse?.classList.contains('show'));
                console.log('Navbar toggler:', navbarToggler, 'aria-expanded:', navbarToggler?.getAttribute('aria-expanded'));
                console.log('Dropdown menu:', dropdownMenu, 'has show:', dropdownMenu?.classList.contains('show'));
                
                const allNavLinks = document.querySelectorAll('.navbar-nav .nav-link');
                console.log('Total nav links found:', allNavLinks.length);
                allNavLinks.forEach((link, i) => {
                    console.log(`Link ${i + 1}:`, link.textContent.trim(), 'href:', link.href);
                });
                
                console.log('=== 🔍 END DEBUG ===');
            };
            
            window.testNavbar = function() {
                console.log('🧪 Testing navbar toggle...');
                const navbarToggler = document.querySelector('.navbar-toggler');
                if (navbarToggler) {
                    navbarToggler.click();
                }
            };
            
            console.log('✅ Ultimate Navbar Setup Complete!');
            console.log('💡 Use debugNavbar() or testNavbar() in console for testing');
        });
    </script>

    @stack('js')
  </body>
</html>