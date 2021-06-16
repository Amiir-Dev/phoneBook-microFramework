<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="<?= assets_url() ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= assets_url() ?>css/all.min.css" />
</head>

<body>

    <div class="container">
        <div class="row">

            <div class="col m-5 p-5">
                <?php if ($deleted_count) : ?>
                    <span class='text-primary'> Contact Deleted Successfully! </span>
                <?php else : ?>
                    <span class="text-danger"> Contact not exists!! </span>
                <?php endif; ?>
            </div>

        </div>

        <div class="row">
            <div class="col mt-3 text-center">
                <img src="<?= assets_url('images/loader.gif') ?>" alt=""><br>
                Redirecting to Home ...
                <script>
                    setTimeout(function() {
                        location.href = "<?= site_url() ?>";
                    }, 2000)
                </script>
            </div>

        </div>


</body>

</html>