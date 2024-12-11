<?php
function layout($content)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TEST PHP</title>
        <link rel="stylesheet" href="/assets/css/style.css?v=<?= time() ?>">
    </head>

    <body>
        <header>
            <h1>TEST PHP</h1>
            <?php if (isset($_SESSION['token'])): ?>
                <nav>
                    <a href="/logout">Logout</a>
                </nav>
            <?php endif; ?>
        </header>
        <main>
            <?php $content(); ?>
        </main>
        <footer>
            <p>&copy; <?= date('Y') ?> Xbacco Solution</p>
        </footer>
    </body>

    </html>
<?php
}
