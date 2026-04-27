<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- HEADER -->
<nav class="navbar navbar-light bg-white shadow px-4">
    <span class="navbar-brand mb-0 h1">My App</span>

    <div>
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
        </button>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
        </button>
    </div>
</nav>

<!-- MAIN -->
<div class="container text-center mt-5">
    <h2>Welcome to Home Page 🚀</h2>
</div>

<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-3">

      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="modal-body">
            <input type="email" name="email" placeholder="Email" class="form-control mb-2">
            <input type="password" name="password" placeholder="Password" class="form-control mb-2">
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary w-100">Login</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- REGISTER MODAL -->
<div class="modal fade" id="registerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-3">

      <div class="modal-header">
        <h5 class="modal-title">Register</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="modal-body">
            <input type="text" name="name" placeholder="Name" class="form-control mb-2">
            <input type="email" name="email" placeholder="Email" class="form-control mb-2">
            <input type="password" name="password" placeholder="Password" class="form-control mb-2">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control mb-2">
        </div>

        <div class="modal-footer">
            <button class="btn btn-success w-100">Register</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>