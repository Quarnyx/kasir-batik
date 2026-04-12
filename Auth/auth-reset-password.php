<?php
// Include config file
require_once "layouts/config.php";

session_start();

if (isset($_GET["token"])) {
    $tokenvalue = $_GET["token"];
    $_SESSION['token'] = $tokenvalue;
}

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = $msg = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please enter the confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    $tokenvalue = $_SESSION['token'];

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE token = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_token);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_token = $tokenvalue;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $msg = "Password updated successfully. Destroy the session, and redirect to login page";
                session_destroy();
                header("location: index.php");
                exit();
            } else {
                $msg = "Oops! Something went wrong. Please try again later.";
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

    <title>Reset Password | Symox - Admin & Dashboard Template</title>
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

                    <div class="text-center mb-4">
                        <a href="index.php">
                            <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Symox</span>
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Reset Password</h5>
                                <p class="text-muted">Reset Password with Symox.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success mt-5" role="alert">
                                        <?php echo $msg; ?>
                                    </div>
                                <?php } ?>


                                <form class="mt-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?token=<?php echo $_SESSION['token']; ?>" method="post">

                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter password" value="<?php echo $new_password; ?>">
                                        <span class="text-danger"><?php echo $new_password_err; ?></span>
                                    </div>

                                    <div class="mb-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="userpassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter confirm password" value="<?php echo $confirm_password; ?>">
                                        <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                                    </div>

                                    <input type="hidden" name="token-value" value="<?php echo $_SESSION['token']; ?>" />

                                    <div class="row  mb-0">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type='submit' name='submit' value='Submit'>Reset</button>
                                        </div>
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
                        <p class="text-white-50">© <script>
                                document.write(new Date().getFullYear())
                            </script> Symox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->
</div>

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

</body>

</html>