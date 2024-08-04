document.addEventListener('DOMContentLoaded', () => {
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Compose your content here...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['image', 'code-block']
            ],
            imageResize: {
                modules: ['Resize', 'DisplaySize', 'Toolbar']
            }
        }
    });

    let htmlContent = document.getElementById('coursecontent').value;
    quill.root.innerHTML = htmlContent;

    window.quill = quill;
});