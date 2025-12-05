<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Admin</title>
  <link rel="shortcut icon" type="image/png" href="img/logos/logo.png" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="{{ asset("img/logos/Naura Farma.png")}}" alt="" class="nf"/>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/dashboard-admin" aria-expanded="false" onclick="return false;">
                <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Data</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="/user-admin" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <iconify-icon icon="solar:user-line-duotone"></iconify-icon>
                  </span>
                  <span class="hide-menu">User</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="/transaksi-admin" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                    <iconify-icon icon="solar:hand-money-line-duotone"></iconify-icon>
                  <span class="hide-menu">Transaksi</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="/riwayat-admin" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                    <iconify-icon icon="solar:history-2-line-duotone"></iconify-icon>
                  <span class="hide-menu">Riwayat</span>
                </div>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">kelola</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="/transaksi-admin" aria-expanded="false" onclick="return false;">
                <div class="d-flex align-items-center gap-3">
                    <iconify-icon icon="solar:cat-line-duotone"></iconify-icon>
                  <span class="hide-menu">Kategori</span>
                </div>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="message-body">
                  <a href="javascript:void(0)" class="dropdown-item">
                    Item 1
                  </a>
                  <a href="javascript:void(0)" class="dropdown-item">
                    Item 2
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('img/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          <div class="row">
            <div class="col-lg-8 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Revenue Forecast</h5>
                    </div>
                    <div>
                      <select class="form-select">
                        <option value="1">March 2025</option>
                        <option value="2">April 2025</option>
                        <option value="3">May 2025</option>
                        <option value="4">June 2025</option>
                      </select>
                    </div>
                  </div>
                  <div id="revenue-forecast"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                        <span
                          class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                          <iconify-icon icon="solar:football-outline" class="fs-6 text-secondary"> </iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4">New Customers</h6>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-6">
                        <h6 class="mb-0 fw-medium">New goals</h6>
                        <h6 class="mb-0 fw-medium">83%</h6>
                      </div>
                      <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100" style="height: 7px;">
                        <div class="progress-bar bg-secondary" style="width: 83%"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center gap-6 mb-4">
                        <span
                          class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                          <iconify-icon icon="solar:box-linear" class="fs-6 text-danger"></iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4">Total Income</h6>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <h4>$680</h4>
                          <span class="fs-11 text-success fw-semibold">+18%</span>
                        </div>
                        <div class="col-6">
                          <div id="total-income"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Revenue by Product</h5>
                  <div class="table-responsive" data-simplebar>
                    <table class="table text-nowrap align-middle table-custom mb-0">
                      <thead>
                        <tr>
                          <th scope="col" class="text-dark fw-normal ps-0">Assigned
                          </th>
                          <th scope="col" class="text-dark fw-normal">Progress</th>
                          <th scope="col" class="text-dark fw-normal">Priority</th>
                          <th scope="col" class="text-dark fw-normal">Budget</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <img src=".images/products/dash-prd-1.jpg" alt="prd1" width="48"
                                class="rounded" />
                              <div>
                                <h6 class="mb-0">Minecraf App</h6>
                                <span>Jason Roy</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span>73.2%</span>
                          </td>
                          <td>
                            <span class="badge bg-success-subtle text-success">Low</span>
                          </td>
                          <td>
                            <span class="text-dark">$3.5k</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <img src=".images/products/dash-prd-2.jpg" alt="prd1" width="48"
                                class="rounded" />
                              <div>
                                <h6 class="mb-0">Web App Project</h6>
                                <span>Mathew Flintoff</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span>73.2%</span>
                          </td>
                          <td>
                            <span class="badge bg-warning-subtle text-warning">Medium</span>
                          </td>
                          <td>
                            <span class="text-dark">$3.5k</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <img src=".images/products/dash-prd-3.jpg" alt="prd1" width="48"
                                class="rounded" />
                              <div>
                                <h6 class="mb-0">Modernize Dashboard</h6>
                                <span>Anil Kumar</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span>73.2%</span>
                          </td>
                          <td>
                            <span class="badge bg-secondary-subtle text-secondary">Very
                              High</span>
                          </td>
                          <td>
                            <span class="text-dark">$3.5k</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center gap-6">
                              <img src=".images/products/dash-prd-4.jpg" alt="prd1" width="48"
                                class="rounded" />
                              <div>
                                <h6 class="mb-0">Dashboard Co</h6>
                                <span>George Cruize</span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span>73.2%</span>
                          </td>
                          <td>
                            <span class="badge bg-danger-subtle text-danger">High</span>
                          </td>
                          <td>
                            <span class="text-dark">$3.5k</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <div class="mb-4">
                    <h5 class="card-title fw-semibold">Daily activities</h5>
                  </div>
                  <ul class="timeline-widget mb-0 position-relative mb-n5">
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time mt-n1 text-muted flex-shrink-0 text-end">09:46
                      </div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge bg-primary flex-shrink-0 mt-2"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John
                        Doe of $385.90</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                      </div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge bg-warning flex-shrink-0"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">New sale
                        recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                      </div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge bg-warning flex-shrink-0"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n6">Payment was made of $64.95
                        to Michael</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                      </div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge bg-secondary flex-shrink-0"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">New sale
                        recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                      </div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge bg-danger flex-shrink-0"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n6 fw-semibold">Project meeting
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time mt-n6 text-muted flex-shrink-0 text-end">09:46
                      </div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge bg-primary flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n6">Payment received from John
                        Doe of $385.90</div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>