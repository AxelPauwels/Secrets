<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Axel Pauwels">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>/Raspi.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
    <link rel="stylesheet"
          href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">

    <title>Secrets</title>

    <!-- Bootstrap Core CSS -->
    <?php echo stylesheet("bootstrap.css"); ?>
    <!-- Custom CSS -->
    <?php echo stylesheet("heroic-features.css"); ?>
    <!-- Buttons CSS -->
    <?php echo stylesheet("buttons.css"); ?>
    <!-- my CSS -->
    <?php echo stylesheet("secrets.css"); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php echo javascript("jquery-3.1.0.min.js"); ?>
    <?php echo javascript("bootstrap.js"); ?>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js"></script>
    <script type="text/javascript">
        var site_url = '<?php echo site_url(); ?>';
        var base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
<!-- Navigation -->
<nav id="master-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo site_url('/messages') ?>">Messages</a>
                </li>
                <li>
                    <a href="<?php echo site_url('/passwords') ?>">Passwords</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->

    </div>
    <!-- /.container -->
</nav>
<!-- /Navigation -->

<!-- Page Content -->
<div id="master-content" class="container">
    <div id="master-content-title">
        <h3><?php echo $title; ?></h3>
        <h6><?php echo $subtitle; ?></h6>
    </div>
    <?php echo $content; ?>
</div>

<footer id="master-footer">
    <?php echo $footer; ?>
</footer>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>
