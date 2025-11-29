@extends('layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('applicant.dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                    </span>
                    <img src="{{asset('images/Logo.png')}}" alt="" style="width: 50px;">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2"
                        style="text-transform:uppercase">BPMS</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('bfp.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <!-- Layouts -->

                <li class="menu-item {{ $ActiveTab === 'bfp-permits' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-file"></i>
                        <div data-i18n="Layouts">Quick Stat</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('bfp.permits.view-permits') }}" class="menu-link">
                                <div data-i18n="Without menu">Total permits issued</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('bfp.permits.view-pending-permits') }}" class="menu-link">
                                <div data-i18n="Without menu">Pending applications</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $SubActiveTab === 'view-total-permits' ? 'active' : '' }}">
                            <a href="{{ route('bfp.permits.view-total-permits') }}" class="menu-link">
                                <div data-i18n="Without menu">Under Review Applications</div>
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

            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
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
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : asset('sneat/img/avatars/1.png') }}"
                                        alt class="w-px-120 h-px-120 rounded-circle" />
                                </div>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : asset('sneat/img/avatars/1.png') }}"
                                                        alt class="w-px-120 h-px-120 rounded-circle" />
                                                </div>

                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
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
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Total View /</span>

                        <a href="{{ route('bfp.permits.view-pending-permits') }}"
                            class="{{ request()->routeIs('bfp.permits.view-permits') ? 'text-primary fw-bold' : 'text-dark' }}">
                            Total Permits
                        </a> /

                        <a href="{{ route('bfp.permits.view-pending-permits') }}"
                            class="{{ request()->routeIs('bfp.permits.view-pending-permits') ? 'text-primary fw-bold' : 'text-dark' }}">
                            Pending
                        </a> /

                        <a href="{{ route('bfp.permits.view-permits') }}"
                            class="{{ request()->routeIs('bfp.permits.view-total-permits') ? 'text-primary fw-bold' : 'text-dark' }}">
                            Under Review
                        </a> /

                        <a href="{{ route('bfp.permits.view-approve-permits') }}"
                            class="{{ request()->routeIs('bfp.permits.view-approve-permits') ? 'text-primary fw-bold' : 'text-dark' }}">
                            Approved
                        </a> /

                        <a href="{{ route('bfp.permits.view-rejected-permits') }}"
                            class="{{ request()->routeIs('bfp.permits.view-rejected-permits') ? 'text-primary fw-bold' : 'text-dark' }}">
                            Rejected
                        </a>
                    </h4>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bfp.permits.view-permits') }}">
                                        <i class="bx bx-file me-1 text-success"></i>
                                        Total Permits
                                        {{-- Total Permits --}}
                                        @if($totalPermitsAll > 0)
                                        <span class="ms-1 px-2 py-1 rounded text-white animate__animated animate__fadeIn"
                                            style="background-color: #6c757d;">
                                            {{ $totalPermitsAll }}
                                        </span>
                                        @endif
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bfp.permits.view-pending-permits') }}">
                                        <i class="bx bx-time-five me-1 text-warning"></i>
                                        Pending
                                        @if(($Permits ?? 0) > 0)
                                        <span class="ms-1 px-2 py-1 rounded text-white" style="background-color: #f0c60dff;">
                                            {{ $Permits ?? 0 }}
                                        </span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{ $linkActiveTab === 'bfp-permits-under-review' ? 'active' : '' }}" href="{{ route('bfp.permits.view-total-permits') }}">
                                        <i class="bx bx-file-find me-1 text-info"></i>
                                        Under Review
                                        @if(($underReview ?? 0) > 0)
                                        <span class="ms-1 px-2 py-1 rounded text-white animate__animated animate__fadeIn"
                                            style="background-color: #0dd5f0ff;">
                                            {{ $underReview ?? 0 }}
                                        </span>
                                        @endif

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bfp.permits.view-approve-permits') }}">
                                        <i class="bx bx-check-circle me-1 text-success"></i>
                                        Approved
                                        <span class="ms-1 px-2 py-1 rounded text-white" style="background-color: #15f00dff;"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bfp.permits.view-rejected-permits') }}">
                                        <i class="bx bx-x-circle me-1 text-danger"></i>
                                        Rejected
                                        <span class="ms-1 px-2 py-1 rounded text-white" style="background-color: #ff5151ff;"></span>
                                    </a>
                                </li>
                            </ul>

                            <div class="card mb-4">
                                <h5 class="card-header">Total Permit Applied</h5>
                                <hr class="my-0" />

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- Map Container -->


                                        <!-- Hidden inputs to store the first location's coordinates (optional) -->
                                        <input type="hidden" id="latitude" name="latitude">
                                        <input type="hidden" id="longitude" name="longitude">
                                        <!-- Draft Permits Table -->
                                        <table class="table table-bordered table-striped text-center align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Project Name</th>
                                                    <th>Location</th>
                                                    <th>Documents</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Reviewed By</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($totalPermits as $permit)
                                                <tr>
                                                    <!-- Created By (User Name) -->
                                                    <td>{{ $permit->user->name ?? 'N/A' }}</td>

                                                    <!-- Project Name -->
                                                    <td>{{ $permit->project_name ?? 'N/A' }}</td>

                                                    <!-- Location -->
                                                    <td>{{ $permit->location ?? 'N/A' }}</td>



                                                    <td>
                                                        @if($permit->document_url)
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#viewDocumentModal-{{ $permit->id }}">
                                                            View Document
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="viewDocumentModal-{{ $permit->id }}" tabindex="-1"
                                                            aria-labelledby="viewDocumentLabel-{{ $permit->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- modal-xl for wide screens -->
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title" id="viewDocumentLabel-{{ $permit->id }}">
                                                                            <i class="bx bx-file"></i> Document Preview
                                                                        </h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body p-0">
                                                                        <div class="ratio ratio-16x9">
                                                                            <!-- Responsive iframe -->
                                                                            <iframe src="{{ $permit->document_url }}" style="border:0;" allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ $permit->document_url }}" target="_blank" class="btn btn-success">
                                                                            <i class="bx bx-download"></i> Open in New Tab
                                                                        </a>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </td>

                                                    <!-- Description -->
                                                    <td>{{ $permit->description ?? 'N/A' }}</td>
                                                    <!-- Status -->
                                                    <td>
                                                        @switch($permit->status)
                                                        @case('pending')
                                                        <span class="px-3 py-1 rounded-pill shadow-sm d-inline-block text-center"
                                                            style="background: linear-gradient(90deg, #36d1dc, #5b86e5); 
                       color:#4a3f00; font-weight:600; font-size:0.85rem; white-space:nowrap;">
                                                            Pending
                                                        </span>
                                                        @break

                                                        @case('under_review')
                                                        <span class="px-3 py-1 rounded-pill shadow-sm d-inline-block text-center"
                                                            style="background: linear-gradient(90deg, #dbff59, #ffa751 ); 
                       color:black; font-weight:600; font-size:0.85rem; white-space:nowrap;">
                                                            Under Review
                                                        </span>
                                                        @break

                                                        @case('approved')
                                                        <span class="px-3 py-1 rounded-pill shadow-sm d-inline-block text-center"
                                                            style="background: linear-gradient(90deg, #56ab2f, #a8e063); 
                       color:#fff; font-weight:600; font-size:0.85rem; white-space:nowrap;">
                                                            Approved
                                                        </span>
                                                        @break

                                                        @case('rejected')
                                                        <span class="px-3 py-1 rounded-pill shadow-sm d-inline-block text-center"
                                                            style="background: linear-gradient(90deg, #ff6b6b, #ff3d3d); 
                       color:#fff; font-weight:600; font-size:0.85rem; white-space:nowrap;">
                                                            Rejected
                                                        </span>
                                                        @break

                                                        @default
                                                        <span class="px-3 py-1 rounded-pill shadow-sm bg-secondary text-white d-inline-block text-center"
                                                            style="white-space:nowrap;">
                                                            {{ ucfirst($permit->status ?? 'N/A') }}
                                                        </span>
                                                        @endswitch
                                                    </td>

                                                    <!-- Review By -->
                                                    <td>
                                                        <span>
                                                            <strong>{{ $permit->reviewer->name ?? 'N/A' }}</strong>

                                                            @if($permit->reviewer)
                                                            @php
                                                            $role = strtolower($permit->reviewer->role);
                                                            if ($role === 'bfp') {
                                                            $roleLabel = 'Bureau of Fire Protection';
                                                            } elseif ($role === 'admin') {
                                                            $roleLabel = 'Administrator';
                                                            } elseif ($role === 'mpdo') {
                                                            $roleLabel = 'Municipal Planning & Development Office';
                                                            } elseif ($role === 'treasurer') {
                                                            $roleLabel = 'Municipal Treasurer';
                                                            } elseif ($role === 'obo') {
                                                            $roleLabel = 'Office of the Building Official';
                                                            } else {
                                                            $roleLabel = 'User';
                                                            }
                                                            @endphp

                                                            <span class="ms-2 px-3 py-1 rounded-pill bg-primary text-white d-inline-block align-middle"
                                                                style="font-size:0.8rem; font-weight:600; white-space:nowrap;">
                                                                {{ $roleLabel }}
                                                            </span>
                                                            @endif
                                                        </span>
                                                    </td>

                                                    <!-- Issue Flags -->
                                                     
                                                    <!-- Created At -->
                                                    <td>{{ $permit->created_at ? $permit->created_at->format('M d, Y h:i A') : 'N/A' }}
                                                    </td>
                                                    <!-- Actions -->
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#permitActionModal-{{ $permit->id }}">
                                                            <i class="bx bx-cog"></i> Actions
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="permitActionModal-{{ $permit->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="permitActionLabel-{{ $permit->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-dark text-white">
                                                                        <h5 class="modal-title" id="permitActionLabel-{{ $permit->id }}">
                                                                            <i class="bx bx-cog"></i> Application Actions
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <p class="fs-6">
                                                                            What action do you want to take for
                                                                            <strong>{{ $permit->project_name }}</strong>?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer d-flex flex-wrap gap-2 justify-content-center">

                                                                        <!-- Under Review -->
                                                                        <form action="{{ route('bfp.permits.mark-under-review', $permit->id) }}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-warning">
                                                                                <i class="bx bx-hourglass"></i> Under Review
                                                                            </button>
                                                                        </form>

                                                                        <!-- Approve -->
                                                                        <form action="" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-success">
                                                                                <i class="bx bx-check-circle"></i> Approve
                                                                            </button>
                                                                        </form>

                                                                        <!-- Reject -->
                                                                        <form action="" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-danger">
                                                                                <i class="bx bx-x-circle"></i> Reject
                                                                            </button>
                                                                        </form>

                                                                        <!-- Temporary Delete -->
                                                                        <form action="" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-secondary">
                                                                                <i class="bx bx-trash"></i> Temporary Delete
                                                                            </button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-muted text-center">No pending permits
                                                        found.</td>
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



                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme mt-4">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
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