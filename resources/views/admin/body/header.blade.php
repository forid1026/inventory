  <header id="page-topbar">
      <div class="navbar-header">
          <div class="d-flex align-items-center">
              <!-- LOGO -->
              <div class="navbar-brand-box">
                  <a href="/admin/dashboard" class="logo logo-dark">
                      <span class="logo-sm">
                          <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                      </span>
                      <span class="logo-lg">
                          <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                      </span>
                  </a>

                  <a href="/admin/dashboard" class="logo logo-light">
                      <span class="logo-sm">
                          <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light"
                              height="22">
                      </span>
                      <span class="logo-lg">
                          <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light"
                              height="20">
                      </span>
                  </a>
              </div>

              <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                  id="vertical-menu-btn">
                  <i class="ri-menu-2-line align-middle"></i>
              </button>



          </div>

          <div class="d-flex align-items-center">

              @if (url()->current() == 'http://127.0.0.1:8000/invoice/add')
                  <div style="margin-left: 10px;">
                      <a href="{{ route('purchase.add') }}">
                          <i class="btn btn-info btn wave-effect wave-light fas fa-plus-circle">
                              Add Purchase</i>
                      </a>
                  </div>
                  <div class="dropdown d-none d-lg-inline-block ms-1">
                      <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                          <i class="ri-fullscreen-line"></i>
                      </button>
                  </div>
              @elseif (url()->current() == 'http://127.0.0.1:8000/purchase/add')
                  <div style="margin-left: 10px;">
                      <a href="{{ route('invoice.add') }}">
                          <i class="btn btn-info btn wave-effect wave-light fas fa-plus-circle">
                              Add Sales</i>
                      </a>
                  </div>
                  <div class="dropdown d-none d-lg-inline-block ms-1">
                      <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                          <i class="ri-fullscreen-line"></i>
                      </button>
                  </div>
              @else
                  <div>
                      <a href="{{ route('invoice.add') }}">
                          <i class="btn btn-info btn wave-effect wave-light fas fa-plus-circle">
                              Add Sales</i>
                      </a>
                  </div>
                  <div style="margin-left: 10px;">
                      <a href="{{ route('purchase.add') }}">
                          <i class="btn btn-info btn wave-effect wave-light fas fa-plus-circle">
                              Add Purchase</i>
                      </a>
                  </div>
                  <div class="dropdown d-none d-lg-inline-block ms-1">
                      <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                          <i class="ri-fullscreen-line"></i>
                      </button>
                  </div>
              @endif

              @php
                  $id = Auth::user()->id;
                  $adminData = App\Models\User::find($id);
              @endphp

              <div class="dropdown d-inline-block user-dropdown">
                  <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img class="rounded-circle header-profile-user"
                          src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/no_image.jpg') }}"
                          alt="Header Avatar">
                      <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                      <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                      <!-- item-->
                      <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                              class="ri-user-line align-middle me-1"></i> Profile</a>
                      <a class="dropdown-item" href="{{ route('change.password') }}"><i
                              class="ri-wallet-2-line align-middle me-1"></i> Change Password</a>
                      <a class="dropdown-item d-block" href="#"><span
                              class="badge bg-success float-end mt-1">11</span><i
                              class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                      <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock
                          screen</a>
                      <div class="dropdown-divider"></div>

                      <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                              class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                  </div>
              </div>



          </div>
      </div>
  </header>
