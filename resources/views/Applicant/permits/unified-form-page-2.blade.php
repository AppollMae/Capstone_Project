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
                    <li class="menu-item {{ $ActiveTabMenu === 'unified_form' ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon fa-solid fa-ticket"></i>
                            <div data-i18n="Layouts">Apply for Permit</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ $SubActiveMenu === 'app' ? 'active' : ''}}">
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
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
                                            alt class="w-px-120 h-px-120 rounded-circle" />
                                    </div>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
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
                                    <div class="container mt-4">
                                        <!-- logout-form -->
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
                                                    UNIFIED APPLICATION FORM FOR BUILDING PERMIT
                                                </span>
                                            </h4>
                                        </div>

                                        <hr class="my-0" />

                                        <!-- BOX 6 — TO BE ACCOMPLISHED BY THE PROCESSING AND EVALUATION DIVISION -->
                                        <div class="card">
                                            <div class="card-header text-center fw-bold">
                                                BOX 6 – TO BE ACCOMPLISHED BY THE PROCESSING AND EVALUATION DIVISION
                                            </div>

                                            <div class="card-body">

                                                <!-- ASSESSED FEES TABLE -->
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="table-light text-center">
                                                            <tr>
                                                                <th width="30%">ASSESSED FEES</th>
                                                                <th width="25%">ACCOUNT</th>
                                                                <th width="25%">BASIS OF ASSESSMENT</th>
                                                                <th width="20%">AMOUNT DUE</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <!-- ZONING -->
                                                            <tr>
                                                                <td><strong>FOR ZONING (ZONING ADMINISTRATOR):</strong></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">LOCATIONAL / ZONING OF LAND</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <!-- BUILDING / OBO -->
                                                            <tr>
                                                                <td><strong>FOR BUILDING / STRUCTURE (OBO):</strong></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="ps-4">FILING FEE</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">LINE AND GRADE (Geodetic)</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">FENCING</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">ARCHITECTURAL</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">CIVIL / STRUCTURAL</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">ELECTRICAL</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">MECHANICAL</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">SANITARY</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">PLUMBING</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">ELECTRONICS</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">INTERIOR</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">SURCHARGES</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">PENALTIES</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <!-- FIRE SAFETY -->
                                                            <tr>
                                                                <td><strong>FOR FIRE SAFETY (BFP):</strong></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="ps-4">FIRE CODE CONSTRUCTION TAX</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-4">HOTWORKS</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <!-- TOTAL -->
                                                            <tr class="table-secondary">
                                                                <td class="fw-bold text-end">TOTAL</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>


                                                <!-- TERMS AND CONDITIONS -->
                                                <div class="mt-4">
                                                    <h5 class="fw-bold">TERMS AND CONDITIONS:</h5>
                                                    <ol>
                                                        <li>
                                                            The Owner/Applicant shall accomplish the prescribed Application
                                                            Form, with the assistance
                                                            of the concerned design professionals and/or the Architect/Civil
                                                            Engineer, hired/commissioned
                                                            by him/her as full-time inspector/supervisor of the construction
                                                            works, by filling up the
                                                            necessary data / information required therein.
                                                        </li>

                                                        <li class="mt-2">
                                                            The fully accomplished prescribed Application Form, duly
                                                            notarized, shall be submitted to the
                                                            concerned Office of the Building Official, accompanied by the
                                                            various applicable ancillary and
                                                            accessory permits, plans and specifications signed and sealed by
                                                            the corresponding design
                                                            professionals who shall be responsible for the comprehensive and
                                                            correctness of the plans in
                                                            compliance to the National Building Code of the Philippines (PD
                                                            1096), its Revised IRR and all
                                                            applicable referral codes and professional regulatory laws,
                                                            together with other documentary
                                                            requirements pursuant to Section 302 of PD 1096 and its Revised
                                                            IRR.
                                                        </li>
                                                    </ol>

                                                    <p class="mt-3">
                                                        I have read this form, understood its contents and consent to the
                                                        processing of my personal data.
                                                        I understand that my consent does not preclude the existence of
                                                        other criteria for lawful processing
                                                        of personal data, and does not waive any of my rights under the Data
                                                        Privacy Act of 2012 and other
                                                        applicable laws.
                                                    </p>
                                                </div>

                                                <!-- SIGNATURE -->
                                                <div class="mt-4 text-center">
                                                    <label class="fw-bold">SIGNATURE OVER PRINTED NAME OF OWNER /
                                                        APPLICANT</label>
                                                    <div class="border-top mt-2"
                                                        style="width:60%; margin:auto; height:40px;"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <a href="{{ route('applicants.permits.unified-application-form') }}"
                                                        class="btn btn-secondary py-2">
                                                        ← Previous
                                                    </a>

                                                    <a href="{{ route('applicants.permits.structural-permit')}}" class="btn btn-primary">
                                                        Next →
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

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