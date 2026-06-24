<?php
$currentPage = 'borrowings';

$books = [
    ['id'=>1,'title'=>'The Great Gatsby','author'=>'F. Scott Fitzgerald'],
    ['id'=>2,'title'=>'A Brief History of Time','author'=>'Stephen Hawking'],
    ['id'=>3,'title'=>'Sapiens','author'=>'Yuval Noah Harari'],
    ['id'=>4,'title'=>'Clean Code','author'=>'Robert C. Martin'],
    ['id'=>5,'title'=>'1984','author'=>'George Orwell'],
    ['id'=>8,'title'=>'Design Patterns','author'=>'Gang of Four'],
    ['id'=>9,'title'=>'Meditations','author'=>'Marcus Aurelius'],
    ['id'=>10,'title'=>'The Alchemist','author'=>'Paulo Coelho'],
    ['id'=>11,'title'=>'Cosmos','author'=>'Carl Sagan'],
    ['id'=>6,'title'=>'The Selfish Gene','author'=>'Richard Dawkins'],
];

$members = [
    ['id'=>1,'name'=>'Alice Johnson'],
    ['id'=>2,'name'=>'Bob Williams'],
    ['id'=>3,'name'=>'Carol Davis'],
    ['id'=>4,'name'=>'David Brown'],
    ['id'=>5,'name'=>'Eva Martinez'],
    ['id'=>6,'name'=>'Frank Wilson'],
    ['id'=>8,'name'=>'Henry Taylor'],
];

$borrowings = [
    ['id'=>1,'book_id'=>1,'member_id'=>1,'borrow_date'=>'2025-05-01','due_date'=>'2025-05-15','return_date'=>null,'status'=>'Active'],
    ['id'=>2,'book_id'=>3,'member_id'=>2,'borrow_date'=>'2025-04-20','due_date'=>'2025-05-04','return_date'=>'2025-05-02','status'=>'Returned'],
    ['id'=>3,'book_id'=>5,'member_id'=>3,'borrow_date'=>'2025-05-10','due_date'=>'2025-05-24','return_date'=>null,'status'=>'Overdue'],
    ['id'=>4,'book_id'=>8,'member_id'=>1,'borrow_date'=>'2025-04-01','due_date'=>'2025-04-15','return_date'=>'2025-04-14','status'=>'Returned'],
    ['id'=>5,'book_id'=>4,'member_id'=>5,'borrow_date'=>'2025-05-12','due_date'=>'2025-05-26','return_date'=>null,'status'=>'Active'],
    ['id'=>6,'book_id'=>10,'member_id'=>6,'borrow_date'=>'2025-05-05','due_date'=>'2025-05-19','return_date'=>null,'status'=>'Active'],
    ['id'=>7,'book_id'=>2,'member_id'=>4,'borrow_date'=>'2025-03-15','due_date'=>'2025-03-29','return_date'=>null,'status'=>'Overdue'],
    ['id'=>8,'book_id'=>11,'member_id'=>8,'borrow_date'=>'2025-05-18','due_date'=>'2025-06-01','return_date'=>null,'status'=>'Active'],
    ['id'=>9,'book_id'=>9,'member_id'=>3,'borrow_date'=>'2025-05-20','due_date'=>'2025-06-03','return_date'=>null,'status'=>'Active'],
    ['id'=>10,'book_id'=>6,'member_id'=>2,'borrow_date'=>'2025-05-08','due_date'=>'2025-05-22','return_date'=>'2025-05-20','status'=>'Returned'],
];

function getBookTitle($id) {
    global $books;
    foreach($books as $b) { if($b['id']===$id) return $b['title']; }
    return 'Unknown';
}
function getBookAuthor($id) {
    global $books;
    foreach($books as $b) { if($b['id']===$id) return $b['author']; }
    return '';
}
function getMemberName($id) {
    global $members;
    foreach($members as $m) { if($m['id']===$id) return $m['name']; }
    return 'Unknown';
}

