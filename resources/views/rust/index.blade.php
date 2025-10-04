<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="10">
    <title>Online Players</title>
    <link rel="shortcut icon" href="{{ vAsset('assets/power-schedules/img/rust.png') }}" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #212121;
            margin: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #0f0;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            color: #fff;
        }

        th {
            background-color: rgba(83, 83, 83, 1);
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 5rem;
        }

        #offline-players h1 {
            color: #f00;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <h1>Online Players</h1>
            <table>
                <thead>
                    <tr>
                        <th>Player Name</th>
                        <th>Playtime</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($players)): ?>
                    <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?php echo ucfirst($player['name']); ?></td>
                        <td data-playtime="<?php echo $player['join_time']; ?>" data-status="online" title="<?php echo $player['join_time']; ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="2" style="text-align: center;">No online players</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div id="offline-players">
            <h1>Offline Players</h1>
            <table>
                <thead>
                    <tr>
                        <th>Player Name</th>
                        <th>Last Online</th>
                        <th>Last Online Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($leftPlayers)): ?>
                    <?php foreach ($leftPlayers as $player): ?>
                    <tr>
                        <td><?php echo ucfirst($player['name']); ?></td>
                        <td><?php
                        $join = strtotime($player['join_time']);
                        $left = strtotime($player['left_time']);
                        $diff = $left - $join;
                        echo gmdate('H:i:s', $diff);
                        ?>
                        </td>
                        <td data-playtime="<?php echo $player['left_time']; ?>" data-status="offline" title="<?php echo $player['left_time']; ?>">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">No offline players</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
    <script>
        const playTimesTd = document.querySelectorAll('td[data-playtime]')

        function updateTimer() {
            playTimesTd.forEach(td => {
                const playtime = td.dataset.playtime;
                const now = new Date();
                const diff = now - new Date(playtime);

                const days = Math.floor(diff / 1000 / 60 / 60 / 24);
                const hours = Math.floor((diff / 1000 / 60 / 60) % 24);
                const minutes = Math.floor((diff / 1000 / 60) % 60);
                const seconds = Math.floor((diff / 1000) % 60);
                td.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s ${
                td.dataset.status === 'offline' ? '<span style="color:#727272;">ago</span>' : ''
            }`;
            });
        }

        updateTimer();
        setInterval(() => {
            updateTimer();
        }, 1000);
    </script>

</body>

</html>
