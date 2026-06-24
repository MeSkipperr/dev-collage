<?php
$currentPage = 'categories';

$categories = [
    ['id'=>1,'name'=>'Fiction','description'=>'Novels, short stories, and literary fiction','book_count'=>3,'color'=>'#7c3aed'],
    ['id'=>2,'name'=>'Science','description'=>'Physics, biology, chemistry, and astronomy','book_count'=>3,'color'=>'#0891b2'],
    ['id'=>3,'name'=>'History','description'=>'World history, ancient civilizations, and biographies','book_count'=>2,'color'=>'#d97706'],
    ['id'=>4,'name'=>'Technology','description'=>'Computer science, programming, and engineering','book_count'=>2,'color'=>'#059669'],
    ['id'=>5,'name'=>'Philosophy','description'=>'Ethics, logic, and existential thought','book_count'=>2,'color'=>'#64748b'],
];

$totalBooks = array_sum(array_column($categories, 'book_count'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        .category-card {
            border-radius: 12px;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }
        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
        }
        .category-color-bar {
            height: 4px;
            width: 100%;
        }
        .category-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
        }
        .category-icon i {
            filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));
        }
    </style>
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
            <li><a href="borrowings.php"><i class="bi bi-arrow-left-right"></i> Borrowings</a></li>
            <li><a href="categories.php" class="active"><i class="bi bi-tags"></i> Categories</a></li>
        </ul>
    </nav>

    <main class="content">
        <div class="topbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">Categories</h4>
            <div>
                <button class="btn btn-primary btn-sm" onclick="openModal('addCategoryModal')">
                    <i class="bi bi-plus-lg"></i> Add Category
                </button>
            </div>
        </div>

        <div class="container-fluid py-3">
            <!-- Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-primary"><?php echo count($categories); ?></h3>
                            <small class="text-muted">Total Categories</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-success"><?php echo $totalBooks; ?></h3>
                            <small class="text-muted">Total Books Across All</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-info"><?php echo round($totalBooks / count($categories)); ?></h3>
                            <small class="text-muted">Avg Books per Category</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <?php
                    $maxCat = $categories[0];
                    foreach($categories as $c) { if($c['book_count'] > $maxCat['book_count']) $maxCat = $c; }
                    ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-warning"><?php echo $maxCat['book_count']; ?></h3>
                            <small class="text-muted">Most Popular (<?php echo $maxCat['name']; ?>)</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchCategory" placeholder="Search categories..." oninput="filterCategories()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sortBy" onchange="filterCategories()">
                                <option value="name">Sort by Name</option>
                                <option value="books">Sort by Book Count</option>
                                <option value="id">Sort by ID</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="text-muted small" id="catCount"><?php echo count($categories); ?> categories</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Cards Grid -->
            <div class="row g-3" id="categoryGrid">
                <?php foreach($categories as $cat):
                    $bookPercent = $totalBooks > 0 ? round($cat['book_count'] / $totalBooks * 100) : 0;
                ?>
                <div class="col-sm-6 col-lg-4 category-item"
                     data-id="<?php echo $cat['id']; ?>"
                     data-name="<?php echo strtolower($cat['name']); ?>"
                     data-books="<?php echo $cat['book_count']; ?>">
                    <div class="card category-card shadow-sm h-100">
                        <div class="category-color-bar" style="background:<?php echo $cat['color']; ?>"></div>
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="category-icon" style="background:<?php echo $cat['color']; ?>">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="viewCategory(<?php echo $cat['id']; ?>)"><i class="bi bi-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="editCategory(<?php echo $cat['id']; ?>)"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteCategory(<?php echo $cat['id']; ?>)"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            <h5 class="mb-1"><?php echo $cat['name']; ?></h5>
                            <p class="text-muted small mb-3"><?php echo $cat['description']; ?></p>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small text-muted"><?php echo $cat['book_count']; ?> books</span>
                                <span class="small text-muted"><?php echo $bookPercent; ?>%</span>
                            </div>
                            <div class="progress" style="height:6px">
                                <div class="progress-bar" style="width:<?php echo $bookPercent; ?>%;background:<?php echo $cat['color']; ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Table View -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="bi bi-table me-2"></i>Table View</h6>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary active" onclick="showView('cards')" id="btnCards"><i class="bi bi-grid-3x3-gap"></i></button>
                        <button class="btn btn-outline-secondary" onclick="showView('table')" id="btnTable"><i class="bi bi-list"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="categoryTable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Color</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Books</th>
                                    <th>Share</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $cat):
                                    $bookPercent = $totalBooks > 0 ? round($cat['book_count'] / $totalBooks * 100) : 0;
                                ?>
                                <tr data-id="<?php echo $cat['id']; ?>"
                                    data-name="<?php echo strtolower($cat['name']); ?>"
                                    data-books="<?php echo $cat['book_count']; ?>">
                                    <td><?php echo $cat['id']; ?></td>
                                    <td><span class="d-inline-block rounded-circle" style="width:20px;height:20px;background:<?php echo $cat['color']; ?>"></span></td>
                                    <td><strong><?php echo $cat['name']; ?></strong></td>
                                    <td><small class="text-muted"><?php echo $cat['description']; ?></small></td>
                                    <td><span class="badge bg-dark"><?php echo $cat['book_count']; ?></span></td>
                                    <td>
                                        <div class="progress" style="height:6px;width:80px">
                                            <div class="progress-bar" style="width:<?php echo $bookPercent; ?>%;background:<?php echo $cat['color']; ?>"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCategory(<?php echo $cat['id']; ?>)"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="editCategory(<?php echo $cat['id']; ?>)"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(<?php echo $cat['id']; ?>)"><i class="bi bi-trash"></i></button>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" onsubmit="return addCategory(event)">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <input type="color" class="form-control form-control-color" name="color" value="#3b82f6">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" onsubmit="return saveCategory(event)">
                        <input type="hidden" name="id" id="editCatId">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="editCatName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="editCatDesc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <input type="color" class="form-control form-control-color" name="color" id="editCatColor">
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

    <!-- View Category Modal -->
    <div class="modal fade" id="viewCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-tags me-2"></i>Category Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewCategoryBody"></div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Delete category <strong id="deleteCatName"></strong>?</p>
                    <p class="text-muted small">Books in this category will not be deleted, but they will become uncategorized.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCatBtn">Delete</button>
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
        const categoriesData = <?php echo json_encode($categories); ?>;

        function filterCategories() {
            const search = document.getElementById('searchCategory').value.toLowerCase();
            const sort = document.getElementById('sortBy').value;

            const gridItems = document.querySelectorAll('.category-item');
            const tableRows = document.querySelectorAll('#categoryTable tbody tr');
            let count = 0;

            const visible = [];
            gridItems.forEach(item => {
                let show = true;
                if (search && !item.dataset.name.includes(search)) show = false;
                item.style.display = show ? '' : 'none';
                if (show) { count++; visible.push({el: item, name: item.dataset.name, books: parseInt(item.dataset.books), id: parseInt(item.dataset.id)}); }
            });

            tableRows.forEach(row => {
                let show = true;
                if (search && !row.dataset.name.includes(search)) show = false;
                row.style.display = show ? '' : 'none';
            });

            document.getElementById('catCount').textContent = count + ' categories';
        }

        function showView(view) {
            const grid = document.getElementById('categoryGrid');
            const table = grid.nextElementSibling;
            if (view === 'cards') {
                grid.style.display = '';
                table.style.display = 'none';
                document.getElementById('btnCards').classList.add('active');
                document.getElementById('btnTable').classList.remove('active');
            } else {
                grid.style.display = 'none';
                table.style.display = '';
                document.getElementById('btnTable').classList.add('active');
                document.getElementById('btnCards').classList.remove('active');
            }
        }

        function viewCategory(id) {
            const cat = categoriesData.find(c => c.id === id);
            const total = <?php echo $totalBooks; ?>;
            const pct = Math.round(cat.book_count / total * 100);
            document.getElementById('viewCategoryBody').innerHTML = `
                <div class="text-center mb-3">
                    <div class="category-icon mx-auto mb-2" style="background:${cat.color};width:72px;height:72px;font-size:1.8rem;">
                        <i class="bi bi-book"></i>
                    </div>
                    <h4 class="mb-0">${cat.name}</h4>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12"><strong>Description:</strong><br>${cat.description}</div>
                    <div class="col-sm-6"><strong>Books:</strong><br><span class="badge bg-dark">${cat.book_count}</span></div>
                    <div class="col-sm-6"><strong>Share:</strong><br>${pct}% of library</div>
                    <div class="col-12">
                        <div class="progress" style="height:10px">
                            <div class="progress-bar" style="width:${pct}%;background:${cat.color}"></div>
                        </div>
                    </div>
                </div>`;
            new bootstrap.Modal(document.getElementById('viewCategoryModal')).show();
        }

        function editCategory(id) {
            const cat = categoriesData.find(c => c.id === id);
            document.getElementById('editCatId').value = cat.id;
            document.getElementById('editCatName').value = cat.name;
            document.getElementById('editCatDesc').value = cat.description;
            document.getElementById('editCatColor').value = cat.color;
            new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
        }

        function saveCategory(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const cat = categoriesData.find(c => c.id === parseInt(data.id));
            cat.name = data.name;
            cat.description = data.description;
            cat.color = data.color;
            const gridItem = document.querySelector(`.category-item[data-id="${data.id}"]`);
            if (gridItem) {
                gridItem.dataset.name = data.name.toLowerCase();
                const card = gridItem.querySelector('.card');
                card.querySelector('.category-color-bar').style.background = data.color;
                card.querySelector('.category-icon').style.background = data.color;
                card.querySelector('h5').textContent = data.name;
                card.querySelector('p').textContent = data.description;
            }
            const tableRow = document.querySelector(`#categoryTable tr[data-id="${data.id}"]`);
            if (tableRow) {
                tableRow.dataset.name = data.name.toLowerCase();
                tableRow.children[2].innerHTML = `<strong>${data.name}</strong>`;
                tableRow.children[3].innerHTML = `<small class="text-muted">${data.description}</small>`;
                tableRow.children[1].innerHTML = `<span class="d-inline-block rounded-circle" style="width:20px;height:20px;background:${data.color}"></span>`;
                tableRow.querySelectorAll('.progress-bar').forEach(bar => bar.style.background = data.color);
            }
            bootstrap.Modal.getInstance(document.getElementById('editCategoryModal')).hide();
            showToast('Category updated!');
            return false;
        }

        function deleteCategory(id) {
            const cat = categoriesData.find(c => c.id === id);
            document.getElementById('deleteCatName').textContent = cat.name;
            document.getElementById('confirmDeleteCatBtn').onclick = function() {
                document.querySelector(`.category-item[data-id="${id}"]`).remove();
                document.querySelector(`#categoryTable tr[data-id="${id}"]`).remove();
                bootstrap.Modal.getInstance(document.getElementById('deleteCategoryModal')).hide();
                showToast('Category "' + cat.name + '" deleted');
            };
            new bootstrap.Modal(document.getElementById('deleteCategoryModal')).show();
        }

        function addCategory(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const newId = Math.max(...categoriesData.map(c => c.id)) + 1;
            categoriesData.push({id:newId, name:data.name, description:data.description, book_count:0, color:data.color});
            const grid = document.getElementById('categoryGrid');
            const col = document.createElement('div');
            col.className = 'col-sm-6 col-lg-4 category-item';
            col.dataset.id = newId;
            col.dataset.name = data.name.toLowerCase();
            col.dataset.books = 0;
            col.innerHTML = `
                <div class="card category-card shadow-sm h-100">
                    <div class="category-color-bar" style="background:${data.color}"></div>
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="category-icon" style="background:${data.color}"><i class="bi bi-book"></i></div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" onclick="viewCategory(${newId})"><i class="bi bi-eye me-2"></i>View</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="editCategory(${newId})"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteCategory(${newId})"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <h5 class="mb-1">${data.name}</h5>
                        <p class="text-muted small mb-3">${data.description}</p>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-muted">0 books</span>
                            <span class="small text-muted">0%</span>
                        </div>
                        <div class="progress" style="height:6px"><div class="progress-bar" style="width:0%;background:${data.color}"></div></div>
                    </div>
                </div>`;
            grid.appendChild(col);
            const tbody = document.querySelector('#categoryTable tbody');
            const tr = document.createElement('tr');
            tr.dataset.id = newId;
            tr.dataset.name = data.name.toLowerCase();
            tr.dataset.books = 0;
            tr.innerHTML = `
                <td>${newId}</td>
                <td><span class="d-inline-block rounded-circle" style="width:20px;height:20px;background:${data.color}"></span></td>
                <td><strong>${data.name}</strong></td>
                <td><small class="text-muted">${data.description}</small></td>
                <td><span class="badge bg-dark">0</span></td>
                <td><div class="progress" style="height:6px;width:80px"><div class="progress-bar" style="width:0%;background:${data.color}"></div></div></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="viewCategory(${newId})"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-warning" onclick="editCategory(${newId})"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(${newId})"><i class="bi bi-trash"></i></button>
                </td>`;
            tbody.appendChild(tr);
            e.target.reset();
            bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
            showToast('Category "' + data.name + '" added!');
            filterCategories();
            return false;
        }

        function showToast(msg) {
            document.getElementById('toastBody').textContent = msg;
            new bootstrap.Toast(document.getElementById('toast')).show();
        }

        // default to cards view
        showView('cards');
    </script>
</body>
</html>
