@extends('layouts.app')

@section('content')

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="{{ route('mpdo.dashboard') }}" class="app-brand-link">
          <span class="app-brand-logo demo">
          </span>
          <img src="{{asset('images/Logo.png')}}" alt="" style="width: 50px;">
          <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase">BPMS</span>
        </a>

        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
            </a> -->
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
          <a href="{{ route('mpdo.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <!-- Layouts -->

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-file"></i>
            <div data-i18n="Layouts">Quick Stat</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('mpdo.permit-applicants.view') }}" class="menu-link">
                <div data-i18n="Without menu">Active projects</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('mpdo.permit-applicants.view-ongoing-projects') }}" class="menu-link">
                <div data-i18n="Without menu">Ongoing building permits</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Completed projects</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Population and demographic updates</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-chart-simple"></i>
            <div data-i18n="Layouts">Visualizations</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu"> Maps of ongoing development zones</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Charts for project allocation and budgets</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-building"></i>
            <div data-i18n="Layouts">Development Projects</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">All Projects</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Ongoing</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Completed</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Proposed</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-chart-simple"></i>
            <div data-i18n="Layouts">Reports & Analytics</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Annual investment plans (AIP)</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Budget allocation and utilization</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Infrastructure development progress</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Population and demographic analysis</div>
              </a>
            </li>
          </ul>
        </li>



        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Accounts</span>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user"></i>
            <div data-i18n="Account Settings">Account Settings</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('mpdo.accounts.mpdo-view-accounts') }}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('mpdo.accounts.mpdo-edit-accounts', Auth::user()->id) }}" class="menu-link">
                <div data-i18n="Notifications">Update Account</div>
              </a>
            </li>
            <!-- <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications">Settings</div>
                  </a>
                </li> -->

          </ul>
        </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Miscellaneous</span>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Misc">Misc</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Under Maintenance">Logs</div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </aside>
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->

      <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">

            </div>
          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img
                    src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : asset('sneat/img/avatars/1.png') }}"
                    alt class="w-px-120 h-px-120 rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img
                            src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : asset('sneat/img/avatars/1.png') }}"
                            alt class="w-px-120 h-px-120 rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                        <small class="text-muted"> @php
                          $role = strtolower(auth()->user()->role);
                          if ($role === 'bfp') {
                          $roleLabel = 'BFP';
                          } elseif ($role === 'admin') {
                          $roleLabel = 'Admin';
                          } elseif ($role === 'mpdo') {
                          $roleLabel = 'MPDO';
                          } elseif($role === 'obo'){
                          $roleLabel = 'OBO';
                          }
                          else {
                          $roleLabel = 'User';
                          }
                          @endphp
                          {{ $roleLabel }}</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li>
                <!-- <li>
                      <a class="dropdown-item" href="">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li> -->
                <li>
                  <a class="dropdown-item" href="">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <span class="align-middle">Logs</span>
                  </a>
                </li>

                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle" style="color:#ff6347;">Log Out</span>
                  </a>
                  <form action="{{route('logout')}}" method="post" id="logout-form">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="container">
            <!-- Dashboard Title -->
            <div class="text-center mb-4">
              <h3 class="fw-bold text-success mb-1">
                <i class="fa-solid fa-building-columns me-2"></i>
                Municipal Planning and Development Dashboard
              </h3>
              <p class="text-muted">Monitoring and Analytics for Local Development</p>
            </div>

            <!-- Stat Cards -->
            <div class="row g-4">
              <!-- Total Participants -->
              @if (($totalApplicants ?? 0) > 0)
              <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm border-0 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <div class="text-success mb-2">
                      <i class="fa-solid fa-users fa-3x"></i>
                    </div>
                    <h6 class="fw-bold text-uppercase text-muted">Total Applicants</h6>
                    <h1 class="fw-bold text-success" style="font-size: 3.5rem;">{{ $totalApplicants }}</h1>
                    <p class="text-muted small mb-0">Registered for building permits</p>
                  </div>
                </div>
              </div>
              @endif

              <!-- Total Approved -->
              @if (($underReviewCountsPermits ?? 0) > 0)
              <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm border-0 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <div class="text-primary mb-2">
                      <i class="fa-solid fa-magnifying-glass fa-3x"></i>
                    </div>
                    <h6 class="fw-bold text-uppercase text-muted">Under Review</h6>
                    <h1 class="fw-bold text-primary" style="font-size: 3.5rem;">{{$underReviewCountsPermits}}</h1>
                    <p class="text-muted small mb-0">Successfully processed permits</p>
                  </div>
                </div>
              </div>
              @endif

              <!-- Total Approved -->
              @if (($approvePermits ?? 0) > 0)
              <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm border-0 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <div class="text-primary mb-2">
                      <i class="fa-solid fa-file-circle-check fa-3x"></i>
                    </div>
                    <h6 class="fw-bold text-uppercase text-muted">Approved Permits</h6>
                    <h1 class="fw-bold text-primary" style="font-size: 3.5rem;">{{ $approvePermits }}</h1>
                    <p class="text-muted small mb-0">Successfully processed permits</p>
                  </div>
                </div>
              </div>
              @endif


              <!-- Ongoing Projects -->
              @if(($ongoingProjects ?? 0) > 0)
              <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm border-0 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <div class="text-warning mb-2">
                      <i class="fa-solid fa-city fa-3x"></i>
                    </div>
                    <h6 class="fw-bold text-uppercase text-muted">Ongoing Projects</h6>
                    <h1 class="fw-bold text-warning" style="font-size: 3.5rem;">
                      {{ $ongoingProjects }}
                    </h1>
                    <p class="text-muted small mb-0">Currently under construction</p>
                  </div>
                </div>
              </div>
              @endif

            </div>

            <!-- Analytics Row -->
            <div class="row g-4 mt-4">
              <!-- Chart Section -->
              <div class="col-lg-8 col-12">
                <div class="card shadow-sm border-0">
                  <div class="card-header bg-success text-white fw-bold">
                    Permit Status Overview
                  </div>
                  <div class="card-body">
                    <canvas id="statusChart" height="150" data-chart-data='@json($chartData)'></canvas>
                  </div>
                </div>
              </div>

              <!-- Quick Insights -->
              <div class="col-lg-4 col-12">
                <div class="card shadow-sm border-0">
                  <div class="card-header bg-primary text-white fw-bold">
                    Quick Insights
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mb-0">
                      <li class="mb-2">
                        <i class="fa-solid fa-circle text-success me-2"></i> 70% Permits Approved
                      </li>
                      <li class="mb-2">
                        <i class="fa-solid fa-circle text-warning me-2"></i> 20% Pending Review
                      </li>
                      <li>
                        <i class="fa-solid fa-circle text-danger me-2"></i> 10% Declined or Returned
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 col-12">
                <div class="card shadow-sm border-0">
                  <div class="card-header bg-primary text-white fw-bold">
                    Monthly Permit Applications Overview
                  </div>
                  <div class="card-body">
                    <canvas id="monthChart" height="150" data-chart-data='@json($monthChartData)'></canvas>
                  </div>
                </div>
              </div>

            </div>

            <!-- Notice Section -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="alert alert-info border-0 shadow-sm">
                  <i class="fa-solid fa-circle-info me-2"></i>
                  Reminder: Submit quarterly reports to comply with <strong>Local Development Council</strong>
                  guidelines.
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme mt-4">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column small">
            <div class="mb-2 mb-md-0">
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              <span class="fw-bold text-secondary">Municipal Planning and Development Office Dashboard </span>
            </div>
            <div>
              <a href="#" class="footer-link me-4">License</a>
              <a href="#" class="footer-link me-4">Contact</a>
              <a href="#" class="footer-link me-4">Documentation</a>
              <a href="#" class="footer-link me-4">Support</a>
            </div>
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>

      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
@endsection