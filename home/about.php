<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - MySite</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <main>
        <section class="about">
            <h1>About Us</h1>
            <p>We are dedicated to providing top-notch services tailored to meet your needs.</p>

            <h2>Our Mission</h2>
            <p>We aim to empower individuals and businesses with innovative solutions.</p>
            <div class="text-group">
                    <label for="Fname">Firstname</label>
                    <input id="Fname" name="Fname" class="box" type="text" placeholder="Firstname" required>
                </div>
                <div class="text-group">
                    <label for="Sname">Surename</label>
                    <input id="Sname" name="Sname" class="box" type="text" placeholder="Surename" required>
                </div>
            <h2>Our Team</h2>
            <div class="team">
                <div class="team-member">
                    <img src="assets/team1.jpg" alt="Team Member 1">
                    <h3>Jane Doe</h3>
                    <p>CEO & Founder</p>
                </div>
                <div class="team-member">
                    <img src="assets/team2.jpg" alt="Team Member 2">
                    <h3>John Smith</h3>
                    <p>Lead Developer</p>
                </div>
            </div>
        </section>
        
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
