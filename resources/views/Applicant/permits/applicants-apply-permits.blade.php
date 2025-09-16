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
                    <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase">BPMS</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('applicant.dashboard') }}" class="menu-link">
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
                        <li class="menu-item">
                            <a href="{{ route('applicants.drafts.view-drafts') }}" class="menu-link">
                                <div data-i18n="Without menu">Draft</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('applicants.under-reviews.view-under-review') }}" class="menu-link">
                                <div data-i18n="Without navbar">Under Review</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('applicants.drafts.pending-draft') }}" class="menu-link">
                                <div data-i18n="Without navbar">Pending</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
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
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ $ActiveTab === 'permits' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-ticket"></i>
                        <div data-i18n="Layouts">Apply for Permit</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $SubActiveTab === 'application-form' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Apply Now</div>
                            </a>
                        </li>
                        <!-- <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Download the required documents</div>
                            </a>
                        </li> -->
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
                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}" alt
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
                                                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                <small class="text-muted"> @php
                                                    $role = strtolower(auth()->user()->role);
                                                    if ($role === 'bfp') {
                                                    $roleLabel = 'BFP';
                                                    } elseif ($role === 'admin') {
                                                    $roleLabel = 'Admin';
                                                    } elseif ($role === 'mpdo') {
                                                    $roleLabel = 'MPDO';
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
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Building Permit /</span> Apply for Permit
                    </h4>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Tabs Navigation -->
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);">
                                        <i class="bx bx-file me-1"></i> New Application
                                    </a>
                                </li>
                            </ul>

                            <!-- Permit Application Card -->
                            <div class="card mb-4">
                                <h5 class="card-header">Permit Application Form</h5>
                                <hr class="my-0" />

                                <!-- Download Required Forms -->
                                <div class="mb-2 p-3">
                                    <h6 class="fw-bold">Download Required Forms</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="{{ asset('downloads/Building-Application-Form-Permit.pdf') }}" class="btn btn-outline-primary btn-sm" download>
                                                <i class="bx bx-download me-1"></i> Building Application Form
                                            </a>
                                        </li>
                                        <!-- <li class="mt-2">
                                            <a href="{{ asset('downloads/other_required_document.pdf') }}" class="btn btn-outline-primary btn-sm" download>
                                                <i class="bx bx-download me-1"></i> Other Required Document
                                            </a>
                                        </li> -->
                                    </ul>
                                    <small class="text-muted">
                                        Download and fill out these forms, then upload them along with your application.
                                    </small>
                                </div>

                                <hr class="my-0" />

                                <!-- Permit Application Form -->
                                <div class="card-body">
                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <form action="{{ route('applicants.permits.store-permit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Project Name -->
                                        <div class="mb-3 col-md-12">
                                            <label for="project_name" class="form-label">Project Name</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="project_name"
                                                name="project_name"
                                                placeholder="Enter project name"
                                                required />
                                        </div>

                                        <!-- Address -->
                                        <div class="mb-3 col-md-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="address"
                                                name="address"
                                                placeholder="Enter address"
                                                required />
                                        </div>

                                        <!-- Project Location -->
                                        <div class="mb-3 col-md-12">
                                            <label for="location" class="form-label">Project Location</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="location"
                                                name="location"
                                                placeholder="Enter project location"
                                                required />
                                        </div>

                                        <!-- Location Search Input -->
                                        <div class="mb-3 col-md-12">
                                            <label for="address" class="form-label">Search Building Location</label>
                                            <div class="input-group">
                                                <input
                                                    type="text"
                                                    id="address"
                                                    class="form-control"
                                                    placeholder="Enter building location" />
                                                <button type="button" class="btn btn-primary" id="search-location">
                                                    Search
                                                </button>
                                            </div>
                                            <small class="text-muted">
                                                Enter an address to pinpoint the location on the map.
                                            </small>
                                        </div>

                                        <!-- Map for pinpointing location -->
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Pinpoint Building Location</label>
                                            <div id="map" style="height: 300px; border: 1px solid #ccc;"></div>
                                            <input type="hidden" id="latitude" name="latitude">
                                            <input type="hidden" id="longitude" name="longitude">
                                            <small class="text-muted">
                                                Drag the marker to fine-tune the location.
                                            </small>
                                        </div>

                                        <!-- Project Description -->
                                        <div class="mb-3 col-md-12">
                                            <label for="description" class="form-label">Project Description</label>
                                            <textarea
                                                class="form-control"
                                                id="description"
                                                name="description"
                                                rows="3"
                                                placeholder="Brief description of the project"
                                                required></textarea>
                                        </div>

                                        <!-- Upload Documents -->
                                        <div class="mb-3 col-md-12">
                                            <label for="documents" class="form-label">Upload Required Documents</label>
                                            <input
                                                class="form-control"
                                                type="file"
                                                id="documents"
                                                name="documents[]"
                                                multiple
                                                accept=".pdf,.jpg,.png"
                                                required />
                                            <small class="text-muted">
                                                Accepted formats: PDF, JPG, PNG (multiple files allowed)
                                            </small>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bx bx-save me-1"></i> Submit Application
                                            </button>

                                            <!-- Save as Draft Button -->
                                            <button type="submit" formaction="{{ route('applicants.permits.draft-permit') }}" class="btn btn-warning">
                                                <i class="bx bx-edit-alt me-1"></i> Save as Draft
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                Reset
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Permit Application Form -->
                            </div>
                            <!-- /Permit Application Card -->

                        </div>
                    </div>
                </div>




                <!-- / Content -->

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