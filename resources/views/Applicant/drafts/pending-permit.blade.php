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
                                <a href="" class="menu-link">
                                    <div data-i18n="Without menu">Draft</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $SubActiveTab === 'permit' ? 'active' : '' }}">
                                <a href="" class="menu-link">
                                    <div data-i18n="Without navbar">Pending</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="" class="menu-link">
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
                                        @foreach($pendingDrafts as $draft)
                                            <img src="{{ $draft->avatar ? asset('storage/' . $draft->avatar) : asset('sneat/img/avatars/1.png') }}"
                                                alt class="w-px-120 h-px-120 rounded-circle" />
                                        @endforeach
                                    </div>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @foreach($pendingDrafts as $draft)
                                                            <img src="{{ $draft->avatar ? asset('storage/' . $draft->avatar) : asset('sneat/img/avatars/1.png') }}"
                                                                alt class="w-px-120 h-px-120 rounded-circle" />
                                                        @endforeach
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Pending View /</span>Show
                            All Pending
                        </h4>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);"><i
                                                class="bx bx-user me-1"></i> All Pending Viewed</a>
                                    </li>
                                </ul>

                                <div class="card mb-4">
                                    <h5 class="card-header">Pending</h5>
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
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Created At</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($pendingDrafts as $draft)
                                                        <tr>
                                                            <!-- Created By (User Name) -->
                                                            <td>{{ $draft->user->name ?? 'N/A' }}</td>

                                                            <!-- Project Name -->
                                                            <td>{{ $draft->project_name ?? 'N/A' }}</td>

                                                            <!-- Location -->
                                                            <td>{{ $draft->location ?? 'N/A' }}</td>

                                                            <!-- Latitude -->
                                                            <td>{{ $draft->latitude ?? 'N/A' }}</td>

                                                            <!-- Longitude -->
                                                            <td>{{ $draft->longitude ?? 'N/A' }}</td>

                                                            <!-- Created At -->
                                                            <td>{{ $draft->created_at ? $draft->created_at->format('M d, Y h:i A') : 'N/A' }}
                                                            </td>

                                                            <!-- Status -->
                                                            <td>
                                                                <span class="px-3 py-1 rounded-pill shadow-sm"
                                                                    style="background: linear-gradient(90deg, #dbff59, #ffa751); color:#4a3f00; font-weight:600; font-size:0.85rem;">
                                                                    {{ ucfirst($draft->status ?? 'Draft') }}
                                                                </span>
                                                            </td>

                                                            <!-- Delete Action -->
                                                            <td>
                                                                @if(session('success'))
                                                                    <div class="alert alert-success alert-dismissible fade show shadow-sm"
                                                                        role="alert">
                                                                        <i class="bx bx-check-circle"></i> {{ session('success') }}
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>
                                                                @endif
                                                                <form
                                                                    action="{{ route('applicants.drafts.delete-draft', $draft->id) }}"
                                                                    method="POST" class="delete-draft-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger shadow-sm delete-draft-btn">
                                                                        <i class="bx bx-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                                <!-- Delete Confirmation Modal -->
                                                                <div class="modal fade" id="deleteDraftModal" tabindex="-1"
                                                                    aria-labelledby="deleteDraftModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content shadow-lg">
                                                                            <div class="modal-header bg-danger text-white">
                                                                                <h5 class="modal-title text-white"
                                                                                    id="deleteDraftModalLabel"><i
                                                                                        class="bx bx-trash"></i> Confirm
                                                                                    Deletion</h5>
                                                                                <button type="button"
                                                                                    class="btn-close btn-close-white"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure you want to <strong>delete this
                                                                                    draft?</strong> This action cannot be
                                                                                undone.
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="button" class="btn btn-danger"
                                                                                    id="confirmDeleteBtn">Yes, Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8" class="text-muted text-center">No draft permits
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