<?php
$name = "Fikrah Damar Huda";
$nickname = "Damar";
$university = "UPM-Vokasi";
$semester = 4;
$skills = [
    ["src" => "pic/photoshop.png", "alt" => "Photoshop"],
    ["src" => "pic/aftereffect.png", "alt" => "After Effects"],
    ["src" => "pic/htmlPicture.png", "alt" => "HTML"],
    ["src" => "pic/cssPicture.png", "alt" => "CSS"],
    ["src" => "pic/pythonPicture.png", "alt" => "Python"]
];
$contact = [
    "phone" => "123-456-789",
    "email" => "fikrah@gmail.com",
    "address" => "Surabaya, Indonesia"
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mini Portfolio</title>
</head>
<body>
    <header>
        <h2>damars</h2>
        <nav>
            <a href="#skills">skills</a>
            <a href="porto.php">portfolio</a>
            <a href="#contact">contact</a>
        </nav>
    </header>
    <div class="container">
        <section class="hero">
            <div>
                <h1>Halo! Nama saya <?php echo $name; ?></h1>
                <p>Biasa disebut <?php echo $nickname; ?>, dan ini adalah mini portfolio yang saya buat</p>
                <button onclick="location.href='#about'">About Me</button>
            </div>
            <img src="pic/fotobener.JPG" alt="Profile Picture">
        </section>
        <section class="about" id="about">
            <h2>About Me</h2>
            <p>Nama saya <?php echo $name; ?>, biasa dipanggil <?php echo $nickname; ?>. Saya adalah mahasiswa <?php echo $university; ?> tahun angkatan 2023 dan saat ini sedang menempuh periode akademik di semester <?php echo $semester; ?>. Selain kegiatan akademik, saya telah mengembangkan berbagai keterampilan, terutama dalam bidang teknologi dan multimedia. Saya memiliki keahlian dalam Editing Video dan Visual Effect, serta mampu menggunakan dan mengoptimalkan tools visual yang menarik dan dinamis. Selain itu, saya juga memiliki minat yang kuat dalam editing pemrograman.</p>
        </section>
        <section class="skills" id="skills">
            <h2>SKILLS</h2>
            <div class="icons">
                <?php foreach ($skills as $skill) : ?>
                    <img src="<?php echo $skill['src']; ?>" alt="<?php echo $skill['alt']; ?>">
                <?php endforeach; ?>
            </div>
        </section>
        <div class="spacer"></div>
    </div>
    <footer class="contact" id="contact">
        <h2>Get in Touch</h2>
        <p>Phone: <?php echo $contact['phone']; ?></p>
        <p>Email: <?php echo $contact['email']; ?></p>
        <p>Address: <?php echo $contact['address']; ?></p>
    </footer>
</body>
</html>
