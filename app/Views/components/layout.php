<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Learning | Home</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/line-awesome-1.3.0/1.3.0/css/line-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>
<!-- Body -->
<body class="bg-background leading-normal tracking-normal">
    <div class="flex h-screen">

        <?= $this->include('components/navbar') ?>

        <div class="flex-1 flex flex-col">
            <?= $this->include('components/header') ?>
            <?= $this->renderSection('content') ?>
        </div>


    </div>
</body>

<script src="/js/profile-photo.js"></script>
<script src="/js/sidebar.js"></script>

</html>