<?= $this->extend('/components/layout') ?>

<?= $this->section('content') ?>
    <div class="py-6">
        <div class="bg-tileBackground shadow-smooth rounded-lg p-6 mb-4">
            <div class="text-xl font-semibold text-gray-900 mb-2"><?= $course->coursetitle ?></div>
            <div class="text-sm text-gray-600 mb-4">Created on: <?= $course->createddate ?> by <?= $course->userfullname?></div>
            <div class="text-base text-gray-800 mb-4 quill-content"><?= $course->coursecontent ?></div>
        </div>

        <div class="bg-tileBackground shadow-smooth rounded-lg p-6 mb-4 <?= (!session()->has('userid')) ? 'hidden' : 'block' ?> ">
            <div class="comment-section">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Comments</h3>
                <div id="comments-list"></div>
                <div id="comment-loader" class="text-center py-2 hidden">
                    <img src="/images/loading.gif" alt="Loading..." class="mx-auto" />
                </div>
                <form id="comment-form" method="POST">
                    <label for="comment"></label><textarea id="comment" name="comment" rows="4" class="w-full p-2 border rounded" placeholder="Write your comment..."></textarea>
                    <input type="hidden" id="course-id" value="<?= $course->courseid ?>"> <!-- Hidden input to store the course ID -->
                    <button type="submit" class="mt-2 button-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/lazy-load-comments.js"></script>
    <script src="/js/save-comments.js"></script>
<?= $this->endSection() ?>
