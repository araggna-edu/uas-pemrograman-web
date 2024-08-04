document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const courseId = document.getElementById('course-id').value;
        const comment = document.getElementById('comment').value;

        fetch('/api/comment/save', {
            method: 'POST',
            body: JSON.stringify({
                courseId: courseId,
                comment: comment,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    Swal.fire('Success', data.message, 'success');
                    // Reload comments
                    loadMoreComments(courseId, true);

                    // Clear the textarea
                    document.getElementById('comment').value = '';
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => console.error('Error:', error));
    });
});