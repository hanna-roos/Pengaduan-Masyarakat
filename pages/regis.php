<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
</head>
<body>

    <div class="container-fluid">
        <div class="container mt-5 p-5 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <h3 class="text-center mb-3 mt-3">Registrasi Sekarang</h3>
                    <form action="cek_regis.php" class="row g-3"  method="post">

                        <div class="form-group">
                            <label for="username">NIK:</label>
                            <input type="text" class="form-control" name="nik" placeholder="Isi NIK Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap:</label>
                            <input type="text" class="form-control" name="nama" placeholder="Isi Nama Lengkap Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" placeholder="Isi Username Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Isi Password Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="telpon">Telpon:</label>
                            <input type="number" class="form-control" name="telp" placeholder="Isi Telepon Anda" required>
                        </div>

                        <div class="col-12">
                            <input type="submit" name="submit" value="Regis now" class="btn btn-success w-100">
                           <p class="text-center mt-3">Already Have An Account? <a href="index.php">Sign in here</a></p> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>