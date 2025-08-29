@extends('layouts.app')

@section('content')

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="{{ route('obo.dashboard') }}" class="app-brand-link">
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
          <a href="{{ route('obo.dashboard') }}" class="menu-link">
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
                <div data-i18n="Without menu">Total permits applied</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">approved / pending / rejected</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Number of inspections scheduled/completed</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Revenue collected from permit fees</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Notifications for pending tasks</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-file-arrow-up"></i>
            <div data-i18n="Layouts">Permit Applications</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu"> Pending Applications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Approved Applications</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Rejected Applications</div>
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
            <i class="menu-icon fa-solid fa-calendar-check"></i>
            <div data-i18n="Layouts">Inspections & Scheduling</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Schedule inspections (structural, electrical, plumbing, etc.)</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Assign inspectors to projects</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Update inspection results</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">View inspection calendar and upcoming tasks</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-comments-dollar"></i>
            <div data-i18n="Layouts">Payments & Fees</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Verify payment records</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Manage payment statuses (Paid/Unpaid)</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Generate receipts and reports</div>
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
              <a href="{{ route('obo.accounts.view-accounts') }}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('obo.accounts.edit-accounts', Auth::user()->id) }}" class="menu-link">
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
                  <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt
                    class="w-px-120 h-px-120 rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt
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
                          $roleLabel = 'Building Official';
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
            <!-- Dashboard Title -->
            <div class="text-center mb-4">
              <h3 class="fw-bold text-success mb-1">
                <i class="fa-solid fa-building-columns me-2"></i>
                Office of the Building Official (OBO)
              </h3>
              <p class="text-muted">Monitoring and Analytics for Local Development</p>
            </div>
            <div class="row g-4">
              <!-- Total Applications -->
              <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow transition">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-file-contract fa-2x mb-3" style="color:#007bff;"></i>
                    <h5 class="fw-bold text-dark">TOTAL APPLICATIONS RECEIVED</h5>
                    <p class="text-muted mb-3">
                      Number of all <span class="fw-bold text-danger">building permit applications</span> filed
                    </p>
                    <div class="d-flex justify-content-center align-items-center" style="height: 8rem;">
                      <strong style="font-size:6rem; background: linear-gradient(45deg, #007bff, #00c6ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        120
                      </strong>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Approved Permits -->
              <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow transition">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-circle-check fa-2x mb-3" style="color:#28a745;"></i>
                    <h5 class="fw-bold text-dark">APPROVED PERMITS</h5>
                    <p class="text-muted mb-3">
                      Total <span class="fw-bold text-danger">approved</span> building permits
                    </p>
                    <div class="d-flex justify-content-center align-items-center" style="height: 8rem;">
                      <strong style="font-size:6rem; background: linear-gradient(45deg, #28a745, #6ddf5f); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        85
                      </strong>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Applications -->
              <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow transition">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-hourglass-half fa-2x mb-3" style="color:#ffc107;"></i>
                    <h5 class="fw-bold text-dark">PENDING APPLICATIONS</h5>
                    <p class="text-muted mb-3">
                      Applications currently <span class="fw-bold text-danger">under review</span>
                    </p>
                    <div class="d-flex justify-content-center align-items-center" style="height: 8rem;">
                      <strong style="font-size:6rem; background: linear-gradient(45deg, #ffc107, #ffdd57); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        35
                      </strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Additional row for insights -->
            <div class="row g-4 mt-2">
              <!-- Site Inspections -->
              <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow transition">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-helmet-safety fa-2x mb-3" style="color:#17a2b8;"></i>
                    <h5 class="fw-bold text-dark">SITE INSPECTIONS COMPLETED</h5>
                    <p class="text-muted">Number of inspection visits completed this month</p>
                    <strong style="font-size:4.5rem; background: linear-gradient(45deg, #17a2b8, #72e6f8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                      15
                    </strong>
                  </div>
                </div>
              </div>

              <!-- Revenue Collected -->
              <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow transition">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-coins fa-2x mb-3" style="color:#6c757d;"></i>
                    <h5 class="fw-bold text-dark">TOTAL REVENUE COLLECTED</h5>
                    <p class="text-muted">Total fees collected for approved permits</p>
                    <strong style="font-size:4.5rem; background: linear-gradient(45deg, #6c757d, #adb5bd); background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                      ₱250,000
                    </strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme mt-4">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column border-top pt-3">
            <div class="mb-2 mb-md-0 text-muted">
              © <script>
                document.write(new Date().getFullYear());
              </script>, powered by
              <span class="fw-bold text-danger">OBO Management System</span>
            </div>
            <div>
              <a href="#" class="footer-link me-4 text-muted">Help</a>
              <a href="#" class="footer-link me-4 text-muted">Support</a>
              <a href="#" class="footer-link text-muted">Documentation</a>
            </div>
          </div>
        </footer>
        <!-- /Footer -->

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