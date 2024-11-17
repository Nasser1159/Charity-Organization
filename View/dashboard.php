<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Roles Dashboard</title>
</head>
<body>
<header>
        <h1>Roles Dashboard</h1>
</header>

    <div class="row">
        <div class="role">
            <a href="../Controller/ProgramController.php?cmd=viewAll" class="btn">Program Coordinator</a>
        </div>
        <div class="role">
            <a href="../Controller/ItemController.php?cmd=viewAll" class="btn">Warehouse Coordinator</a>
        </div>
        
    </div>
    <div class="row">
        <div class="role">
            <a href="../Controller/DonationController.php?cmd=viewAll" class="btn">Donations History</a>
        </div>
        <div class="role">
            <a href="../Controller/HomeController.php" class="btn">Donate</a>
        </div>
    </div>
    <div class="row">
    <div class="role">
            <a href="supp_dist.htm" class="btn">Procurement Coordinator</a>
        </div>
    </div>

<footer>
        <p>© 2024 Food Bank</p>
</footer>
</body>
</html>
