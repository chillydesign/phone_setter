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
        body {

            font-family: monospace;
        }

        main {
            max-width: 400px;
            text-align: center;
        }

        #text_code {
            display: none;
            padding: 30px;
            background-color: #f4f4f2;
            margin: auto 0;
            font-size: 2em;
        }

        #text_date {
            display: none;
            padding: 10px 30px;
            background-color: #e7e7ea;
            font-size: 0.8em;
            color: #555;
        }
    </style>
</head>

<body>
    <main>

        <div id="text_code"></div>
        <div id="text_date"></div>

    </main>

    <script>
        const getPhoneNumber = fetch('https://webfactor.ch/phone/text_code.txt')
            .then((r) => r.json())
            .then(json => {
                console.log(json)

                const el_text = document.getElementById('text_code');
                el_text.innerHTML = json.Body;
                el_text.style.display = 'block';


                const el_date = document.getElementById('text_date');
                el_date.innerHTML = json.date;
                el_date.style.display = 'block';
            });
    </script>


</body>



</html>