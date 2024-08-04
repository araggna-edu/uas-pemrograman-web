<?= $this->extend('/components/layout') ?>

<?= $this->section('content') ?>
    <div class="py-6">
        <div class="bg-tileBackground shadow-smooth rounded-lg p-6 mb-4">
            <div class="flex flex-row">
                <h1 class="text-2xl mb-2">Form Course</h1>
            </div>
            <form id="add-course-form" action="/course/save" method="post" enctype="multipart/form-data" class="flex flex-col gap-5">
                <div class="mb-4">
                    <label for="coursetitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="coursetitle" id="coursetitle" required>
                </div>
                <div class="mb-4">
                    <label for="coursecontent" class="block text-sm font-medium text-gray-700">Content</label>
                    <div id="editor" class="mt-1"></div>
                    <input type="hidden" name="coursecontent" id="coursecontent">
                </div>
                <div class="mb-4">
                    <label for="assets" class="block text-sm font-medium text-gray-700">Assets</label>
                    <label for="assets" class="inline-block px-4 py-2 border-gray-300 text-base font-semibold text-white bg-primary rounded-md cursor-pointer transition hover:bg-accent">Choose Files</label>
                    <input type="file" name="assets[]" id="assets" class="hidden" multiple>
                    <div class="mt-2 text-sm text-gray-700" id="file-names"></div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="button-primary">
                        <i class="las la-save"></i>
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var fileInput = document.getElementById('assets');
        var fileLabel = document.querySelector('label[for="assets"]');
        var fileNames = document.getElementById('file-names');

        fileLabel.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            var files = fileInput.files;
            var fileList = [];
            for (var i = 0; i < files.length; i++) {
                fileList.push(files[i].name);
            }
            fileNames.textContent = fileList.join(', ');
        });
    });
</script>
<script src="/js/quill-editor.js"></script>
<script src="/js/save-courses.js"></script>
<?= $this->endSection() ?>

