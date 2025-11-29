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
                    <li class="menu-item {{ $ActiveTabMenu === 'unified_app' ? 'active' : '' }}">
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
                                <div class="container-xxl mt-4">


<h2 style="text-align:center; margin:0;">Republic of the Philippines</h2>
<h3 style="text-align:center; margin:0;">Municipality of Bontoc</h3>
<h4 style="text-align:center; margin:0;">Province of Southern Leyte</h4>
<h2 style="text-align:center; margin-top:10px;">OFFICE OF THE BUILDING OFFICIAL</h2>
<h2 style="text-align:center;">CIVIL/STRUCTURAL PERMIT</h2>


<table>
<tr>
<td>Application No.</td>
<td>C/SP No.</td>
<td>Building Permit No.</td>
</tr>
</table>


<div class="section-title">BOX 1 (TO BE ACCOMPLISHED IN PRINT BY THE OWNER/APPLICANT)</div>


<table>
<tr>
<td>Owner/Applicant<br>Last Name:<br>First Name:<br>M.I.:<br>TIN:</td>
<td>For Construction Owned<br>Form of Ownership<br>Use or Character of Occupancy</td>
</tr>
<tr>
<td>Address<br>No., Street, Barangay, City/Municipality, Zip Code<br>Telephone No.</td>
<td>Location of Construction<br>Lot No., Blk No., TCT No., Tax Dec No., Street, Barangay, City/Municipality</td>
</tr>
</table>


<div class="section-title">SCOPE OF WORK</div>


<table>
<tr>
<td><input type="checkbox"> New Construction</td>
<td><input type="checkbox"> Renovation</td>
<td><input type="checkbox"> Raising</td>
</tr>
<tr>
<td><input type="checkbox"> Erection</td>
<td><input type="checkbox"> Conversion</td>
<td><input type="checkbox"> Demolition</td>
</tr>
<tr>
<td><input type="checkbox"> Addition</td>
<td><input type="checkbox"> Repair</td>
<td><input type="checkbox"> Accessory Building/Structure (Specify)</td>
</tr>
<tr>
<td><input type="checkbox"> Alteration</td>
<td><input type="checkbox"> Moving</td>
<td><input type="checkbox"> Others (Specify)</td>
</tr>
</table>


<div class="section-title">BOX 2 (TO BE ACCOMPLISHED BY THE DESIGN PROFESSIONAL)</div>


<table>
<tr>
<td><input type="checkbox"> Staking</td>
<td><input type="checkbox"> Reinforcing</td>
<td><input type="checkbox"> Prestress Works</td>
</tr>
<tr>
<td><input type="checkbox"> Excavation</td>
<td><input type="checkbox"> Concrete Framing</td>
<td><input type="checkbox"> Material Testing</td>
</tr>
<tr>
<td><input type="checkbox"> Soil Stabilization</td>
<td><input type="checkbox"> Structural Steel Framing</td>
<td><input type="checkbox"> Steel Trusses</td>
</tr>
<tr>
<td><input type="checkbox"> Piling Works</td>
</tr>
</table>


<div class="section-title">BOX 3 - DESIGN PROFESSIONAL, PLANS AND SPECIFICATIONS</div>


<table>
<tr>
<td>Civil/Structural Engineer (Signed and Sealed Over Printed Name)<br>Date:<br>Address:<br>PRC No.:<br>Validity:<br>PTR No.:<br>Date Issued:<br>Issued at:<br>TIN:</td>
</tr>
</table>


<div class="section-title">BOX 4 - SUPERVISOR/IN-CHARGE OF CIVIL/STRUCTURAL WORKS</div>


<table>
<tr>
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