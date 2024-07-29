<?= $this->extend('/components/layout.php'); ?>

<?= $this->section('content') ?>
<main class="flex bg-tileBackground shadow-smooth rounded-2xl mt-10 mr-10">
    <div class="flex-row p-10">
        <h1 class="text-2xl">Home</h1>
        <p>Welcome home</p>
    </div>
</main>

<?= $this->endSection() ?>