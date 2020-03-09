<?php

include('connect.php');
include('functions.php');

$clients = get_clients();
$current_phone = current_phone()


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Phone</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body>
    <div>
        <h1>Calling: <?php echo $current_phone; ?></h1>
     

<table>
    <thead>
        <tr>
        <th>Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Company</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($clients as $client) : ?>
        <?php $selected = ($client->phone == $current_phone) ? 'class="selected"' : '' ; ?>
        <tr <?php echo $selected; ?>>
        <td><?php echo $client->phone; ?></td>
        <td><?php echo $client->first_name; ?></td>
        <td><?php echo $client->last_name; ?></td>
        <td><?php echo $client->company_name; ?></td>
        <td><form action="assign_number.php" method="post"><input type="hidden" name="phone" value="<?php echo $client->phone; ?>" /><button name="submit" type="submit">Call</button></form></td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>

   
        <form action="client_create.php" method="post">
        <table class="new_phone">
        <tbody>
        <tr>
        <td> <input required type="text" name="phone" id="phone" placeholder="Number" /></td>
           <td> <input required type="text" name="first_name" id="first_name" placeholder="First Name" /></td>
           <td> <input required type="text" name="last_name" id="last_name" placeholder="Last Name" /></td>
           <td> <input  type="text" name="company_name" id="company_name" placeholder="Company" /></td>
           <td> <button name="directory_submit" id="directory_submit" type="submit">Add to directory </button></td>
        </tr></tbody>
        </table>
       
        </form>




    </div>

    <script>



        const getPhoneNumber = fetch('https://webfactor.ch/phone/phone.txt')
            .then((r) => r.text())
            .then(body => {

                console.log(body)

            });


    </script>

</body>



</html>