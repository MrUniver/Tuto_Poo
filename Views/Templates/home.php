<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $this->title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Webroot/css/bootstrap.css">
    <link rel="stylesheet" href="Webroot/css/home.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href=".">TutoChat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="utilisateurs">Les utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="modifier">Modifier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chat">Discuter</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item"><a href="logout" class="nav-link">Deconnecter</a></li>
        </ul>
    </div>
</nav>

<div class="content">
    <?= $page_content ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./Webroot/Js/Validator.js"></script>
<script src="./Webroot/Js/Validator.js"></script>
<script src="./Webroot/Js/Sender.js"></script>
<script src="./Webroot/Js/message_status.js"></script>
</body>
</html>