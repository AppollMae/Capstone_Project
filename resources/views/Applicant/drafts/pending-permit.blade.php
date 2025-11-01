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
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Page Header -->
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Pending User Accounts /</span>
                            Show All Pendings
                        </h4>

                        <div class="row">
                            <div class="col-md-12">

                                <!-- Navigation -->
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);">
                                            <i class="bx bx-loader bx-spin"></i> All Pendings
                                        </a>
                                    </li>
                                </ul>

                                <!-- Card -->
                                <div class="card mb-4">
                                    <h5 class="card-header">Pending Permit Table</h5>
                                    <hr class="my-0" />

                                    <div class="card-body">
                                        <div class="row g-4">

                                            @forelse($pendingDrafts as $draft)
                                                <!-- Permit Card -->
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card shadow-sm border-0 rounded-3 h-100">
                                                        <div class="card-body d-flex flex-column">

                                                            <!-- Project & User -->
                                                            <h5 class="card-title fw-bold mb-1">
                                                                {{ $draft->project_name ?? 'N/A' }}
                                                            </h5>
                                                            <p class="text-muted mb-2">
                                                                <i class="bx bx-user"></i> {{ $draft->user->name ?? 'N/A' }}
                                                            </p>
                                                            <p class="mb-2">
                                                                <i class="bx bx-map"></i> {{ $draft->location ?? 'N/A' }}
                                                            </p>
                                                            <p class="mb-2">
                                                                <i class="bx bx-time"></i>
                                                                {{ $draft->created_at ? $draft->created_at->format('M d, Y h:i A') : 'N/A' }}
                                                            </p>

                                                            <!-- Status -->
                                                            <strong class='mb-2'><i class="bx bx-badge-check me-1"></i> <span
                                                                    class="px-3 py-1 rounded-pill shadow-sm mb-3 align-self-start"
                                                                    style="background: linear-gradient(90deg, #dbff59, #ffa751);
                                                                                   color:#4a3f00; font-weight:600; font-size:0.85rem;">

                                                                    {{ ucfirst($draft->status ?? 'Draft') }}
                                                                </span></strong>


                                                            <!-- Address -->
                                                            <!-- <p class="mb-2">
                                                                                        <i class="bx bx-map"></i> {{ $draft->address ?? 'N/A' }}
                                                                                    </p> -->

                                                            <!-- Reviewer -->
                                                            <div class="mb-3">
                                                                <span>
                                                                    Reviewed by:
                                                                    <strong>{{ $draft->reviewer->name ?? 'N/A' }}</strong>
                                                                    @if($draft->reviewer)
                                                                        @php
                                                                            $role = strtolower($draft->reviewer->role);
                                                                            if ($role === 'bfp')
                                                                                $roleLabel = '(Bureau of Fire Protection)';
                                                                            elseif ($role === 'admin')
                                                                                $roleLabel = '(Administrator)';
                                                                            elseif ($role === 'mpdo')
                                                                                $roleLabel = '(Municipal Planning & Development Office)';
                                                                            elseif ($role === 'treasurer')
                                                                                $roleLabel = '(Municipal Treasurer)';
                                                                            elseif ($role === 'obo')
                                                                                $roleLabel = '(Office of the Building Official)';
                                                                            else
                                                                                $roleLabel = '(User)';
                                                                        @endphp
                                                                        <span class="bg-primary ms-1 text-white px-2 py-1 rounded">
                                                                            {{ $roleLabel }}
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </div>

                                                            <!-- Document Section -->
                                                            <div class="mb-3">
                                                                @if(!empty($draft->image_urls) || !empty($draft->document_urls))
                                                                    <button type="button" class="btn btn-sm btn-primary w-100"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewDocumentModal-{{ $draft->id }}">
                                                                        <i class="bx bx-file"></i> View Files
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="viewDocumentModal-{{ $draft->id }}"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-primary text-white">
                                                                                    <h5 class="modal-title"><i
                                                                                            class="bx bx-file"></i> Files Preview
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close btn-close-white"
                                                                                        data-bs-dismiss="modal"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {{-- 📄 Show Documents (PDF, Word, etc.) --}}
                                                                                    @if(!empty($draft->document_urls))
                                                                                        @foreach($draft->document_urls as $file)
                                                                                            <div class="ratio ratio-16x9 mb-3">
                                                                                                <iframe src="{{ $file }}" style="border:0;"
                                                                                                    allowfullscreen></iframe>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                    {{-- 🖼️ Show Images --}}
                                                                                    @if(!empty($draft->image_urls))
                                                                                        <div class="row g-3 mb-4">
                                                                                            @foreach($draft->image_urls as $image)
                                                                                                <div class="col-md-4 text-center">
                                                                                                    <img src="{{ $image }}"
                                                                                                        alt="Uploaded Image"
                                                                                                        class="img-fluid rounded shadow-sm">
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    @foreach(array_merge($draft->image_urls, $draft->document_urls) as $url)
                                                                                        <a href="{{ $url }}" target="_blank"
                                                                                            class="btn btn-success btn-sm">
                                                                                            <i class="bx bx-download"></i> Open File
                                                                                        </a>
                                                                                    @endforeach
                                                                                    <button type="button" class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span class="text-muted">No document uploaded</span>
                                                                @endif
                                                            </div>


                                                            <!-- View Location Button -->
                                                            <div class="mb-3">
                                                                @foreach($mapData as $map)
                                                                    @if($map['latitude'] && $map['longitude'])
                                                                        <button class="btn btn-outline-success btn-sm w-100"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#viewMapModal-{{ $map['id'] }}">
                                                                            <i class="bx bx-map-pin"></i> View Location
                                                                        </button>

                                                                        <!-- Map Modal -->
                                                                        <div class="modal fade" id="viewMapModal-{{ $map['id'] }}"
                                                                            tabindex="-1" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">
                                                                                            Location Map — Radius:
                                                                                            {{ $map['radiusRange'] ?? 0 }} meters
                                                                                        </h5>
                                                                                        <button type="button" class="btn-close"
                                                                                            data-bs-dismiss="modal"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-2">
                                                                                            <strong>
                                                                                                📍 Location:
                                                                                                {{ $map['location'] ?? 'No location name available' }}
                                                                                            </strong>
                                                                                        </div>

                                                                                        <div id="map-{{ $map['id'] }}"
                                                                                            data-lat="{{ $map['latitude'] }}"
                                                                                            data-lng="{{ $map['longitude'] }}"
                                                                                            data-radius="{{ $map['radiusRange'] ?? 0 }}"
                                                                                            style="height: 400px; border: 1px solid #ccc;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>


                                                            <!-- Actions -->
                                                            <div class="mt-auto">

                                                                <!-- Success Alert -->
                                                                @if(session('success'))
                                                                    <div
                                                                        class="alert alert-success alert-dismissible fade show shadow-sm">
                                                                        <i class="bx bx-check-circle"></i> {{ session('success') }}
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="alert"></button>
                                                                    </div>
                                                                @endif

                                                                <!-- Delete Button -->
                                                                <form action="" method="POST" class="delete-draft-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger shadow-sm w-100"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteDraftModal-{{ $draft->id }}">
                                                                        <i class="bx bx-trash"></i> Delete
                                                                    </button>
                                                                </form>

                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="deleteDraftModal-{{ $draft->id }}"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content shadow-lg">
                                                                            <div class="modal-header bg-danger text-white">
                                                                                <h5 class="modal-title">
                                                                                    <i class="bx bx-trash"></i> Confirm Deletion
                                                                                </h5>
                                                                                <button type="button"
                                                                                    class="btn-close btn-close-white"
                                                                                    data-bs-dismiss="modal"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure you want to <strong>delete this
                                                                                    draft?</strong>
                                                                                This action cannot be undone.
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Yes, Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- /Actions -->

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Permit Card -->
                                            @empty
                                                <div class="col-12 text-center text-muted">
                                                    No pending permits found.
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                                <!-- /Card -->

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
<script>
    window.draftPermits = @json($mapData);
</script>
<script src="{{ asset('js/view-map.js') }}"></script>