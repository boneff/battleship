<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<pre>
<?php echo $output; ?>
</pre>
<form name="input" action="index.php" method="post">
    Enter coordinates (row, col), e.g. A5
    <input size="5" name="coordinates" autocomplete="off" autofocus="" type="input">
    <input type="submit">
</form>
</body>
</html>
