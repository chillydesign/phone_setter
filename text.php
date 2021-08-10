<?php

include('connect.php');
include('api/functions.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Text Code</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body>
    <main>
        <h1>Text code</h1>


    </main>

    <script>
        const getPhoneNumber = fetch('https://webfactor.ch/phone/text_code.txt')
            .then((r) => r.json())
            .then(json => {
                console.log(json)
            });
    </script>


</body>



</html>