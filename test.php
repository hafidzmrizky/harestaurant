<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<form> 
<input type='text' name='newMSG' id='lcTextInput' placeholder='Type a Message'>
    <input type='submit' value='Send' id="submit">
</form>
<script>
$('#submit').click(function()
{
var message=$("#lcTextInput").val();
    $.ajax({
        url: "http://localhost:3000/process/process_cart.php", 
        type:'POST',
        data:
        {
            menuID: message
        },
        success: function(msg)
        {
            alert('ok')
            $(".li").append(message);
        }               
    });

return false;
});
</script>
</body>
</html>