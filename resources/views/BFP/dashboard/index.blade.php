@extends('layouts.app')

@section('content')

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="{{ route('bfp.dashboard') }}" class="app-brand-link">
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
          <a href="{{ route('bfp.dashboard') }}" class="menu-link">
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
              <a href="{{ route('bfp.accounts.view-accounts') }}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('bfp.accounts.edit-accounts', Auth::user()->id) }}" class="menu-link">
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
                        <small class="text-muted">
                          @php
                          $role = strtolower(auth()->user()->role);
                          if ($role === 'bfp') {
                          $roleLabel = 'BFP';
                          } elseif ($role === 'admin') {
                          $roleLabel = 'Admin';
                          } elseif ($role === 'mpdo') {
                          $roleLabel = 'MPDO';
                          } elseif ($role === 'treasurer'){
                          $roleLabel = 'Treasurer';
                          } else {
                          $roleLabel = 'User';
                          }
                          @endphp
                          {{ $roleLabel }}
                        </small>
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
            <!-- Header -->
            <h4 class="fw-bold mb-4 text-danger">
              <i class="fa-solid fa-fire-extinguisher me-2"></i>
              Bureau of Fire Protection - Building Permit Dashboard
            </h4>

            <div class="row">
              <!-- Total Participants -->
              <div class="col-md-4 pt-3">
                <div class="card shadow border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-users fa-2x text-danger mb-2"></i>
                    <h6 class="card-title fw-bold">TOTAL APPLICANTS</h6>
                    <p class="text-muted">Registered applicants</p>
                    <strong style="font-size: 3rem; color: #d62828;">120</strong>
                  </div>
                </div>
              </div>

              <!-- Fire Safety Inspectors -->
              <div class="col-md-4 pt-3">
                <div class="card shadow border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-user-shield fa-2x text-primary mb-2"></i>
                    <h6 class="card-title fw-bold">INSPECTORS ASSIGNED</h6>
                    <p class="text-muted">Active fire safety officers</p>
                    <strong style="font-size: 3rem; color: #0077b6;">15</strong>
                  </div>
                </div>
              </div>

              <!-- Facilities Inspected -->
              <div class="col-md-4 pt-3">
                <div class="card shadow border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-city fa-2x text-success mb-2"></i>
                    <h6 class="card-title fw-bold">FACILITIES INSPECTED</h6>
                    <p class="text-muted">Buildings under fire safety inspection</p>
                    <strong style="font-size: 3rem; color: #28a745;">25</strong>
                  </div>
                </div>
              </div>

              <!-- Establishments Monitored -->
              <div class="col-md-4 pt-3">
                <div class="card shadow border-0">
                  <div class="card-body text-center">
                    <i class="fa-solid fa-city fa-2x text-dark mb-2"></i>
                    <h6 class="card-title fw-bold">ESTABLISHMENTS MONITORED</h6>
                    <p class="text-muted">Under BFP fire safety supervision</p>
                    <strong style="font-size: 3rem; color: #343a40;">320</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- Secondary Section -->
            <div class="row mt-4">
              <div class="col-md-12">
                <div class="card shadow border-0">
                  <div class="card-header bg-danger text-white fw-bold">
                    <i class="fa-solid fa-chart-line me-2"></i> Activity Overview
                  </div>
                  <div class="card-body">
                    <p class="text-muted mb-3">Real-time insights on permit processing and inspections.</p>
                    <div class="d-flex justify-content-around text-center">
                      <div>
                        <i class="fa-solid fa-file-circle-check fa-2x text-success mb-2"></i>
                        <p class="fw-bold mb-0">45</p>
                        <small class="text-muted">Approved Permits</small>
                      </div>
                      <div>
                        <i class="fa-solid fa-clock fa-2x text-warning mb-2"></i>
                        <p class="fw-bold mb-0">10</p>
                        <small class="text-muted">Pending Applications</small>
                      </div>
                      <div>
                        <i class="fa-solid fa-triangle-exclamation fa-2x text-danger mb-2"></i>
                        <p class="fw-bold mb-0">5</p>
                        <small class="text-muted">Flagged Issues</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme mt-4">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                © <script>
                  document.write(new Date().getFullYear());
                </script>
                | Bureau of Fire Protection - Building Permit Management System
              </div>
              <div>
                <a href="#" class="footer-link me-4 text-danger">
                  <i class="fa-solid fa-book"></i> Documentation
                </a>
                <a href="#" class="footer-link me-4 text-danger">
                  <i class="fa-solid fa-envelope"></i> Contact
                </a>
                <a href="#" class="footer-link me-4 text-danger">
                  <i class="fa-solid fa-circle-info"></i> Support
                </a>
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