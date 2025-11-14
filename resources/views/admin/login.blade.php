<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Admin</title>
  <link rel="shortcut icon" type="image/png" href="img/logos/logo.png" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset("img/logos/Naura Farma.png")}}" alt="" class="nf"/>
                </a>
                <p class="text-center">Login sekarang</p>
                <form action="{{ route('admin.login.submit') }}" method="POST">
                  @csrf
                
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                  </div>
                
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>
                
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="{{ route('admin.password') }}">Lupa Password?</a>
                  </div>
                
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum punya akun ?</p>
                    <a class="text-primary fw-bold ms-2" href="{{ route('admin.daftar') }}">Daftar</a>
                  </div>
                
                  @if($errors->any())
                    <div class="alert alert-danger mt-3">
                      @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                      @endforeach
                    </div>
                  @endif
                
                  @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                  @endif
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>