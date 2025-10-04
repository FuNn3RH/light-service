<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="5">
  <title>Online Players</title>
    <link rel="shortcut icon" href="<?php echo asset('assets/img/rust.png') ?>" type="image/png">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #212121;
      margin: 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-direction: column;
      height: 70vh;
    }

    .container{
        width: 600px;
        height: 100%;
    }

    .cmd-item{
        margin-bottom: 1rem;
        font-size: 1.1rem;
        font-weight: bold;
        padding-bottom: 1rem;
        border-bottom: 1px solid #fff;
    }

    .time{
        color: rgba(37, 95, 37, 1);
    }

    .name{
        color: orange;
        margin-right: 0.5rem;
    }

    .cmd{
        color: #aaaaaa;
    }

  </style>
</head>
<body>

<div class="container">
    <?php foreach ($cmds as $cmd): ?>
        <div class="cmd-item">
            <span class="time"><?php echo $cmd['time'] ?></span>
            <span class="name"><?php echo ucfirst($cmd['name']) ?></span>
            <span class="cmd"><?php echo $cmd['cmd'] ?></span>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
