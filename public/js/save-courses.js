document.getElementById('add-course-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData();
    const quillContent = window.quill.root.innerHTML;
    formData.append('coursetitle', document.getElementById('coursetitle').value);
    formData.append('coursecontent', quillContent);

    const files = document.getElementById('assets').files;
    for (const element of files) {
        formData.append('assets[]', element);
    }

    let courseId = null;
    if (document.getElementById("courseid") !== null) {
        courseId = document.getElementById("courseid").value;
        formData.append('courseid', courseId)
    }

    let url = '/api/course/save';
    if (courseId !== null) {
        url = '/api/course/update'
    }
    fetch(url, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success === true) {
                Swal.fire('Success', data.message, 'success');
                // Optionally, you can reset the form or redirect the user
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => console.error('Error:', error));
});