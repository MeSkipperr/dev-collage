<?php
$currentPage = 'books';

$categories = [
    ['id' => 1, 'name' => 'Fiction'],
    ['id' => 2, 'name' => 'Science'],
    ['id' => 3, 'name' => 'History'],
    ['id' => 4, 'name' => 'Technology'],
    ['id' => 5, 'name' => 'Philosophy'],
];

$books = [
    ['id'=>1,'title'=>'The Great Gatsby','author'=>'F. Scott Fitzgerald','isbn'=>'978-0743273565','category_id'=>1,'quantity'=>5,'available'=>3,'year'=>1925],
    ['id'=>2,'title'=>'A Brief History of Time','author'=>'Stephen Hawking','isbn'=>'978-0553380163','category_id'=>2,'quantity'=>3,'available'=>2,'year'=>1988],
    ['id'=>3,'title'=>'Sapiens','author'=>'Yuval Noah Harari','isbn'=>'978-0062316097','category_id'=>3,'quantity'=>4,'available'=>1,'year'=>2015],
    ['id'=>4,'title'=>'Clean Code','author'=>'Robert C. Martin','isbn'=>'978-0132350884','category_id'=>4,'quantity'=>6,'available'=>4,'year'=>2008],
    ['id'=>5,'title'=>'1984','author'=>'George Orwell','isbn'=>'978-0451524935','category_id'=>1,'quantity'=>7,'available'=>5,'year'=>1949],
    ['id'=>6,'title'=>'The Selfish Gene','author'=>'Richard Dawkins','isbn'=>'978-0198788607','category_id'=>2,'quantity'=>3,'available'=>3,'year'=>1976],
    ['id'=>7,'title'=>'Guns, Germs, and Steel','author'=>'Jared Diamond','isbn'=>'978-0393354324','category_id'=>3,'quantity'=>4,'available'=>2,'year'=>1997],
    ['id'=>8,'title'=>'Design Patterns','author'=>'Gang of Four','isbn'=>'978-0201633610','category_id'=>4,'quantity'=>5,'available'=>1,'year'=>1994],
    ['id'=>9,'title'=>'Meditations','author'=>'Marcus Aurelius','isbn'=>'978-0140449334','category_id'=>5,'quantity'=>3,'available'=>2,'year'=>180],
    ['id'=>10,'title'=>'The Alchemist','author'=>'Paulo Coelho','isbn'=>'978-0062315007','category_id'=>1,'quantity'=>6,'available'=>4,'year'=>1988],
    ['id'=>11,'title'=>'Cosmos','author'=>'Carl Sagan','isbn'=>'978-0345539434','category_id'=>2,'quantity'=>4,'available'=>3,'year'=>1980],
    ['id'=>12,'title'=>'The Art of War','author'=>'Sun Tzu','isbn'=>'978-1599869773','category_id'=>5,'quantity'=>3,'available'=>2,'year'=>-500],
];

function getCategoryName($id) {
    global $categories;
    foreach($categories as $c) { if($c['id']===$id) return $c['name']; }
    return 'Unknown';
}

