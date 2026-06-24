<?php
$currentPage = 'members';

$members = [
    ['id'=>1,'name'=>'Alice Johnson','email'=>'alice@email.com','phone'=>'555-0101','status'=>'Active','joined'=>'2023-01-15','borrowed'=>2],
    ['id'=>2,'name'=>'Bob Williams','email'=>'bob@email.com','phone'=>'555-0102','status'=>'Active','joined'=>'2023-03-22','borrowed'=>1],
    ['id'=>3,'name'=>'Carol Davis','email'=>'carol@email.com','phone'=>'555-0103','status'=>'Active','joined'=>'2023-06-10','borrowed'=>2],
    ['id'=>4,'name'=>'David Brown','email'=>'david@email.com','phone'=>'555-0104','status'=>'Inactive','joined'=>'2022-11-05','borrowed'=>0],
    ['id'=>5,'name'=>'Eva Martinez','email'=>'eva@email.com','phone'=>'555-0105','status'=>'Active','joined'=>'2024-01-08','borrowed'=>1],
    ['id'=>6,'name'=>'Frank Wilson','email'=>'frank@email.com','phone'=>'555-0106','status'=>'Active','joined'=>'2024-02-14','borrowed'=>1],
    ['id'=>7,'name'=>'Grace Lee','email'=>'grace@email.com','phone'=>'555-0107','status'=>'Suspended','joined'=>'2023-09-30','borrowed'=>0],
    ['id'=>8,'name'=>'Henry Taylor','email'=>'henry@email.com','phone'=>'555-0108','status'=>'Active','joined'=>'2024-04-01','borrowed'=>1],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-book-half"></i>
            <span>LibManage</span>
        </div>
        <ul class="sidebar-nav">
            <li><a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li><a href="books.php"><i class="bi bi-book"></i> Books</a></li>
            <li><a href="members.php" class="active"><i class="bi bi-people"></i> Members</a></li>
            <li><a href="borrowings.php"><i class="bi bi-arrow-left-right"></i> Borrowings</a></li>
            <li><a href="categories.php"><i class="bi bi-tags"></i> Categories</a></li>
        </ul>
    </nav>

    <main class="content">
        <div class="topbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">Members</h4>
            <div>
                <button class="btn btn-primary btn-sm" onclick="openModal('addMemberModal')">
                    <i class="bi bi-plus-lg"></i> Add Member
                </button>
            </div>
        </div>

        <div class="container-fluid py-3">
            <div class="row g-3 mb-3">
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body text-center py-3">
                            <h3 class="mb-0"><?php echo count($members); ?></h3>
                            <small>Total Members</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm bg-success text-white">
                        <div class="card-body text-center py-3">
                            <h3 class="mb-0"><?php echo count(array_filter($members, fn($m) => $m['status']==='Active')); ?></h3>
                            <small>Active</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm bg-warning text-dark">
                        <div class="card-body text-center py-3">
                            <h3 class="mb-0"><?php echo count(array_filter($members, fn($m) => $m['status']!=='Active')); ?></h3>
                            <small>Inactive / Suspended</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchMembers" placeholder="Search by name, email, or phone..." oninput="filterMembers()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterStatus" onchange="filterMembers()">
                                <option value="">All Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="text-muted small" id="memberCount"><?php echo count($members); ?> members</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="membersTable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Joined</th>
                                    <th>Active Borrows</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($members as $m): ?>
                                <tr data-id="<?php echo $m['id']; ?>"
                                    data-name="<?php echo strtolower($m['name']); ?>"
                                    data-email="<?php echo strtolower($m['email']); ?>"
                                    data-phone="<?php echo $m['phone']; ?>"
                                    data-status="<?php echo $m['status']; ?>">
                                    <td><?php echo $m['id']; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white me-2">
                                                <?php echo strtoupper(substr($m['name'],0,1)); ?>
                                            </div>
                                            <strong><?php echo $m['name']; ?></strong>
                                        </div>
                                    </td>
                                    <td><a href="mailto:<?php echo $m['email']; ?>"><?php echo $m['email']; ?></a></td>
                                    <td><?php echo $m['phone']; ?></td>
                                    <td><?php echo $m['joined']; ?></td>
                                    <td>
                                        <?php if($m['borrowed'] > 0): ?>
                                            <span class="badge bg-info"><?php echo $m['borrowed']; ?> books</span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $badge = match($m['status']) {
                                            'Active' => 'bg-success',
                                            'Inactive' => 'bg-secondary',
                                            'Suspended' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?php echo $badge; ?>"><?php echo $m['status']; ?></span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(<?php echo $m['id']; ?>)" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="editMember(<?php echo $m['id']; ?>)" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteMember(<?php echo $m['id']; ?>)" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Add New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addMemberForm" onsubmit="return addMember(event)">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Member Modal -->
    <div class="modal fade" id="viewMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person me-2"></i>Member Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewMemberBody"></div>
            </div>
        </div>
    </div>

    <!-- Edit Member Modal -->
    <div class="modal fade" id="editMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editMemberForm" onsubmit="return saveMember(event)">
                        <input type="hidden" name="id" id="editMemId">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" id="editMemName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="editMemEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="editMemPhone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="editMemStatus" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation -->
    <div class="modal fade" id="deleteMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Remove member <strong id="deleteMemberName"></strong>?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteMemberBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999">
        <div id="toast" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="toastBody"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
    <script>
        const membersData = <?php echo json_encode($members); ?>;

        function filterMembers() {
            const search = document.getElementById('searchMembers').value.toLowerCase();
            const status = document.getElementById('filterStatus').value;
            const rows = document.querySelectorAll('#membersTable tbody tr');
            let count = 0;

            rows.forEach(row => {
                let show = true;
                if (search && !row.dataset.name.includes(search) && !row.dataset.email.includes(search) && !row.dataset.phone.includes(search)) show = false;
                if (status && row.dataset.status !== status) show = false;
                row.style.display = show ? '' : 'none';
                if (show) count++;
            });
            document.getElementById('memberCount').textContent = count + ' members';
        }

        function viewMember(id) {
            const m = membersData.find(x => x.id === id);
            document.getElementById('viewMemberBody').innerHTML = `
                <div class="text-center mb-3">
                    <div class="avatar-circle-lg bg-primary text-white mx-auto">${m.name.charAt(0).toUpperCase()}</div>
                    <h5 class="mt-2 mb-0">${m.name}</h5>
                    <span class="badge bg-success">${m.status}</span>
                </div>
                <div class="row g-3">
                    <div class="col-12"><strong>Email:</strong><br><a href="mailto:${m.email}">${m.email}</a></div>
                    <div class="col-sm-6"><strong>Phone:</strong><br>${m.phone}</div>
                    <div class="col-sm-6"><strong>Joined:</strong><br>${m.joined}</div>
                    <div class="col-12"><strong>Active Borrows:</strong><br>${m.borrowed} book(s)</div>
                </div>`;
            new bootstrap.Modal(document.getElementById('viewMemberModal')).show();
        }

        function editMember(id) {
            const m = membersData.find(x => x.id === id);
            document.getElementById('editMemId').value = m.id;
            document.getElementById('editMemName').value = m.name;
            document.getElementById('editMemEmail').value = m.email;
            document.getElementById('editMemPhone').value = m.phone;
            document.getElementById('editMemStatus').value = m.status;
            new bootstrap.Modal(document.getElementById('editMemberModal')).show();
        }

        function saveMember(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const row = document.querySelector(`#membersTable tr[data-id="${data.id}"]`);
            row.dataset.name = data.name.toLowerCase();
            row.dataset.email = data.email.toLowerCase();
            row.dataset.phone = data.phone;
            row.dataset.status = data.status;
            const initial = data.name.charAt(0).toUpperCase();
            row.children[1].innerHTML = `<div class="d-flex align-items-center"><div class="avatar-circle bg-primary text-white me-2">${initial}</div><strong>${data.name}</strong></div>`;
            row.children[2].innerHTML = `<a href="mailto:${data.email}">${data.email}</a>`;
            row.children[3].textContent = data.phone;
            const badgeClass = data.status === 'Active' ? 'bg-success' : data.status === 'Inactive' ? 'bg-secondary' : 'bg-danger';
            row.children[6].innerHTML = `<span class="badge ${badgeClass}">${data.status}</span>`;
            bootstrap.Modal.getInstance(document.getElementById('editMemberModal')).hide();
            showToast('Member "' + data.name + '" updated!');
            return false;
        }

        function deleteMember(id) {
            const m = membersData.find(x => x.id === id);
            document.getElementById('deleteMemberName').textContent = m.name;
            document.getElementById('confirmDeleteMemberBtn').onclick = function() {
                document.querySelector(`#membersTable tr[data-id="${id}"]`).remove();
                const idx = membersData.findIndex(x => x.id === id);
                if (idx > -1) membersData.splice(idx, 1);
                bootstrap.Modal.getInstance(document.getElementById('deleteMemberModal')).hide();
                showToast('Member "' + m.name + '" removed');
                filterMembers();
            };
            new bootstrap.Modal(document.getElementById('deleteMemberModal')).show();
        }

        function addMember(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const newId = Math.max(...membersData.map(m => m.id)) + 1;
            const today = new Date().toISOString().split('T')[0];
            const tbody = document.querySelector('#membersTable tbody');
            const tr = document.createElement('tr');
            tr.dataset.id = newId;
            tr.dataset.name = data.name.toLowerCase();
            tr.dataset.email = data.email.toLowerCase();
            tr.dataset.phone = data.phone;
            tr.dataset.status = data.status;
            const initial = data.name.charAt(0).toUpperCase();
            tr.innerHTML = `
                <td>${newId}</td>
                <td><div class="d-flex align-items-center"><div class="avatar-circle bg-primary text-white me-2">${initial}</div><strong>${data.name}</strong></div></td>
                <td><a href="mailto:${data.email}">${data.email}</a></td>
                <td>${data.phone}</td>
                <td>${today}</td>
                <td><span class="text-muted">-</span></td>
                <td><span class="badge bg-success">${data.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="viewMember(${newId})" title="View"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-warning" onclick="editMember(${newId})" title="Edit"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteMember(${newId})" title="Delete"><i class="bi bi-trash"></i></button>
                </td>`;
            tbody.appendChild(tr);
            membersData.push({id:newId, name:data.name, email:data.email, phone:data.phone, status:data.status, joined:today, borrowed:0});
            e.target.reset();
            bootstrap.Modal.getInstance(document.getElementById('addMemberModal')).hide();
            showToast('Member "' + data.name + '" added!');
            filterMembers();
            return false;
        }

        function showToast(msg) {
            document.getElementById('toastBody').textContent = msg;
            new bootstrap.Toast(document.getElementById('toast')).show();
        }
    </script>
</body>
</html>
