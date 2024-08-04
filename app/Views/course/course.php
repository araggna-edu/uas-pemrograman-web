<?= $this->extend('/components/layout.php'); ?>

<?= $this->section('content') ?>
<main class="flex bg-tileBackground shadow-smooth rounded-2xl flex-col gap-5 mt-10 ">
    <div class="flex flex-row items-center justify-between p-6">
        <h1 class="text-2xl">Your Course</h1>

        <a href="course/add" class="button-primary">
            <i class="las la-plus"></i>
            Add Course
        </a>
    </div>

    <div class="flex flex-col">
        <div class="px-6 mb-6" id="courses-table"></div>
    </div>

</main>

<script src="/js/grid-my-course.js"></script>
<?= $this->endSection() ?>

