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
                <li class="menu-item {{ $ActiveTabMenu === 'structural' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-ticket"></i>
                        <div data-i18n="Layouts">Apply for Permit</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $SubActiveMenu === 'form' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Apply Now</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('applicants.permits.view-issue-flags', Auth::user()->id) }}"
                                class="menu-link">
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
                            <a href="{{ route('applicants.accounts.applicants-edit-accounts', Auth::user()->id) }}"
                                class="menu-link">
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
                                    <img src="{{ $user->avatar ? asset('storage/app/public/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
                                        alt class="w-px-120 h-px-120 rounded-circle" />
                                </div>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ $user->avatar ? asset('storage/app/public/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
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


                                <hr class="my-0" />

                                <!-- Permit Application Form -->
                                <div class="container-xxl mt-4">

                                    <div class="position-relative text-center mb-3 py-2">

                                        <!-- Responsive Logo -->
                                        <img src="{{ asset('images/Municipality_logo.jpg') }}" alt="Municipality Logo"
                                            class="position-absolute logo-responsive">

                                        <!-- Centered Text -->
                                        <h4 class="fw-bold mb-0 px-4">
                                            <span class="d-block">Republic of the Philippines</span>
                                            <span class="d-block">Municipality of Bontoc</span>
                                            <span class="d-block">Province of Southern Leyte</span>
                                            <span class="d-block mt-2 fs-4">
                                                CIVIL/STRUCTURAL PERMIT
                                            </span>
                                        </h4>
                                    </div>

                                    <form method="POST" action="">
                                        @csrf

                                        <!-- APPLICATION DETAILS -->
                                        <!-- HEADER: APPLICATION NUMBERS -->
                                        <div class="border p-3 rounded mb-3">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Application No.</label>
                                                    <input type="text" class="form-control" name="application_no">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">C/SP No.</label>
                                                    <input type="text" class="form-control" name="csp_no">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Building Permit No.</label>
                                                    <input type="text" class="form-control" name="building_permit_no">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- BOX 1 -->
                                        <div class="border p-3 rounded mb-3">
                                            <h5 class="fw-bold">BOX 1 — TO BE ACCOMPLISHED BY THE OWNER/APPLICANT</h5>

                                            <!-- OWNER NAME + TIN -->
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" name="owner_lastname">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" class="form-control" name="owner_firstname">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">M.I.</label>
                                                    <input type="text" class="form-control" name="owner_mi">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">TIN</label>
                                                    <input type="text" class="form-control" name="owner_tin">
                                                </div>
                                            </div>

                                            <!-- OWNERSHIP + OCCUPANCY -->
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Form of Ownership</label>
                                                    <input type="text" class="form-control" name="form_ownership">
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label">Use or Character of Occupancy</label>
                                                    <input type="text" class="form-control" name="occupancy">
                                                </div>
                                            </div>

                                            <!-- OWNER ADDRESS (NO, STREET, BARANGAY, CITY, ZIP, TEL) -->
                                            <h6 class="fw-bold mt-3">Owner Address</h6>
                                            <div class="row mb-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">No.</label>
                                                    <input type="text" class="form-control" name="owner_no">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Street</label>
                                                    <input type="text" class="form-control" name="owner_street">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Barangay</label>
                                                    <input type="text" class="form-control" name="owner_barangay">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">City/Municipality</label>
                                                    <input type="text" class="form-control" name="owner_city">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">ZIP Code</label>
                                                    <input type="text" class="form-control" name="owner_zip">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Telephone No.</label>
                                                    <input type="text" class="form-control" name="owner_tel">
                                                </div>
                                            </div>

                                            <!-- LOCATION OF CONSTRUCTION -->
                                            <h6 class="fw-bold mt-4">Location of Construction</h6>

                                            <div class="row mb-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">Lot No.</label>
                                                    <input type="text" class="form-control" name="lot_no">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Blk No.</label>
                                                    <input type="text" class="form-control" name="blk_no">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">TCT No.</label>
                                                    <input type="text" class="form-control" name="tct_no">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Tax Dec. No.</label>
                                                    <input type="text" class="form-control" name="tax_dec_no">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Street</label>
                                                    <input type="text" class="form-control" name="construction_street">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Barangay</label>
                                                    <input type="text" class="form-control" name="construction_barangay">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">City/Municipality</label>
                                                    <input type="text" class="form-control" name="construction_city">
                                                </div>
                                            </div>

                                            <!-- SCOPE OF WORK -->
                                            <label class="fw-bold mt-2">Scope of Work</label>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label><input type="checkbox" name="scope[]" value="New Construction"> New Construction</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Erection"> Erection</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Addition"> Addition</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Alteration"> Alteration</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <label><input type="checkbox" name="scope[]" value="Renovation"> Renovation</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Conversion"> Conversion</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Repair"> Repair</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Moving"> Moving</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <label><input type="checkbox" name="scope[]" value="Raising"> Raising</label><br>
                                                    <label><input type="checkbox" name="scope[]" value="Demolition"> Demolition</label><br>
                                                    <label>Others: <input type="text" class="form-control form-control-sm" name="scope_others"></label>
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Accessory Building/Structure:</label>
                                                    <input type="text" name="scope_accessory" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SUBMIT BUTTONS -->
                                        <div class="mb-3">
                                            <a href="{{ route('applicants.permits.unified-application-form-page-2') }}" class="btn btn-secondary py-2">
                                                ← Previous
                                            </a>

                                            <a href="{{ route('applicants.permits.structural-permit-page-2') }}" class="btn btn-primary">
                                                Next →
                                            </a>
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