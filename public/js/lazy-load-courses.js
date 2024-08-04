let offset = 0;
const limit = 5;
let allDataLoaded = false;

function loadMoreData(offset, limit) {
    const loader = document.getElementById('loader');
    loader.style.display = 'block';

    fetch(`/api/course/all?offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
            const content = document.getElementById('content');
            const cardTemplate = document.querySelector('.card-template');

            if (data.length === 0) {
                allDataLoaded = true;
            } else {
                data.forEach(item => {
                    const cardClone = cardTemplate.cloneNode(true);
                    cardClone.classList.remove('hidden', 'card-template');

                    cardClone.querySelector('.card-link').innerText = item.coursetitle;
                    cardClone.querySelector('.card-subtitle').innerText = `Created on: ${item.createddate} by ${item.userfullname}`;
                    cardClone.querySelector('.card-content').innerHTML = item.coursecontent;
                    cardClone.querySelector('.card-link').setAttribute('href', 'course/'+item.courseid)

                    const attachmentsTemplate = document.querySelector('.attachment-list');
                    if (item.attachments && item.attachments.length > 0) {

                        item.attachments.forEach(attachment => {
                            const attachmentClone = attachmentsTemplate.cloneNode(true);
                            attachmentClone.classList.remove('hidden', 'attachment-list');

                            attachmentClone.querySelector(".attachment-link").innerText = attachment.assetfile;
                            attachmentClone.querySelector(".attachment-link").setAttribute('href', attachment.assetpath);

                            cardClone.appendChild(attachmentClone)
                        });


                    }

                    content.appendChild(cardClone);
                });
            }

            loader.style.display = 'none';
        })
        .catch(error => {
            console.error('Error:', error);
            loader.style.display = 'none';
        });
}

document.addEventListener('DOMContentLoaded', () => {
    loadMoreData(offset, limit);

    const scrollableContainer = document.querySelector('.flex-1.overflow-y-auto'); // Adjust to your layout

    scrollableContainer.addEventListener('scroll', () => {
        if ((scrollableContainer.scrollTop + scrollableContainer.clientHeight) >= scrollableContainer.scrollHeight) {
            if (!allDataLoaded) {
                offset += limit;
                loadMoreData(offset, limit);
            }
        }
    });

});