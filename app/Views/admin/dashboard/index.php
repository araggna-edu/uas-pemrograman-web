<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h2 class="text-2xl font-semibold mb-4">Dashboard</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="bg-white p-4 shadow-smooth rounded-lg">
        <h3 class="text-lg font-medium text-gray-800">Welcome Back</h3>
        <p class="text-2xl font-bold text-primary"><?=session()->get('userfullname')?></p>
    </div>
</div>

<?= $this->endSection() ?>

