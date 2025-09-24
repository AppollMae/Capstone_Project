@extends('layouts.app')

@section('content')

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
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
          <a href="{{ route('admin.dashboard') }}" class="menu-link">
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
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Total permits issued</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Pending applications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Approved applications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Rejected applications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Revenue from permit fees</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-chart-simple"></i>
            <div data-i18n="Layouts">Graph/Charts</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Monthly application trends</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Approval rates</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-building"></i>
            <div data-i18n="Layouts">Permit Applications</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">All Applications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Pending Review</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Approved & Rejected</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-file-invoice-dollar"></i>
            <div data-i18n="Account Settings">Payment Management</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Account">Application fees</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Notifications">Renewal fees</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Notifications">Pending Payments</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Notifications">Completed Payments</div>
              </a>
            </li>
          </ul>
        </li>



        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Accounts Settings / User Management</span>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user"></i>
            <div data-i18n="Account Settings">Account Settings</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin.accounts.view-accounts') }}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('admin.accounts.edit-account', Auth::user()->id) }}" class="menu-link">
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


        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-list-check"></i>
            <div data-i18n="Account Settings">User Management</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin.user_management.user-list') }}" class="menu-link">
                <div data-i18n="Account">Staff/Inspector</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('admin.user_management.applicant-user-list') }}" class="menu-link">
                <div data-i18n="Notifications">Applicant</div>
              </a>
            </li>
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
                  <img src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                    class="w-px-120 h-px-120 rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                            class="w-px-120 h-px-120 rounded-circle" />
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
            <!-- Page Title -->
            <div class="mb-4 text-center text-md-start">
              <h4 class="fw-bold text-dark">
                <i class="fa-solid fa-tachometer-alt me-2 text-primary"></i>
                Super Admin Dashboard
              </h4>
              <p class="text-muted mb-0">Overview of system performance and key building permit stats.</p>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4">
              <!-- Total Applications -->
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-file-circle-plus fa-2x text-primary mb-2"></i>
                    <h6 class="fw-bold text-uppercase small">Total Applications</h6>
                    <h3 class="fw-bolder text-primary mb-1" id="totalApplications">{{ $TotalUsers }}</h3>
                    <p class="text-muted small mb-0">All applications submitted</p>
                  </div>
                </div>
              </div>

              <!-- Pending Approvals -->
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-hourglass-half fa-2x text-warning mb-2"></i>
                    <h6 class="fw-bold text-uppercase small">Pending Approvals</h6>
                    <h3 class="fw-bolder text-warning mb-1" id="pendingApprovals">{{ $pendingApplications }}</h3>
                    <p class="text-muted small mb-0">Awaiting review</p>
                  </div>
                </div>
              </div>

              <!-- Under Review -->
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-magnifying-glass fa-2x text-warning mb-2"></i>
                    <h6 class="fw-bold text-uppercase small">Under Review</h6>
                    <h3 class="fw-bolder text-warning mb-1" id="pendingApprovals">{{$underReviewCounts}}</h3>
                    <p class="text-muted small mb-0">Awaiting review</p>
                  </div>
                </div>
              </div>

              <!-- Approved Permits -->
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-circle-check fa-2x text-success mb-2"></i>
                    <h6 class="fw-bold text-uppercase small">Approved Permits</h6>
                    <h3 class="fw-bolder text-success mb-1" id="approvedPermits">{{ $approvedApplications }}</h3>
                    <p class="text-muted small mb-0">Successfully issued permits</p>
                  </div>
                </div>
              </div>

              <!-- Revenue Collected -->
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-peso-sign fa-2x text-info mb-2"></i>
                    <h6 class="fw-bold text-uppercase small">Revenue Collected</h6>
                    <h3 class="fw-bolder text-info mb-1" id="totalRevenue">₱120,500</h3>
                    <p class="text-muted small mb-0">Total fees collected</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="row mt-4 g-4">
              <!-- System Activity -->
              <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body">
                    <h5 class="fw-bold mb-3">
                      <i class="fa-solid fa-chart-line me-2 text-info"></i> System Activity
                    </h5>
                    <p class="text-muted small mb-3">Overview of weekly permit activities.</p>
                    <div id="activityChart" style="height: 300px;" class="d-flex align-items-center justify-content-center">
                      <p class="text-center text-muted">[Activity chart coming soon]</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Recent Activities -->
              <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body">
                    <h5 class="fw-bold mb-3">
                      <i class="fa-solid fa-clock-rotate-left me-2 text-secondary"></i> Recent Activities
                    </h5>
                    <ul class="list-group list-group-flush small">
                      <li class="list-group-item">
                        <i class="fa-solid fa-user-plus text-primary me-2"></i>
                        New applicant registered
                        <span class="text-muted float-end">2 mins ago</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa-solid fa-file-signature text-success me-2"></i>
                        Permit approved for Building #123
                        <span class="text-muted float-end">15 mins ago</span>
                      </li>
                      <li class="list-group-item">
                        <i class="fa-solid fa-file-pen text-warning me-2"></i>
                        Application pending for review
                        <span class="text-muted float-end">1 hour ago</span>
                      </li>
                      <li class="list-group-item text-center">
                        <a href="#" class="text-primary small fw-bold">View All</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- User Management Table -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <h5 class="fw-bold mb-3">
                      <i class="fa-solid fa-users-gear me-2 text-primary"></i> User Management
                    </h5>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                          <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Seen</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($users as $user)
                          @php
                          $status = 'Offline';
                          $badgeClass = 'bg-danger';

                          if ($user->last_seen) {
                          $lastActivity = \Carbon\Carbon::parse($user->last_seen);

                          if ($lastActivity->gt(now()->subMinutes(5))) {
                          $status = 'Active';
                          $badgeClass = 'bg-success';
                          } elseif ($lastActivity->gt(now()->subMinutes(10))) {
                          $status = 'Idle';
                          $badgeClass = 'bg-warning';
                          }
                          }
                          @endphp
                          <tr>
                            <!-- Name -->
                            <td>{{ $user->name }}</td>

                            <!-- Role -->
                            <td>{{ ucfirst($user->role) }}</td>

                            <!-- Status -->
                            <td>
                              <span class="text-white px-3 py-2 rounded-pill shadow-sm fw-semibold {{ $badgeClass }}"
                                style="font-size: 0.9rem; letter-spacing: 0.5px;">
                                {{ $status }}
                              </span>
                            </td>


                            <!-- Last Seen -->
                            <td>
                              {{ $user->last_seen ? \Carbon\Carbon::parse($user->last_seen)->diffForHumans() : 'N/A' }}
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="4" class="text-center text-muted">No users found</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme mt-4">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column text-center text-md-start">
            <div class="mb-2 mb-md-0">
              © <script>
                document.write(new Date().getFullYear());
              </script>,
              <span class="fw-bold text-primary">Building Permit Management System</span>
            </div>
            <div>
              <a href="#" class="footer-link me-3">Documentation</a>
              <a href="#" class="footer-link me-3">Support</a>
              <a href="#" class="footer-link">Contact</a>
            </div>
          </div>
        </footer>
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