<?= $this->extend('/components/layout.php'); ?>

<?= $this->section('content'); ?>
<main class="flex flex-col items-center rounded-2xl gap-y-10">

    <div id="content" class="container mb-10">
        <?= view('/components/courses-content.php'); ?>
        <!-- Content will be loaded here -->
    </div>

    <div id="loader" class="text-center py-4">
        <img src="/images/loading.gif" alt="Loading..." class="mx-auto" /> <!-- Loader GIF -->
    </div>
</main>

<script src="/js/lazy-load-courses.js"></script>
<?= $this->endSection() ?>

