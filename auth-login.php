<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
// Include config file
require_once "layouts/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Masukkan Username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Masukkan Password.";
    } else {
        $enc_password = md5($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, nama, password, level FROM pengguna WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $nama, $password, $level);
                    if (mysqli_stmt_fetch($stmt)) {
                        if ($enc_password == $password) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nama"] = $nama;
                            $_SESSION["username"] = $username;
                            $_SESSION["level"] = $level;

                            // Redirect user to welcome page
                            header("location: index.php?page=dashboard");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "Password Salah.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "Username tidak ditemukan.";
                }
            } else {
                echo "Terjadi Kesalahan.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<?php include 'layouts/head-main.php'; ?>

<head>

    <title><?php echo $language["Login"]; ?> | Kasir Batik Widji</title>

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <img src="assets/images/logo-batik.png" alt="" height="100"
                                    class="auth-logo-dark mx-auto">
                                <h3 class="mt-3 text-uppercase">Kasir Batik Widji</h3>
                                <p class="text-muted">Jl. Sunan Abinawa, Desa Lanji, Patebon, Kendal</p>

                                <h5 class="mt-4 text-primary">Selamat Datang !</h5>
                                <p class="text-muted">Login untuk melanjutkan.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Masukkan Username">
                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>

                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" name="password"
                                            placeholder="Masukkan Password">
                                        <span class="text-danger"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-muted p-4">
                        <p class="text-white-50">©
                            <script>document.write(new Date().getFullYear())</script> Batik Widji
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->
</div>
<!-- end authentication section -->

<?php include 'layouts/vendor-scripts.php'; ?>

</body>

</html>