$activeCount = count(array_filter($borrowings, fn($b) => $b['status']==='Active'));
$returnedCount = count(array_filter($borrowings, fn($b) => $b['status']==='Returned'));
$overdueCount = count(array_filter($borrowings, fn($b) => $b['status']==='Overdue'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Borrowings</title>
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
            <li><a href="members.php"><i class="bi bi-people"></i> Members</a></li>
            <li><a href="borrowings.php" class="active"><i class="bi bi-arrow-left-right"></i> Borrowings</a></li>
            <li><a href="categories.php"><i class="bi bi-tags"></i> Categories</a></li>
        </ul>
    </nav>

    <main class="content">
        <div class="topbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">Borrowings</h4>
            <div>
                <button class="btn btn-primary btn-sm" onclick="openModal('newBorrowModal')">
                    <i class="bi bi-plus-lg"></i> New Borrowing
                </button>
            </div>
        </div>

        <div class="container-fluid py-3">
            <div class="row g-3 mb-3">
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body text-center py-3">
                            <h3 class="mb-0"><?php echo $activeCount; ?></h3>
                            <small>Active</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm bg-success text-white">
                        <div class="card-body text-center py-3">
                            <h3 class="mb-0"><?php echo $returnedCount; ?></h3>
                            <small>Returned</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm bg-danger text-white">
                        <div class="card-body text-center py-3">
                            <h3 class="mb-0"><?php echo $overdueCount; ?></h3>
                            <small>Overdue</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchBorrow" placeholder="Search by book or member..." oninput="filterBorrowings()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterStatus" onchange="filterBorrowings()">
                                <option value="">All Status</option>
                                <option value="Active">Active</option>
                                <option value="Returned">Returned</option>
                                <option value="Overdue">Overdue</option>
                            </select>
                        </div>
                        <div class="col-md-5 text-end">
                            <span class="text-muted small" id="borrowCount"><?php echo count($borrowings); ?> transactions</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="borrowTable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Book</th>
                                    <th>Member</th>
                                    <th>Borrow Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($borrowings as $b):
                                    $bookTitle = getBookTitle($b['book_id']);
                                    $bookAuthor = getBookAuthor($b['book_id']);
                                    $memberName = getMemberName($b['member_id']);
                                ?>
                                <tr data-id="<?php echo $b['id']; ?>"
                                    data-status="<?php echo $b['status']; ?>"
                                    data-book="<?php echo strtolower($bookTitle); ?>"
                                    data-member="<?php echo strtolower($memberName); ?>">
                                    <td><?php echo $b['id']; ?></td>
                                    <td>
                                        <strong><?php echo $bookTitle; ?></strong>
                                        <br><small class="text-muted"><?php echo $bookAuthor; ?></small>
                                    </td>
                                    <td><?php echo $memberName; ?></td>
                                    <td><?php echo $b['borrow_date']; ?></td>
                                    <td>
                                        <?php echo $b['due_date']; ?>
                                        <?php if($b['status'] === 'Overdue'): ?>
                                            <i class="bi bi-exclamation-circle text-danger ms-1"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $b['return_date'] ?? '<span class="text-muted">-</span>'; ?></td>
                                    <td>
                                        <?php
                                        $badge = match($b['status']) {
                                            'Active' => 'bg-primary',
                                            'Returned' => 'bg-success',
                                            'Overdue' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?php echo $badge; ?>"><?php echo $b['status']; ?></span>
                                    </td>
                                    <td>
                                        <?php if($b['status'] === 'Active' || $b['status'] === 'Overdue'): ?>
                                            <button class="btn btn-sm btn-outline-success" onclick="returnBook(<?php echo $b['id']; ?>)" title="Return Book">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewBorrowing(<?php echo $b['id']; ?>)" title="Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="editBorrowing(<?php echo $b['id']; ?>)" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteBorrowing(<?php echo $b['id']; ?>)" title="Delete">
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

    <!-- New Borrowing Modal -->
    <div class="modal fade" id="newBorrowModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-arrow-left-right me-2"></i>New Borrowing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="newBorrowForm" onsubmit="return newBorrowing(event)">
                        <div class="mb-3">
                            <label class="form-label">Select Book</label>
                            <select class="form-select" name="book_id" required>
                                <option value="">-- Choose a book --</option>
                                <?php foreach($books as $b): ?>
                                <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?> - <?php echo $b['author']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Member</label>
                            <select class="form-select" name="member_id" required>
                                <option value="">-- Choose a member --</option>
                                <?php foreach($members as $m): ?>
                                <option value="<?php echo $m['id']; ?>"><?php echo $m['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Borrow Date</label>
                                <input type="date" class="form-control" name="borrow_date" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" class="form-control" name="due_date" value="<?php echo date('Y-m-d', strtotime('+14 days')); ?>" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Borrowing</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Confirmation -->
    <div class="modal fade" id="returnModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-check-circle text-success me-2"></i>Return Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Confirm return for <strong id="returnBookTitle"></strong>?</p>
                    <p class="text-muted small">The book will be marked as returned and availability updated.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmReturnBtn">Confirm Return</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Detail -->
    <div class="modal fade" id="viewBorrowModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-info-circle me-2"></i>Borrowing Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewBorrowBody"></div>
            </div>
        </div>
    </div>

    <!-- Edit Borrowing Modal -->
    <div class="modal fade" id="editBorrowModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Borrowing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editBorrowForm" onsubmit="return saveBorrowing(event)">
                        <input type="hidden" name="id" id="editBorrowId">
                        <div class="mb-3">
                            <label class="form-label">Book</label>
                            <select class="form-select" name="book_id" id="editBorrowBook" required>
                                <?php foreach($books as $b): ?>
                                <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?> - <?php echo $b['author']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Member</label>
                            <select class="form-select" name="member_id" id="editBorrowMember" required>
                                <?php foreach($members as $m): ?>
                                <option value="<?php echo $m['id']; ?>"><?php echo $m['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Borrow Date</label>
                                <input type="date" class="form-control" name="borrow_date" id="editBorrowDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" class="form-control" name="due_date" id="editBorrowDue" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="editBorrowStatus" required>
                                <option value="Active">Active</option>
                                <option value="Returned">Returned</option>
                                <option value="Overdue">Overdue</option>
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

    <!-- Delete Borrowing Confirmation -->
    <div class="modal fade" id="deleteBorrowModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Delete this borrowing record?</p>
                    <p class="text-muted small" id="deleteBorrowInfo"></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBorrowBtn">Delete</button>
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
        const borrowData = <?php echo json_encode($borrowings); ?>;
        const booksLookup = <?php echo json_encode($books); ?>;
        const membersLookup = <?php echo json_encode($members); ?>;

        function filterBorrowings() {
            const search = document.getElementById('searchBorrow').value.toLowerCase();
            const status = document.getElementById('filterStatus').value;
            const rows = document.querySelectorAll('#borrowTable tbody tr');
            let count = 0;

            rows.forEach(row => {
                let show = true;
                if (search && !row.dataset.book.includes(search) && !row.dataset.member.includes(search)) show = false;
                if (status && row.dataset.status !== status) show = false;
                row.style.display = show ? '' : 'none';
                if (show) count++;
            });
            document.getElementById('borrowCount').textContent = count + ' transactions';
        }

        function returnBook(id) {
            const b = borrowData.find(x => x.id === id);
            const book = booksLookup.find(x => x.id === b.book_id);
            document.getElementById('returnBookTitle').textContent = book.title;
            document.getElementById('confirmReturnBtn').onclick = function() {
                const row = document.querySelector(`#borrowTable tr[data-id="${id}"]`);
                const statusBadge = row.querySelector('.badge');
                statusBadge.className = 'badge bg-success';
                statusBadge.textContent = 'Returned';
                const returnDateCell = row.querySelectorAll('td')[5];
                returnDateCell.innerHTML = new Date().toISOString().split('T')[0];
                const actionCell = row.querySelector('td:last-child');
                actionCell.innerHTML = '<button class="btn btn-sm btn-outline-info" onclick="viewBorrowing('+id+')" title="Details"><i class="bi bi-eye"></i></button>';
                bootstrap.Modal.getInstance(document.getElementById('returnModal')).hide();
                showToast('Book returned successfully!');
            };
            new bootstrap.Modal(document.getElementById('returnModal')).show();
        }

        function viewBorrowing(id) {
            const b = borrowData.find(x => x.id === id);
            const book = booksLookup.find(x => x.id === b.book_id);
            const member = membersLookup.find(x => x.id === b.member_id);
            const badge = b.status === 'Active' ? 'bg-primary' : b.status === 'Returned' ? 'bg-success' : 'bg-danger';
            document.getElementById('viewBorrowBody').innerHTML = `
                <div class="text-center mb-3">
                    <span class="badge ${badge} fs-6">${b.status}</span>
                </div>
                <div class="row g-3">
                    <div class="col-12"><strong>Book:</strong><br>${book.title} <small class="text-muted">by ${book.author}</small></div>
                    <div class="col-12"><strong>Member:</strong><br>${member.name}</div>
                    <div class="col-sm-4"><strong>Borrowed:</strong><br>${b.borrow_date}</div>
                    <div class="col-sm-4"><strong>Due:</strong><br>${b.due_date}</div>
                    <div class="col-sm-4"><strong>Returned:</strong><br>${b.return_date ?? 'Not yet'}</div>
                </div>`;
            new bootstrap.Modal(document.getElementById('viewBorrowModal')).show();
        }

        function newBorrowing(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const book = booksLookup.find(x => x.id === parseInt(data.book_id));
            const member = membersLookup.find(x => x.id === parseInt(data.member_id));
            const newId = Math.max(...borrowData.map(b => b.id)) + 1;
            const tbody = document.querySelector('#borrowTable tbody');
            const tr = document.createElement('tr');
            tr.dataset.id = newId;
            tr.dataset.status = 'Active';
            tr.dataset.book = book.title.toLowerCase();
            tr.dataset.member = member.name.toLowerCase();
            tr.innerHTML = `
                <td>${newId}</td>
                <td><strong>${book.title}</strong><br><small class="text-muted">${book.author}</small></td>
                <td>${member.name}</td>
                <td>${data.borrow_date}</td>
                <td>${data.due_date}</td>
                <td><span class="text-muted">-</span></td>
                <td><span class="badge bg-primary">Active</span></td>
                <td>
                    <button class="btn btn-sm btn-outline-success" onclick="returnBook(${newId})" title="Return Book"><i class="bi bi-check-lg"></i></button>
                    <button class="btn btn-sm btn-outline-info" onclick="viewBorrowing(${newId})" title="Details"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-warning" onclick="editBorrowing(${newId})" title="Edit"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteBorrowing(${newId})" title="Delete"><i class="bi bi-trash"></i></button>
                </td>`;
            tbody.appendChild(tr);
            borrowData.push({id:newId, book_id:parseInt(data.book_id), member_id:parseInt(data.member_id), borrow_date:data.borrow_date, due_date:data.due_date, return_date:null, status:'Active'});
            e.target.reset();
            bootstrap.Modal.getInstance(document.getElementById('newBorrowModal')).hide();
            showToast(`Borrowing: "${book.title}" by ${member.name} - Created!`);
            return false;
        }

        function editBorrowing(id) {
            const b = borrowData.find(x => x.id === id);
            document.getElementById('editBorrowId').value = b.id;
            document.getElementById('editBorrowBook').value = b.book_id;
            document.getElementById('editBorrowMember').value = b.member_id;
            document.getElementById('editBorrowDate').value = b.borrow_date;
            document.getElementById('editBorrowDue').value = b.due_date;
            document.getElementById('editBorrowStatus').value = b.status;
            new bootstrap.Modal(document.getElementById('editBorrowModal')).show();
        }

        function saveBorrowing(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const book = booksLookup.find(x => x.id === parseInt(data.book_id));
            const member = membersLookup.find(x => x.id === parseInt(data.member_id));
            const row = document.querySelector(`#borrowTable tr[data-id="${data.id}"]`);
            row.dataset.status = data.status;
            row.dataset.book = book.title.toLowerCase();
            row.dataset.member = member.name.toLowerCase();
            row.children[1].innerHTML = `<strong>${book.title}</strong><br><small class="text-muted">${book.author}</small>`;
            row.children[2].textContent = member.name;
            row.children[3].textContent = data.borrow_date;
            row.children[4].innerHTML = data.due_date + (data.status === 'Overdue' ? ' <i class="bi bi-exclamation-circle text-danger ms-1"></i>' : '');
            const badgeClass = data.status === 'Active' ? 'bg-primary' : data.status === 'Returned' ? 'bg-success' : 'bg-danger';
            row.children[6].innerHTML = `<span class="badge ${badgeClass}">${data.status}</span>`;
            const actionCell = row.children[7];
            let actions = '';
            if (data.status === 'Active' || data.status === 'Overdue') {
                actions += `<button class="btn btn-sm btn-outline-success" onclick="returnBook(${data.id})" title="Return Book"><i class="bi bi-check-lg"></i></button>`;
            }
            actions += `<button class="btn btn-sm btn-outline-info" onclick="viewBorrowing(${data.id})" title="Details"><i class="bi bi-eye"></i></button>`;
            actions += `<button class="btn btn-sm btn-outline-warning" onclick="editBorrowing(${data.id})" title="Edit"><i class="bi bi-pencil"></i></button>`;
            actions += `<button class="btn btn-sm btn-outline-danger" onclick="deleteBorrowing(${data.id})" title="Delete"><i class="bi bi-trash"></i></button>`;
            actionCell.innerHTML = actions;
            bootstrap.Modal.getInstance(document.getElementById('editBorrowModal')).hide();
            showToast('Borrowing #' + data.id + ' updated!');
            return false;
        }

        function deleteBorrowing(id) {
            const b = borrowData.find(x => x.id === id);
            const book = booksLookup.find(x => x.id === b.book_id);
            const member = membersLookup.find(x => x.id === b.member_id);
            document.getElementById('deleteBorrowInfo').textContent = book.title + ' borrowed by ' + member.name;
            document.getElementById('confirmDeleteBorrowBtn').onclick = function() {
                document.querySelector(`#borrowTable tr[data-id="${id}"]`).remove();
                bootstrap.Modal.getInstance(document.getElementById('deleteBorrowModal')).hide();
                showToast('Borrowing record deleted!');
            };
            new bootstrap.Modal(document.getElementById('deleteBorrowModal')).show();
        }

        function showToast(msg) {
            document.getElementById('toastBody').textContent = msg;
            new bootstrap.Toast(document.getElementById('toast')).show();
        }
    </script>
</body>
</html>
