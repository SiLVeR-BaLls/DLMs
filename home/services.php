<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - MySite</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    
<?php include 'includes/header.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <main>
        <section class="services">
            <h1>Our Services</h1>
            <div class="service-item">
                <h2>Service One</h2>
                <p>Description of service one.</p>
            </div>
            <div class="text-group">
                    <label for="Fname">Firstname</label>
                    <input id="Fname" name="Fname" class="box" type="text" placeholder="Firstname" required>
                </div>
                <div class="text-group">
                    <label for="Sname">Surename</label>
                    <input id="Sname" name="Sname" class="box" type="text" placeholder="Surename" required>
                </div>
            <div class="service-item">
                <h2>Service Two</h2>
                <p>Description of service two.</p>
            </div>
            <div class="service-item">
                <h2>Service Three</h2>
                <p>Description of service three.</p>
            </div>
        </section>
    
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
