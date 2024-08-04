let commentOffset = 0;
const commentLimit = 5;
let allDataLoaded = false;

function loadMoreComments(courseId, clear = false) {
    if (clear) {
        document.getElementById('comments-list').innerHTML = '';
        commentOffset = 0;
    }

    fetch(`/api/comment/all?courseId=${courseId}&offset=${commentOffset}&limit=${commentLimit}`)
        .then(response => response.json())
        .then(data => {

            if (data.length === 0) {
                allDataLoaded = true;
            } else {
                const commentList = document.getElementById('comments-list');
                data.forEach(comment => {
                    const commentDiv = document.createElement('div');
                    commentDiv.classList.add('comment', 'p-4', 'border', 'rounded', 'mt-2');
                    commentDiv.innerHTML = `<strong>${comment.userfullname}:</strong> ${comment.commentcontent}`;
                    commentList.appendChild(commentDiv);
                });
            }

            commentOffset += commentLimit;
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    const courseId = document.getElementById('course-id').value;
    loadMoreComments(courseId);

    window.addEventListener('scroll', () => {
        if ( ( (window.innerHeight + window.scrollY) >= document.body.offsetHeight)
            && !allDataLoaded ) {
            loadMoreComments(courseId);
        }
    });
});