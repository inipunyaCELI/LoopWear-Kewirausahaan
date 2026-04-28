<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin LoopWear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">LoopWear Admin</span>
        </div>
    </nav>
    
    <div class="container">
        @yield('konten')
    </div>

    @if (session('status'))
    <script>
        Swal.fire({
            title: "{{ session('status')['judul'] }}",
            text: "{{ session('status')['pesan'] }}",
            icon: "{{ session('status')['icon'] }}",
            timer: 2000,
            showConfirmButton: false
        })
    </script>
    @endif
</body>
</html>