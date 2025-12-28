@extends('layouts.app')

@section('content')

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="" class="app-brand-link">
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
          <a href="" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-envelope"></i>
            <div data-i18n="Layouts">My Applications</div>
          </a>

          <ul class="menu-sub">
            <!-- <li class="menu-item">
              <a href="{{ route('applicants.drafts.view-drafts') }}" class="menu-link">
                <div data-i18n="Without menu">Draft</div>
              </a>
            </li> -->
            <li class="menu-item">
              <a href="{{ route('applicants.drafts.pending-draft') }}" class="menu-link">
                <div data-i18n="Without navbar">Process</div>
              </a>
            </li>
            <!-- <li class="menu-item">
              <a href="{{ route('applicants.under-reviews.view-under-review') }}" class="menu-link">
                <div data-i18n="Without navbar">Under Review</div>
              </a>
            </li> -->

            <!-- <li class="menu-item">
              <a href="{{ route('applicants.permits.view-approved-permits') }}" class="menu-link">
                <div data-i18n="Without navbar">Approve</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Rejected</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Receipts or permits</div>
              </a>
            </li> -->
          </ul>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-ticket"></i>
            <div data-i18n="Layouts">Apply for Permit</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('applicants.permits.apply-permit') }}" class="menu-link">
                <div data-i18n="Without navbar">Apply Now</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('applicants.permits.view-issue-flags', Auth::user()->id) }}" class="menu-link">
                <div data-i18n="Without navbar">Issues</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-receipt"></i>
            <div data-i18n="Layouts">Payments</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Pending Payments</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Paid</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Overdue</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-comment"></i>
            <div data-i18n="Layouts">Notification / Messages</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Notifications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">History Notification</div>
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
              <a href="{{ route('applicants.accounts.applicants-view-accounts') }}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('applicants.accounts.applicants-edit-accounts', Auth::user()->id) }}" class="menu-link">
                <div data-i18n="Notifications">Update Account</div>
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
                  <img
                    src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}"
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
                            src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}"
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
                          } elseif ($role === 'treasurer') {
                          $roleLabel = 'Treasurer';
                          } else {
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
            <!-- Welcome Section -->
            <h3 class="mb-4 fw-bold text-primary text-center text-md-start">
              Welcome, {{ auth()->user()->name ?? 'Applicant' }}!
            </h3>
            <p class="text-muted text-center text-md-start">
              Here’s an overview of your application activity.
            </p>

            <!-- Stats Section -->
            <div class="row g-3">
              <!-- Notifications -->
              @if ($totalApprovedPermits > 0)
              <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-bell text-warning mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title">Total Notifications</h5>
                    <p class="card-text text-muted">All important updates about your applications</p>
                    <strong style="font-size: 2.5rem;">{{ $totalApprovedPermits }}</strong>
                  </div>
                </div>
              </div>
              @endif

              <!-- Draft Applications -->
              @if ($draftpermitcount > 0)
              <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-file-pen text-primary mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title">Draft Applications</h5>
                    <p class="card-text text-muted">Applications saved but not yet submitted</p>
                    <strong style="font-size: 2.5rem;">{{ number_format($draftpermitcount) }}</strong>
                  </div>
                </div>
              </div>
              @endif

              <!-- Pending Applications -->
              @if ($pendingCounts > 0)
              <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-clock text-warning mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title">Pending Applications</h5>
                    <p class="card-text text-muted">Applications saved but not yet submitted</p>
                    <strong style="font-size: 2.5rem;">{{ number_format($pendingCounts) }}</strong>
                  </div>
                </div>
              </div>
              @endif

              <!-- Under Review -->
              @if ($underReviewCount > 0)
              <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-hourglass-half text-info mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title">Under Review</h5>
                    <p class="card-text text-muted">Applications currently being reviewed</p>
                    <strong style="font-size: 2.5rem;">{{ $underReviewCount }}</strong>
                  </div>
                </div>
              </div>
              @endif

              <!-- Approved -->
              @if ($totalApprovePermits > 0)
              <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-circle-check text-success mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title">Approved</h5>
                    <p class="card-text text-muted">Applications currently being approved</p>
                    <strong style="font-size: 2.5rem;">{{ $totalApprovePermits }}</strong>
                  </div>
                </div>
              </div>
              @endif

              <!-- Rejected -->
              @if ($totalRejectedPermits > 0)
              <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100 animate__animated animate__bounceIn">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-thumbs-down text-danger mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title">Rejected</h5>
                    <p class="card-text text-muted">Applications currently being rejected</p>
                    <strong style="font-size: 2.5rem;">{{ $totalRejectedPermits }}</strong>
                  </div>
                </div>
              </div>
              @endif


            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="card shadow-sm">
                  <div class="card-body text-center text-md-start">
                    <h5 class="fw-bold mb-3">
                      <i class="fa-solid fa-bolt text-success me-2"></i> Quick Actions
                    </h5>

                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center justify-content-md-start">
                      <!-- Apply for Permit -->
                      <div class="flex-fill">
                        <a href="{{ route('applicants.permits.apply-permit') }}" class="btn btn-primary w-100">
                          <i class="fa-solid fa-plus-circle me-1"></i> Apply for Permit
                        </a>
                      </div>

                      <!-- My Applications (Dropdown) -->
                      <div class="dropdown flex-fill dropdown-hover">
                        <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa-solid fa-folder-open me-1"></i> My Applications
                        </button>
                        <ul class="dropdown-menu w-100">
                          <!-- <li>
                            <a class="dropdown-item" href="{{ route('applicants.drafts.view-drafts') }}">
                              <i class="fa-regular fa-file-lines me-1"></i> Draft
                            </a>
                          </li> -->
                          <li>
                            <a class="dropdown-item" href="{{ route('applicants.drafts.pending-draft') }}">
                              <i class="fa-solid fa-hourglass-half me-1"></i> Process
                            </a>
                          </li>
                          <!-- <li>
                            <a class="dropdown-item" href="{{ route('applicants.under-reviews.view-under-review') }}">
                              <i class="fa-solid fa-bars-progress me-1"></i> Under Review
                            </a>
                          </li> -->
                        </ul>
                      </div>

                      <div class="flex-fill">
                        <a href="" class="btn btn-outline-warning w-100">
                          <i class="fa-solid fa-bell me-1"></i> View Notifications
                        </a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme mt-4">
          <div
            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column text-center text-md-start">
            <div class="mb-2 mb-md-0">
              ©
              <script>
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