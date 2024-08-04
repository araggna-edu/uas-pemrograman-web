<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Learning</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/line-awesome-1.3.0/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>
<body>
    <div class="flex h-screen bg-background">
        <?= $this->include('admin/components/sidebar') ?>

        <div class="flex-1 flex flex-col">
            <?= $this->include('admin/components/header') ?>
            <div class="p-6">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
