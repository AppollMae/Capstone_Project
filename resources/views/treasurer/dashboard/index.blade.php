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

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-chart-line"></i>
            <div data-i18n="Layouts">Quick Stat</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Total payments collected</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Pending payments</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Overdue fees</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Number of permits issued</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">History payments</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-cash-register"></i>
            <div data-i18n="Layouts">Payment Management</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without menu">Pending Payments</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Confirmed Payments</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Overdue Fees / Payments</div>
              </a>
            </li>

          </ul>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-receipt"></i>
            <div data-i18n="Layouts">Transactions / Receipts</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">View full transaction history.</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Generate receipts for applicants.</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">Generate receipts for applicants.</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-wallet"></i>
            <div data-i18n="Layouts">Applicant Billing</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Without navbar">View applicant balances and dues.</div>
              </a>
            </li>

          </ul>
        </li>

        <!-- <li class="menu-item">
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
        </li> -->



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
              <a href="{{ route('accounts.treasurer.view-accounts') }}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('accounts.treasurer.edit-accounts' , Auth::user()->id) }}" class="menu-link">
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
                  <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                    class="w-px-120 h-px-120 rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
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
                          } elseif($role === 'treasurer'){
                          $roleLabel = 'Treasurer';
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
                <li>
                  <a class="dropdown-item" href="">
                    <i class="bx bx-cog me-2"></i>
                    <span class="align-middle">Settings</span>
                  </a>
                </li>
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
            <h4 class="fw-bold mb-4">
              <i class="fa-solid fa-coins text-warning me-2"></i>
              Treasurer Dashboard
            </h4>

            <div class="row">
              <!-- Total Collections -->
              <div class="col-md-4 pt-3">
                <div class="card shadow-sm border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-sack-dollar fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-bold">TOTAL COLLECTIONS</h5>
                    <p class="text-muted mb-2">Overall revenue collected</p>
                    <strong style="font-size:2.5rem; color:#28a745;">₱120,000</strong>
                  </div>
                </div>
              </div>

              <!-- Pending Payments -->
              <div class="col-md-4 pt-3">
                <div class="card shadow-sm border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-hourglass-half fa-3x text-warning mb-3"></i>
                    <h5 class="card-title fw-bold">PENDING PAYMENTS</h5>
                    <p class="text-muted mb-2">Awaiting settlement</p>
                    <strong style="font-size:2.5rem; color:#ffc107;">₱35,000</strong>
                  </div>
                </div>
              </div>

              <!-- Processed Permits -->
              <div class="col-md-4 pt-3">
                <div class="card shadow-sm border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-file-invoice-dollar fa-3x text-primary mb-3"></i>
                    <h5 class="card-title fw-bold">PROCESSED PERMITS</h5>
                    <p class="text-muted mb-2">Total permits issued</p>
                    <strong style="font-size:2.5rem; color:#007bff;">48</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- Second Row for Insights -->
            <div class="row mt-4">
              <!-- Monthly Revenue -->
              <div class="col-md-6 pt-3">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">
                      <i class="fa-solid fa-chart-line text-success me-2"></i>
                      Monthly Revenue Trends
                    </h5>
                    <p class="text-muted">Overview of collections for this month</p>
                    <div id="monthlyChart" style="height: 250px;"></div>
                  </div>
                </div>
              </div>

              <!-- Recent Transactions -->
              <div class="col-md-6 pt-3">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">
                      <i class="fa-solid fa-receipt text-primary me-2"></i>
                      Recent Transactions
                    </h5>
                    <ul class="list-group list-group-flush mt-3">
                      <li class="list-group-item d-flex justify-content-between">
                        <span>Permit #2025-001</span>
                        <strong class="text-success">₱5,000</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between">
                        <span>Permit #2025-002</span>
                        <strong class="text-success">₱2,500</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between">
                        <span>Permit #2025-003</span>
                        <strong class="text-success">₱8,000</strong>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              © <script>
                document.write(new Date().getFullYear());
              </script>
              , Building Permit Management System — Treasurer Module
            </div>
            <div>
              <a href="#" class="footer-link me-4">Support</a>
              <a href="#" class="footer-link me-4">Documentation</a>
              <a href="#" class="footer-link me-4">Contact Us</a>
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