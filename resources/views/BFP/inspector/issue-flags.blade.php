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

                <li class="menu-item">
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
                            <a href="{{ route('bfp.permits.view-total-permits') }}" class="menu-link">
                                <div data-i18n="Without menu">Under Review Applications</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('bfp.permits.view-pending-permits') }}" class="menu-link">
                                <div data-i18n="Without menu">Pending applications</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('bfp.permits.view-approve-permits') }}" class="menu-link">
                                <div data-i18n="Without menu">Approved applications</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('bfp.permits.view-rejected-permits') }}" class="menu-link">
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

                <li class="menu-item {{ $ActiveTab === 'bfp-issue-flags' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-handshake"></i>
                        <div data-i18n="Layouts">Issue & Facilitate</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $SubActiveTab === 'view-issue-flags' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Issue Flags</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Facilitate</div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Accounts || Inspector</span>
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
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-list-check"></i>
                        <div data-i18n="Account Settings">User Management</div>
                    </a>
                    <ul class="menu-sub">

                        <li class="menu-item">
                            <a href="{{ route('bfp.inspectors.view-inspectors') }}" class="menu-link">
                                <div data-i18n="Notifications">Inspectors</div>
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
                                                <small class="text-muted">
                                                    @php
                                                    $role = strtolower(auth()->user()->role);

                                                    if ($role === 'bfp') {
                                                    $roleLabel = 'BFP || Bureau of Fire Protection';
                                                    } elseif ($role === 'admin') {
                                                    $roleLabel = 'Admin';
                                                    } elseif ($role === 'mpdo') {
                                                    $roleLabel = 'MPDO || Municipal Planning and Development Office';
                                                    } elseif ($role === 'treasurer') {
                                                    $roleLabel = 'Treasurer';
                                                    } elseif ($role === 'obo') {
                                                    $roleLabel = 'OBO || Office of the Building Official';
                                                    } elseif ($role === 'bfp_inspector') {
                                                    $roleLabel = 'BFP Inspector || Bureau of Fire Protection Inspector';
                                                    } elseif (in_array($role, [
                                                    'bfp_inspector_i',
                                                    'bfp_inspector_ii',
                                                    'bfp_inspector_iii',
                                                    'bfp_inspector_iv',
                                                    'bfp_inspector_v'
                                                    ])) {
                                                    $roleLabel = strtoupper($role) . ' || Bureau of Fire Protection Inspector';
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
                                    <a class="dropdown-item" href="{{ route('obo.accounts.view-accounts') }}">
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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Total View /</span>Show
                        All Permits
                    </h4>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-archive me-1"></i>
                                        Total Issue Flags</a>
                                </li>
                            </ul>

                            <div class="card mb-4">
                                <h5 class="card-header">Total Issue flags</h5>
                                <hr class="my-0" />

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- Map Container -->


                                        <!-- Hidden inputs to store the first location's coordinates (optional) -->
                                        <input type="hidden" id="latitude" name="latitude">
                                        <input type="hidden" id="longitude" name="longitude">
                                        <!-- Draft Permits Table -->
                                        <table class="table table-hover table-bordered align-middle shadow-sm rounded">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th><i class="bx bx-user"></i> Reporter</th>
                                                    <th><i class="bx bx-building-house"></i> Project Name</th>
                                                    <th><i class="bx bx-map"></i> Location</th>
                                                    <th><i class="bx bx-file"></i> Documents</th>
                                                    <th><i class="bx bx-check-shield"></i> Status</th>
                                                    <th><i class="bx bx-user-voice"></i> Reviewed By</th>
                                                    <th><i class="bx bx-error"></i> Issue</th>
                                                    <th><i class="bx bx-time"></i> Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @forelse($issueFlags as $issue)
                                                <tr>
                                                    <!-- Reported By -->
                                                    <td>
                                                        <span class="d-inline-block bg-dark text-white px-3 py-1">
                                                            {{ $issue->reportedBy->name ?? 'N/A' }}
                                                        </span>
                                                    </td>

                                                    <!-- Project Name -->
                                                    <td>
                                                        <strong>{{ $issue->permitApplication->project_name ?? 'N/A' }}</strong>
                                                    </td>

                                                    <!-- Location -->
                                                    <td>
                                                        <i class="bx bx-map-pin text-danger"></i>
                                                        {{ $issue->permitApplication->location ?? 'N/A' }}
                                                    </td>

                                                    <!-- Documents -->
                                                    <td>
                                                        @if($issue->permitApplication && $issue->permitApplication->documents)
                                                        @php
                                                        $docs = json_decode($issue->permitApplication->documents, true);
                                                        $fileName = is_array($docs) ? basename($docs[0]) : basename($issue->permitApplication->documents);
                                                        $docUrl = asset('storage/documents/' . $fileName);
                                                        @endphp

                                                        <a href="{{ $docUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bx bx-show"></i> View
                                                        </a>
                                                        @else
                                                        <span class="badge bg-secondary">N/A</span>
                                                        @endif
                                                    </td>

                                                    <!-- Status -->
                                                    <td>
                                                        @php
                                                        $status = $issue->permitApplication->status ?? 'N/A';
                                                        $statusColors = [
                                                        'pending' => 'info',
                                                        'under_review' => 'warning',
                                                        'approved' => 'success',
                                                        'rejected' => 'danger',
                                                        ];
                                                        $statusColor = $statusColors[$status] ?? 'secondary';
                                                        @endphp
                                                        <span class="d-inline-block bg-{{ $statusColor }} px-3 py-2 text-uppercase">
                                                            {{ str_replace('_', ' ', $status) }}
                                                        </span>
                                                    </td>

                                                    <!-- Reviewed By -->
                                                    <td>
                                                        @if($issue->permitApplication && $issue->permitApplication->reviewer)
                                                        <span class="fw-bold">{{ $issue->permitApplication->reviewer->name }}</span>
                                                        <br>
                                                        <span class="bg-primary mt-1 text-white px-2 py-1">
                                                            {{ ucfirst($issue->permitApplication->reviewer->role) }}
                                                        </span>
                                                        @else
                                                        <span class="badge bg-secondary">N/A</span>
                                                        @endif
                                                    </td>

                                                    <!-- Issue Description -->
                                                    <td>
                                                        <span class="text-danger fw-semibold">
                                                            <i class="bx bx-error-circle"></i>
                                                            {{ $issue->issue ?? 'N/A' }}
                                                        </span>
                                                    </td>

                                                    <!-- Created At -->
                                                    <td>
                                                        <span class="text-muted">
                                                            <i class="bx bx-time-five"></i>
                                                            {{ $issue->created_at ? $issue->created_at->format('M d, Y h:i A') : 'N/A' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-muted text-center py-3">
                                                        <i class="bx bx-info-circle"></i> No issue flags found.
                                                    </td>
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
                    <div
                        class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column small">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            Office of the Building Official Team Dashboard
                        </div>
                        <div>
                            <a href="#" class="footer-link me-4">License</a>
                            <a href="#" class="footer-link me-4">Contact</a>
                            <a href="#" class="footer-link me-4">Documentation</a>
                            <a href="#" class="footer-link me-4">Support</a>
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