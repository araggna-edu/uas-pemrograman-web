<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="bg-tileBackground rounded-2xl shadow-smooth flex flex-col p-6">
    <div class="header flex flex-row justify-between items-center">
        <h2 class="text-2xl font-semibold mb-4">Courses</h2>
        <a href="/course/add" class="bg-primary text-white py-2 px-4 rounded">Add New Course</a>
    </div>

    <div id="courses-table" class="mt-4"></div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        new gridjs.Grid({
            search: true,
            sort: true,
            pagination: {
                enabled: true,
                limit: 10,
            },
            columns: [
                {
                    name: 'Course Title',
                    formatter: (cell, row) => {
                        return gridjs.html(`
                    <a href="/course/${row.cells[3].data.courseid}" target="_blank">
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
                        if (row.cells[3].data.isapprove == 't' || row.cells[3].data.isapprove == 'f') {
                            approveBtn = ''
                        } else {
                            approveBtn = `<a href="#" onclick="approveAction(${cell.courseid})" class="button-primary">
                                            <i class="las la-check"></i>
                                            Approve
                                        </a>`;
                        }

                        return gridjs.html(`

                                <div class="flex flex-row gap-2">
                                    ${approveBtn}
                                    <a href="/course/edit/${cell.courseid}" class="button-secondary">
                                        <i class="las la-edit"></i>
                                        Edit
                                    </a>

                                    <a href="#" onclick="deleteAction(${cell.courseid})" class="button-tertiary">
                                        <i class="las la-trash"></i>
                                        Delete
                                    </a>
                                </div>

                            `);
                    }
                }
            ],
            server: {
                url: '/api/admin/course/all',
                then: data => data.map(course => [
                    course.coursetitle,
                    course.isapprove,
                    course.createddate,
                    course
                ])
            }
        }).render(document.getElementById('courses-table'));
    });

    function approveAction(courseId) {
        fetch('/api/admin/course/approve?courseid='+courseId, {
            method: 'GET'
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
    }

    function deleteAction(courseId) {
        fetch('/api/admin/course/delete?courseid='+courseId, {
            method: 'GET'
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
    }
</script>

<?= $this->endSection(); ?>

