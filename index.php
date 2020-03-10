<?php

include('connect.php');
include('api/functions.php');

$clients = []; //get_clients();
// $current_phone = current_phone();


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
    <main>
        <h1>Calling:  <span id="current_phone"></span></h1>
     
        <div class="table_container">
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
    <tbody id="clienttbody">


    <?php foreach($clients as $client) : ?>
        <?php $selected = ($client->phone == $current_phone) ? 'class="selected"' : '' ; ?>
        <tr <?php echo $selected; ?>>
        <td><?php echo $client->phone; ?></td>
        <td><?php echo $client->first_name; ?></td>
        <td><?php echo $client->last_name; ?></td>
        <td><?php echo $client->company_name; ?></td>
        <td>
        <div class="button_container">
        <a href="assign_number.php?phone=<?php echo $client->phone; ?>"  data-number="<?php echo $client->phone;?>"   class="call_button button">Call</a>
        <a href="client_delete.php?id=<?php echo $client->id; ?>" class="delete">x</a>
        </div>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>
    </div>

   
        <form action="client_create.php" method="post">
            <div class="table_container">
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
        </div>
        </form>




    </main>

    <script>

        // const getPhoneNumber = fetch('https://webfactor.ch/phone/phone.txt')
        //     .then((r) => r.text())
        //     .then(body => {
        //         console.log(body)
        //     });

    </script>

    <script src="scripts.js"></script>

</body>



</html>