function getCategoryBadge($id) {
    $map = [1=>'bg-purple',2=>'bg-info',3=>'bg-warning text-dark',4=>'bg-success',5=>'bg-secondary'];
    return $map[$id] ?? 'bg-secondary';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Books</title>
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
            <li><a href="books.php" class="active"><i class="bi bi-book"></i> Books</a></li>
            <li><a href="members.php"><i class="bi bi-people"></i> Members</a></li>
            <li><a href="borrowings.php"><i class="bi bi-arrow-left-right"></i> Borrowings</a></li>
            <li><a href="categories.php"><i class="bi bi-tags"></i> Categories</a></li>
        </ul>
    </nav>

    <main class="content">
        <div class="topbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">Books</h4>
            <div>
                <button class="btn btn-primary btn-sm" onclick="openModal('addBookModal')">
                    <i class="bi bi-plus-lg"></i> Add Book
                </button>
            </div>
        </div>

        <div class="container-fluid py-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchBooks" placeholder="Search by title, author, or ISBN..." oninput="filterBooks()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterCategory" onchange="filterBooks()">
                                <option value="">All Categories</option>
                                <?php foreach($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterAvailability" onchange="filterBooks()">
                                <option value="">All Availability</option>
                                <option value="available">Available (qty > 0)</option>
                                <option value="unavailable">Unavailable (qty = 0)</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="sortBy" onchange="filterBooks()">
                                <option value="title">Sort by Title</option>
                                <option value="author">Sort by Author</option>
                                <option value="year">Sort by Year</option>
                                <option value="available">Sort by Availability</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-muted small mb-2" id="bookCount"><?php echo count($books); ?> books found</div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="booksTable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>ISBN</th>
                                    <th>Category</th>
                                    <th>Year</th>
                                    <th>Qty</th>
                                    <th>Available</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($books as $book): ?>
                                <tr data-id="<?php echo $book['id']; ?>"
                                    data-category="<?php echo $book['category_id']; ?>"
                                    data-title="<?php echo strtolower($book['title']); ?>"
                                    data-author="<?php echo strtolower($book['author']); ?>"
                                    data-isbn="<?php echo $book['isbn']; ?>"
                                    data-year="<?php echo $book['year']; ?>"
                                    data-available="<?php echo $book['available']; ?>"
                                    data-qty="<?php echo $book['quantity']; ?>">
                                    <td><?php echo $book['id']; ?></td>
                                    <td><strong><?php echo $book['title']; ?></strong></td>
                                    <td><?php echo $book['author']; ?></td>
                                    <td><code class="small"><?php echo $book['isbn']; ?></code></td>
                                    <td><span class="badge <?php echo getCategoryBadge($book['category_id']); ?>"><?php echo getCategoryName($book['category_id']); ?></span></td>
                                    <td><?php echo $book['year']; ?></td>
                                    <td><?php echo $book['quantity']; ?></td>
                                    <td>
                                        <?php if($book['available'] > 0): ?>
                                            <span class="badge bg-success"><?php echo $book['available']; ?> / <?php echo $book['quantity']; ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">0 / <?php echo $book['quantity']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewBook(<?php echo $book['id']; ?>)" title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="editBook(<?php echo $book['id']; ?>)" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteBook(<?php echo $book['id']; ?>)" title="Delete">
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

    <!-- Add Book Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addBookForm" onsubmit="return addBook(event)">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control" name="author" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category_id" required>
                                    <?php foreach($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Year</label>
                                <input type="number" class="form-control" name="year" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Available</label>
                                <input type="number" class="form-control" name="available" min="0" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Book Modal -->
    <div class="modal fade" id="viewBookModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-book me-2"></i>Book Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewBookBody"></div>
            </div>
        </div>
    </div>

    <!-- Edit Book Modal -->
    <div class="modal fade" id="editBookModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editBookForm" onsubmit="return saveBook(event)">
                        <input type="hidden" name="id" id="editBookId">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="editBookTitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control" name="author" id="editBookAuthor" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="editBookIsbn" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category_id" id="editBookCategory" required>
                                    <?php foreach($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Year</label>
                                <input type="number" class="form-control" name="year" id="editBookYear" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="editBookQty" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Available</label>
                                <input type="number" class="form-control" name="available" id="editBookAvail" min="0" required>
                            </div>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteBookModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteBookTitle"></strong>?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
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
        const booksData = <?php echo json_encode($books); ?>;
        const categoriesData = <?php echo json_encode($categories); ?>;

        function filterBooks() {
            const search = document.getElementById('searchBooks').value.toLowerCase();
            const cat = document.getElementById('filterCategory').value;
            const avail = document.getElementById('filterAvailability').value;
            const sort = document.getElementById('sortBy').value;
            const rows = document.querySelectorAll('#booksTable tbody tr');
            let count = 0;

            rows.forEach(row => {
                let show = true;
                if (search && !row.dataset.title.includes(search) && !row.dataset.author.includes(search) && !row.dataset.isbn.includes(search)) show = false;
                if (cat && row.dataset.category !== cat) show = false;
                if (avail === 'available' && parseInt(row.dataset.available) === 0) show = false;
                if (avail === 'unavailable' && parseInt(row.dataset.available) > 0) show = false;
                row.style.display = show ? '' : 'none';
                if (show) count++;
            });
            document.getElementById('bookCount').textContent = count + ' books found';
        }

        function viewBook(id) {
            const book = booksData.find(b => b.id === id);
            const cat = categoriesData.find(c => c.id === book.category_id);
            document.getElementById('viewBookBody').innerHTML = `
                <div class="row g-3">
                    <div class="col-12"><h5>${book.title}</h5><p class="text-muted mb-0">by ${book.author}</p></div>
                    <div class="col-sm-6"><strong>ISBN:</strong><br><code>${book.isbn}</code></div>
                    <div class="col-sm-6"><strong>Category:</strong><br><span class="badge bg-primary">${cat.name}</span></div>
                    <div class="col-sm-6"><strong>Year:</strong><br>${book.year}</div>
                    <div class="col-sm-6"><strong>Quantity:</strong><br>${book.quantity}</div>
                    <div class="col-sm-6"><strong>Available:</strong><br><span class="${book.available > 0 ? 'text-success' : 'text-danger'} fw-bold">${book.available}</span></div>
                    <div class="col-sm-6"><strong>Borrowed:</strong><br>${book.quantity - book.available}</div>
                </div>`;
            new bootstrap.Modal(document.getElementById('viewBookModal')).show();
        }

        function editBook(id) {
            const book = booksData.find(b => b.id === id);
            document.getElementById('editBookId').value = book.id;
            document.getElementById('editBookTitle').value = book.title;
            document.getElementById('editBookAuthor').value = book.author;
            document.getElementById('editBookIsbn').value = book.isbn;
            document.getElementById('editBookCategory').value = book.category_id;
            document.getElementById('editBookYear').value = book.year;
            document.getElementById('editBookQty').value = book.quantity;
            document.getElementById('editBookAvail').value = book.available;
            new bootstrap.Modal(document.getElementById('editBookModal')).show();
        }

        function saveBook(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const cat = categoriesData.find(c => c.id === parseInt(data.category_id));
            const row = document.querySelector(`#booksTable tr[data-id="${data.id}"]`);
            row.dataset.category = data.category_id;
            row.dataset.title = data.title.toLowerCase();
            row.dataset.author = data.author.toLowerCase();
            row.dataset.isbn = data.isbn;
            row.dataset.year = data.year;
            row.dataset.available = data.available;
            row.dataset.qty = data.quantity;
            row.children[1].innerHTML = `<strong>${data.title}</strong>`;
            row.children[2].textContent = data.author;
            row.children[3].innerHTML = `<code class="small">${data.isbn}</code>`;
            row.children[4].innerHTML = `<span class="badge ${getCategoryBadgeJS(parseInt(data.category_id))}">${cat.name}</span>`;
            row.children[5].textContent = data.year;
            row.children[6].textContent = data.quantity;
            row.children[7].innerHTML = parseInt(data.available) > 0
                ? `<span class="badge bg-success">${data.available} / ${data.quantity}</span>`
                : `<span class="badge bg-danger">0 / ${data.quantity}</span>`;
            bootstrap.Modal.getInstance(document.getElementById('editBookModal')).hide();
            showToast('Book "' + data.title + '" updated successfully!');
            return false;
        }

        function getCategoryBadgeJS(id) {
            const map = {1:'bg-purple',2:'bg-info',3:'bg-warning text-dark',4:'bg-success',5:'bg-secondary'};
            return map[id] || 'bg-secondary';
        }

        function deleteBook(id) {
            const book = booksData.find(b => b.id === id);
            document.getElementById('deleteBookTitle').textContent = book.title;
            document.getElementById('confirmDeleteBtn').onclick = function() {
                document.querySelector(`tr[data-id="${id}"]`).remove();
                const idx = booksData.findIndex(b => b.id === id);
                if (idx > -1) booksData.splice(idx, 1);
                bootstrap.Modal.getInstance(document.getElementById('deleteBookModal')).hide();
                showToast('Book "' + book.title + '" deleted successfully');
                filterBooks();
            };
            new bootstrap.Modal(document.getElementById('deleteBookModal')).show();
        }

        function addBook(e) {
            e.preventDefault();
            const form = e.target;
            const data = Object.fromEntries(new FormData(form));
            const cat = categoriesData.find(c => c.id === parseInt(data.category_id));
            const newId = Math.max(...booksData.map(b => b.id)) + 1;
            const tbody = document.querySelector('#booksTable tbody');
            const tr = document.createElement('tr');
            tr.dataset.id = newId;
            tr.dataset.category = data.category_id;
            tr.dataset.title = data.title.toLowerCase();
            tr.dataset.author = data.author.toLowerCase();
            tr.dataset.isbn = data.isbn;
            tr.dataset.year = data.year;
            tr.dataset.available = data.available;
            tr.dataset.qty = data.quantity;
            tr.innerHTML = `
                <td>${newId}</td>
                <td><strong>${data.title}</strong></td>
                <td>${data.author}</td>
                <td><code class="small">${data.isbn}</code></td>
                <td><span class="badge ${getCategoryBadgeJS(parseInt(data.category_id))}">${cat.name}</span></td>
                <td>${data.year}</td>
                <td>${data.quantity}</td>
                <td>${parseInt(data.available) > 0 ? `<span class="badge bg-success">${data.available} / ${data.quantity}</span>` : `<span class="badge bg-danger">0 / ${data.quantity}</span>`}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="viewBook(${newId})" title="View"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-warning" onclick="editBook(${newId})" title="Edit"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteBook(${newId})" title="Delete"><i class="bi bi-trash"></i></button>
                </td>`;
            tbody.appendChild(tr);
            booksData.push({id:newId, title:data.title, author:data.author, isbn:data.isbn, category_id:parseInt(data.category_id), quantity:parseInt(data.quantity), available:parseInt(data.available), year:parseInt(data.year)});
            form.reset();
            bootstrap.Modal.getInstance(document.getElementById('addBookModal')).hide();
            showToast('Book "' + data.title + '" added successfully!');
            filterBooks();
            return false;
        }

        function showToast(msg) {
            document.getElementById('toastBody').textContent = msg;
            new bootstrap.Toast(document.getElementById('toast')).show();
        }
    </script>
</body>
</html>
