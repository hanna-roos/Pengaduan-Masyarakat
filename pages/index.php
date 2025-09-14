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
                    <h3 class="text-center mb-3 mt-3">Login Sekarang</h3>
                    <form class="row g-3" action="cek_login.php" method="post">

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" placeholder="Isi Username Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Isi Password Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="level">Anda adalah Seorang:</label>
                            <select id="level" name="level" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="masyarakat">Masyarakat</option>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="submit" name="submit" value="Login now" class="btn btn-success w-100">
                           <p class="text-center mt-3">Don't Have An Account? <a href="regis.php">Sign Up Now</a></p> 
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>