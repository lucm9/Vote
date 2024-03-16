<?php 
    // Start PHP code block
    get_header(); // Include header file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Polls</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/dist/css/nav.css">
    <style>
        .h-100 {
            height: calc(100vh - 5rem) !important;
            max-height: 924px;
        }
    </style>
</head>

<body>
    <?php include(get_template_directory() . '/includes/nav.php'); ?> <!-- Include nav.php -->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="font-weight-bold">Welcome To Voting Day!</h1>
                    <hr class="divider">
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5" style="text-align: center;">Get started with our advanced poll maker to create polls in seconds and get answers in no time</p>
                    <?php if (isset($_SESSION["username"])) : ?>
                        <a class="btn btn-primary btn-xl" href="vote.php">Vote Now</a> <!-- Redirect to vote.php if user is signed in -->
                    <?php else : ?>
                        <a class="btn btn-primary btn-xl" href="/auth/login">Sign In to Vote</a> <!-- Redirect to login page if user is not signed in -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Removed Voting Section -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<?php get_footer(); // Include footer file ?>
