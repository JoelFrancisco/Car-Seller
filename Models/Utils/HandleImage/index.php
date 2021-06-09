<?php

require('./ImageVerification.php');

function handleImage($image) {
    $imageVerification = new ImageVerification($image);
    $imageVerification->verifyWidth = false;
    $imageVerification->verifyHeight = false;
    $imageVerification->verifySize = false;

    $errors = $imageVerification->runVerifications();

    if (count($errors) === 0) {
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $image['name'], $ext);

        $image_name = md5(uniqid(time())).".".$ext[1];

        $imagePath = "../Database/Images/".$image_name;

        move_uploaded_file($image['tmp_name'], $imagePath);
        
        return $imagePath;
    } else {
        $show_errors = "";

        foreach ($errors as $error) {
            $show_errors = $show_errors.", ".$error;
        }

        ?>
        <script>
            alert('Erro no cadastro\n'.$show_errors);
            location.href="../../Views/SignUp/index.html";
        </script>
        <?php
    }
}

?>