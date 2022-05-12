

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filter</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            height: 100vh; 
            background-color: #f1f1f1;
        }

        input {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        label {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        select {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        select#color option[value="red"]   { background-image:url('../media/filters/pngegg(5).png');   }
        select#color option[value="green"] { background-image:url('../media/filters/pngegg(2).png'); }
        select#color option[value="blue"] { background-image:url('../media/filters/pngegg(2).png'); }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div>
            <label for="color">Background Color:</label>
            <select name="color" id="color">
                <option value="">--- Choose a color ---</option>
                <option value="red">f1</option>
                <option value="green">f2</option>
                <option value="blue">f3</option>
            </select>
        </div>
        <div>
            <button type="submit">Select</button>
        </div>
    </form>
    <?php

$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);

?>

<?php if ($color) : ?>
    <p>You selected <span style="color:<?php echo $color ?>"><?php echo $color ?></span></p>

<?php else : ?>
    <p>You did not select any color</p>
<?php endif ?>
</body>
</html>