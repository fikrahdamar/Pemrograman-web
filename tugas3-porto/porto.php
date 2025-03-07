<?php
$portfolio_items = [
    ["src" => "portoPic/porto1.jpg", "desc" => "Pengerjaan Project pada toko azkal apparel untuk edit video"],
    ["src" => "portoPic/porto2.jpg", "desc" => "Pembuatan motion graphic pada suatu perusahaan"],
    ["src" => "portoPic/porto3.jpg", "desc" => "Pengerjaan Project pada toko azkal apparel untuk visual effect dan juga motion editing"],
    ["src" => "portoPic/porto4.jpg", "desc" => "Motion graphic"],
    ["src" => "portoPic/porto5.jpg", "desc" => "Motion graphic dan logo animation pada perusahaan"],
    ["src" => "portoPic/porto6.jpg", "desc" => "Commision music video dengan tema typograph"]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePorto.css">
    <title>Portfolio Section</title>
</head>
<body>
    <header>
        <h2>damars</h2>
        <nav>
            <a href="index.php">skills</a>
            <a href="#portfolio">portfolio</a>
            <a href="index.php">contact</a>
        </nav>
    </header>
    <section class="portfolio" id="portfolio">
        <h2>MY PORTFOLIO</h2>
        <div class="portfolio-grid">
            <?php foreach ($portfolio_items as $item) : ?>
                <div class="portfolio-item">
                    <img src="<?php echo $item['src']; ?>" alt="Portfolio Item">
                    <p><?php echo $item['desc']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
