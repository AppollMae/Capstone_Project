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
                <li class="menu-item {{ $ActiveTab === 'pending' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-envelope"></i>
                        <div data-i18n="Layouts">My Applications</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item ">
                            <a href="{{ route('applicants.drafts.view-drafts') }}" class="menu-link">
                                <div data-i18n="Without menu">Draft</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $SubActiveTab === 'permit' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">Pending</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('applicants.under-reviews.view-under-review') }}" class="menu-link">
                                <div data-i18n="Without navbar">Under Review</div>
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
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}"
                                        alt class="w-px-120 h-px-120 rounded-circle" />
                                </div>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}"
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
                <div class="content-wrapper">
                    <div class="container-xxl container-p-y">

                        <div class="row g-4">

                            {{-- ================= STEPS INDICATOR ================= --}}
                            <div class="col-12 col-md-3">
                                <div class="d-flex d-md-block justify-content-between align-items-center text-center">
                                    @foreach([1 => 'Consent', 2 => 'Review', 3 => 'APPROVE'] as $step => $label)
                                    <div class="position-relative mb-0 mb-md-4">
                                        {{-- Circle --}}
                                        <div class="rounded-circle {{ $step === 1 ? 'bg-primary' : 'bg-secondary' }} text-white mx-auto d-flex align-items-center justify-content-center"
                                            style="width:36px; height:36px;">
                                            {{ $step }}
                                        </div>

                                        {{-- Label --}}
                                        <div class="small mt-1">{{ $label }}</div>

                                        {{-- Vertical line (desktop only) --}}
                                        @if($step < 3)
                                            <div class="d-none d-md-block position-absolute start-50 top-100 translate-middle-x"
                                            style="width:3px; height:40px; background:#d1d5db;">
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- ================= STEP CONTENT ================= --}}
                        <div class="col-12 col-md-9">
                            <div class="row g-4">

                                {{-- STEP 1 --}}
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold text-uppercase">Submit Consent</h5>
                                            <p class="text-muted small">
                                                Submit your consent to proceed with the building permit application.
                                            </p>


                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Project</th>
                                                            <th class="d-none d-lg-table-cell">Location</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="d-lg-table-cell">Files</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($pendingDrafts as $i => $draft)
                                                        <tr>
                                                            <td>{{ $i + 1 }}</td>
                                                            <td>{{ $draft->project_name ?? 'N/A' }}</td>
                                                            <td class="d-none d-lg-table-cell">{{ $draft->location ?? 'N/A' }}</td>
                                                            @php
                                                            $statusColors = [
                                                            'pending' => '#ffc107', // warning
                                                            'approved' => '#198754', // green
                                                            'rejected' => '#dc3545', // red
                                                            ];
                                                            $bgColor = $statusColors[$draft->status] ?? '#6c757d'; // default gray
                                                            @endphp

                                                            <td>
                                                                <span class="px-2 py-1 rounded text-dark" style="background-color: {{ $bgColor }};">
                                                                    {{ ucfirst($draft->status) }}
                                                                </span>
                                                            </td>

                                                            <td>{{ $draft->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                                            <td class="d-lg-table-cell">
                                                                @php
                                                                $filesCount = count($draft->image_urls) + count($draft->document_urls);
                                                                @endphp

                                                                @if($filesCount > 0)
                                                                <button
                                                                    class="btn btn-sm btn-outline-primary position-relative"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#filesModal{{ $draft->id }}">
                                                                    <i class="fa-solid fa-file"></i> <!-- file icon from Bootstrap Icons -->
                                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                        {{ $filesCount }}
                                                                        <span class="visually-hidden">files</span>
                                                                    </span>
                                                                </button>

                                                                @else
                                                                <span class="text-muted">None</span>
                                                                @endif
                                                            </td>

                                                            <div class="modal fade" id="filesModal{{ $draft->id }}" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
                                                                    <div class="modal-content">

                                                                        <!-- Header -->
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Uploaded Files</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                        </div>

                                                                        <!-- Body -->
                                                                        <div class="modal-body">

                                                                            {{-- Images --}}
                                                                            @if(!empty($draft->image_urls))
                                                                            <h6 class="fw-semibold mb-2">Images</h6>
                                                                            <div class="row g-2 mb-4">
                                                                                @foreach($draft->image_urls as $image)
                                                                                <div class="col-6 col-sm-4 col-md-3">
                                                                                    <a href="{{ asset($image) }}" target="_blank">
                                                                                        <img
                                                                                            src="{{ asset($image) }}"
                                                                                            class="img-fluid rounded border w-100"
                                                                                            style="object-fit: cover; aspect-ratio: 1 / 1;">
                                                                                    </a>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                            @endif

                                                                            {{-- Documents --}}
                                                                            @if(!empty($draft->document_urls))
                                                                            <h6 class="fw-semibold mb-2">Documents</h6>

                                                                            <ul class="list-group list-group-flush">
                                                                                @foreach($draft->document_urls as $doc)
                                                                                <li class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                                                                                    <span class="text-break">
                                                                                        <p class="text-muted small">
                                                                                            {{ Str::of(basename($doc))->replace('_', ' ')->replace('-', ' ') }}
                                                                                        </p>
                                                                                    </span>

                                                                                    <a href="{{ asset($doc) }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-sm btn-outline-primary">
                                                                                        View
                                                                                    </a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                            @endif

                                                                        </div>

                                                                        <!-- Footer -->
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                                Close
                                                                            </button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted">
                                                                No pending permit applications found.
                                                            </td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- STEP 2 --}}
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Review / Encode Department</h5>
                                            <p class="text-muted small">
                                                Your year-level adviser will input subjects and schedules.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- STEP 3 --}}
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Approve By The Department</h5>
                                            <p class="text-muted small">
                                                This section will be available after department review.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /Content -->

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
<!-- <script>
    window.draftPermits = @json($mapData);
</script>
<script src="{{ asset('js/view-map.js') }}"></script> -->