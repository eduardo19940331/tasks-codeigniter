<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Network Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;900&family=Exo+2:wght@300;400;500;600;700&family=Audiowide&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/template/tooplate-neural-style.css') ?>" rel="stylesheet">

    <!-- CSS IMPORTS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="//cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css" rel="stylesheet">


    <!-- Tooplate 2139 Neural Portfolio
https://www.tooplate.com/view/2139-neural-portfolio
Free HTML CSS Template-->

</head>

<body>
    <canvas id="neural-bg"></canvas>

    <nav id="navbar">
        <div class="nav-container">
            <a href="#home" class="logo-container">
                <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <!-- Neural Network Logo -->
                    <circle cx="50" cy="20" r="8" fill="none" stroke="#00ffff" stroke-width="2" />
                    <circle cx="25" cy="50" r="8" fill="none" stroke="#ff00ff" stroke-width="2" />
                    <circle cx="75" cy="50" r="8" fill="none" stroke="#ff00ff" stroke-width="2" />
                    <circle cx="50" cy="80" r="8" fill="none" stroke="#ffff00" stroke-width="2" />

                    <!-- Connections -->
                    <line x1="50" y1="28" x2="25" y2="42" stroke="#00ffff" stroke-width="1" opacity="0.6" />
                    <line x1="50" y1="28" x2="75" y2="42" stroke="#00ffff" stroke-width="1" opacity="0.6" />
                    <line x1="25" y1="58" x2="50" y2="72" stroke="#ff00ff" stroke-width="1" opacity="0.6" />
                    <line x1="75" y1="58" x2="50" y2="72" stroke="#ff00ff" stroke-width="1" opacity="0.6" />

                    <!-- Center node -->
                    <circle cx="50" cy="50" r="5" fill="#00ffff" />
                    <line x1="50" y1="28" x2="50" y2="45" stroke="#00ffff" stroke-width="1" opacity="0.6" />
                    <line x1="50" y1="55" x2="50" y2="72" stroke="#ffff00" stroke-width="1" opacity="0.6" />
                    <line x1="33" y1="50" x2="45" y2="50" stroke="#ff00ff" stroke-width="1" opacity="0.6" />
                    <line x1="55" y1="50" x2="67" y2="50" stroke="#ff00ff" stroke-width="1" opacity="0.6" />
                </svg>
                <span class="logo-text">TASK's</span>
            </a>

            <div class="mobile-menu-toggle" id="mobile-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="nav-menu" id="nav-menu">
                <?= $this->renderSection('menu') ?>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>


    <!-- JS IMPORT -->
    <!-- Se incorpora JQ solamente por DataTable no hay ningun archivo personalizado que lo utilize -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

    <script src="<?= base_url('js/template/tooplate-neural-scripts.js') ?>"></script>


    <?= $this->renderSection('script') ?>

</body>

</html>