<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = json_decode(file_get_contents('./storage.json'));

    $postFlag = str_replace(" ", "", strtolower($_POST['flag']));
    $hashed = hash('sha512', $postFlag);

    foreach ($json->challenges as $c) {
        if ($c->key === $hashed) {
            $c->complete = true;
        }
    }

    $toSave = json_encode($json);
    file_put_contents('./storage.json', $toSave);
}

if (isset($_GET['hash'])) {
    echo hash('sha512', str_replace(" ", "", strtolower($_GET['hash'])));
}

if (isset($_GET['reset'])) {
    $json = json_decode(file_get_contents('./storage.json'));


    foreach ($json->challenges as $c) {

        $c->complete = false;
    }

    $toSave = json_encode($json);
    file_put_contents('./storage.json', $toSave);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpoonsCTF</title>
    <link rel="stylesheet" href="/checker/style.css">
</head>

<body>
    <h1 class="title">SpoonsCTF</h1>
    <div class="box">
        <h1>Challenges</h1>

        <div class="challenge-list">
            <?php
            $json = json_decode(file_get_contents('./storage.json'));


            foreach ($json->challenges as $c) :
            ?>
                <div style="border-color: <?php echo '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>;">
                    <p><?php echo $c->name ?></p>
                    <?php if ($c->complete) : ?>
                        <small class="solved">solved</small>
                    <?php endif; ?>
                </div>
            <?php
            endforeach;
            ?>
        </div>
        <br>
        <br>
        <form action="" method="post">
            <input placeholder="SpoonFlag" type="text" name="flag">
            <button submit>Submit</button>
        </form>
    </div>


</body>

</html>