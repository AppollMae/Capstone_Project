@extends('layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="" class="app-brand-link">
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
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
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
                            <a href="{{ route('admin.accounts.view-accounts') }}" class="menu-link">
                                <div data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.accounts.edit-account', Auth::user()->id) }}" class="menu-link">
                                <div data-i18n="Notifications">Update Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Notifications">Settings</div>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="menu-item {{ $ActiveMenu === 'user_management' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-list-check"></i>
                        <div data-i18n="Account Settings">User Management</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ $SubActive === 'Staff/Inspector' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Account">Staff/Inspector</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.user_management.applicant-user-list') }}" class="menu-link">
                                <div data-i18n="Notifications">Applicant</div>
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
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Admin User Management /</span>Show All Accounts
                    </h4>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> All Accounts</a>
                                </li>
                            </ul>

                            <div class="card mb-4">
                                <h5 class="card-header">User Management</h5>
                                <hr class="my-0" />

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Avatar</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                @if(in_array(strtolower($user->role), ['bfp', 'mpdo', 'obo', 'treasurer']))
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ strtoupper($user->role) }}</td>
                                                    <td>
                                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
                                                            alt="avatar"
                                                            width="50"
                                                            height="50"
                                                            class="rounded">
                                                    </td>
                                                    <td>
                                                        <!-- View Button -->
                                                        <a href="#"
                                                            class="btn btn-info btn-sm shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewModal-{{ $user->id }}"
                                                            title="View">
                                                            <i class="bx bx-show"></i>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="viewModal-{{ $user->id }}" tabindex="-1" aria-labelledby="viewModalLabel-{{ $user->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content border-0 shadow-lg rounded-4">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header border-0 bg-gradient" style="background: linear-gradient(135deg, #0d6efd, #6610f2);">
                                                                        <h5 class="modal-title text-white fw-semibold" id="viewModalLabel-{{ $user->id }}">
                                                                            <i class="bx bx-user-circle me-1"></i> User Information
                                                                        </h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <!-- Modal Body -->
                                                                    <div class="modal-body px-4 py-4">
                                                                        <div class="text-center mb-4">
                                                                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
                                                                                alt="avatar"
                                                                                class="rounded-circle shadow-sm mb-3"
                                                                                width="100"
                                                                                height="100">
                                                                            <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                                                                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                                                                        </div>

                                                                        <div class="border-top pt-3 mt-3">
                                                                            <div class="row mb-2">
                                                                                <div class="col-4 fw-semibold text-muted">Role:</div>
                                                                                <div class="col-8">{{ ucfirst($user->role) }}</div>
                                                                            </div>

                                                                            <div class="row mb-2">
                                                                                <div class="col-4 fw-semibold text-muted">Joined:</div>
                                                                                <div class="col-8">{{ $user->created_at->format('F d, Y') }}</div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-4 fw-semibold text-muted">Status:</div>
                                                                                <div class="col-8">
                                                                                    @if($user->status === 'active')
                                                                                    <span class="bg-success px-3 py-2 rounded-pill shadow-sm">Active</span>
                                                                                    @else
                                                                                    <span class="bg-danger px-3 py-2 rounded-pill shadow-sm">Inactive</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal Footer -->
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                                            <i class="bx bx-x-circle me-1"></i> Close
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Edit Button -->
                                                        <!-- Edit Button -->
                                                        <a href="#"
                                                            class="btn btn-warning btn-sm shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editRoleModal-{{ $user->id }}"
                                                            title="Edit">
                                                            <i class="bx bx-edit"></i>
                                                        </a>

                                                        <!-- Edit Role Modal -->
                                                        <div class="modal fade" id="editRoleModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editRoleModalLabel-{{ $user->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-0 shadow-lg rounded-4">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header border-0 bg-gradient" style="background: linear-gradient(135deg, #ffc107, #fd7e14);">
                                                                        <h5 class="modal-title text-white fw-semibold" id="editRoleModalLabel-{{ $user->id }}">
                                                                            <i class="bx bx-user-check me-1"></i> Edit User Role
                                                                        </h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <!-- Modal Body -->
                                                                    <form action="{{ route('admin.user_management.user-update-role', $user->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body px-4 py-4">
                                                                            <!-- User Info (Read-Only) -->
                                                                            <div class="text-center mb-3">
                                                                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('sneat/img/avatars/1.png') }}"
                                                                                    alt="avatar"
                                                                                    class="rounded-circle shadow-sm mb-2"
                                                                                    width="90"
                                                                                    height="90">
                                                                                <h6 class="fw-bold mb-0">{{ $user->name }}</h6>
                                                                                <p class="text-muted small mb-0">{{ $user->email }}</p>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-semibold">Current Role</label>
                                                                                <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                                                                            </div>

                                                                            <!-- Editable Role -->
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-semibold">Change Role</label>
                                                                                <select name="role" class="form-select" required>
                                                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                                                    <option value="mpdo" {{ $user->role === 'mpdo' ? 'selected' : '' }}>MPDO - Municipal Planning and Development Office</option>
                                                                                    <option value="bfp" {{ $user->role === 'bfp' ? 'selected' : '' }}>BFP - Bureau of Fire Protection</option>
                                                                                    <option value="obo" {{ $user->role === 'obo' ? 'selected' : '' }}>OBO - Office of the Building Official</option>
                                                                                    <option value="treasurer" {{ $user->role === 'treasurer' ? 'selected' : '' }}>Treasurer</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Modal Footer -->
                                                                        <div class="modal-footer border-0">
                                                                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                                                <i class="bx bx-x-circle me-1"></i> Cancel
                                                                            </button>
                                                                            <button type="submit" class="btn btn-warning rounded-pill px-4">
                                                                                <i class="bx bx-save me-1"></i> Save Changes
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach

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
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Jas<span
                                    class="fw-bold" style="color: #ff6347;">Coder</span></a>
                        </div>
                        <div>
                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Contuct Us</a>

                            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                target="_blank" class="footer-link me-4">Documentation</a>

                            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                                class="footer-link me-4">Support</a>
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