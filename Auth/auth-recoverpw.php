<?php
// Include config file
require_once "layouts/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
$useremail_err = $msg = "";
// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/$uri_segments[1]";
if (isset($_POST['submit'])) {

    $useremail = mysqli_real_escape_string($link, $_POST['useremail']);
    $sql = "SELECT * FROM users WHERE useremail = '$useremail'";
    $query = mysqli_query($link, $sql);
    $emailcount = mysqli_num_rows($query);

    if ($emailcount) {
        $userdata = mysqli_fetch_array($query);
        $username = $userdata['username'];
        $token = $userdata['token'];

        $subject = "Password Reset";
        $body = "Hi, $username. Click here to reset your password " . $actual_link . "/auth-reset-password.php?token=$token ";
        $sender_email = "From: $gmailid";

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->Username = $gmailid;
            $mail->Password = $gmailpassword;

            // Sender and recipient settings
            $mail->setFrom($gmailid, $gmailusername);
            $mail->addAddress($useremail, $username);
            $mail->addReplyTo($gmailid, $gmailusername); // to set the reply to

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            $msg = "We have emailed your password reset link!";
            // header("location:auth-login.php");
        } catch (Exception $e) {
            $useremail_err =  "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $useremail_err = "No Email Found";
    }
}
?>

<?php include 'layouts/head-main.php'; ?>

    <head>
        
        <title><?php echo $language["Recover_Password"]; ?> | Symox - Admin & Dashboard Template</title>

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
                                    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
        
                                        <div class="mb-3 <?php echo (!empty($useremail_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label" for="useremail">Email</label>
                                            <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter email">
                                            <span class="text-danger"><?php echo $useremail_err; ?></span>
                                        </div>
                                        
                                        <div class="mt-3 text-end">
                                            <button class="btn btn-primary w-sm waves-effect waves-light" name='submit' value='Submit' type="submit">Reset</button>
                                        </div>
                
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Remember It ? <a href="auth-login.php" class="fw-medium text-primary"> Sign in </a></p>
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
                            <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> Symox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
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
