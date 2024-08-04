document.addEventListener('DOMContentLoaded', function () {
    new gridjs.Grid({
        search: true,
        sort: true,
        pagination: {
            enabled: true,
            limit: 10,
        },
        columns: [
            'id',
            {
                name: 'Course Title',
                formatter: (cell, row) => {
                    return gridjs.html(`
                    <a href="/course/${row.cells[0].data}" target="_blank">
                        <span>${cell}</span>
                    </a>
                    `)
                }
            },
            {
                name: 'Status',
                formatter: (cell, row) => {
                    if (cell === 't') {
                        cell = 'Approved'
                        statusClass = 'badge-approved';
                    } else if (cell === 'f') {
                        cell = 'Rejected'
                        statusClass = 'badge-rejected';
                    } else {
                        cell = 'Waiting Approval'
                        statusClass = 'badge-pending';
                    }
                    return gridjs.html(`<span class="badge ${statusClass}">${cell}</span>`);
                }
            },
            'Created Date',
            {
                name: 'Action',
                formatter: (cell, row) => {
                    return gridjs.html(`
                                <a href="/course/edit/${row.cells[0].data}" class="button-secondary">
                                    <i class="las la-edit"></i>
                                    Edit
                                </a>
                            `);
                }
            }
        ],
        server: {
            url: '/api/course/my-course',
            then: data => data.map(course => [
                course.courseid,
                course.coursetitle,
                course.isapprove,
                course.createddate,
                null
            ])
        }
    }).render(document.getElementById('courses-table'));
});