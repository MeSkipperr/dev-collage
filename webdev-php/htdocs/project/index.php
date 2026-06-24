<?php
$currentPage = 'dashboard';

$categories = [
    ['id' => 1, 'name' => 'Fiction', 'description' => 'Novels, short stories, and literary fiction'],
    ['id' => 2, 'name' => 'Science', 'description' => 'Physics, biology, chemistry, and astronomy'],
    ['id' => 3, 'name' => 'History', 'description' => 'World history, ancient civilizations, and biographies'],
    ['id' => 4, 'name' => 'Technology', 'description' => 'Computer science, programming, and engineering'],
    ['id' => 5, 'name' => 'Philosophy', 'description' => 'Ethics, logic, and existential thought'],
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

$members = [
    ['id'=>1,'name'=>'Alice Johnson','email'=>'alice@email.com','phone'=>'555-0101','status'=>'Active','joined'=>'2023-01-15'],
    ['id'=>2,'name'=>'Bob Williams','email'=>'bob@email.com','phone'=>'555-0102','status'=>'Active','joined'=>'2023-03-22'],
    ['id'=>3,'name'=>'Carol Davis','email'=>'carol@email.com','phone'=>'555-0103','status'=>'Active','joined'=>'2023-06-10'],
    ['id'=>4,'name'=>'David Brown','email'=>'david@email.com','phone'=>'555-0104','status'=>'Inactive','joined'=>'2022-11-05'],
    ['id'=>5,'name'=>'Eva Martinez','email'=>'eva@email.com','phone'=>'555-0105','status'=>'Active','joined'=>'2024-01-08'],
    ['id'=>6,'name'=>'Frank Wilson','email'=>'frank@email.com','phone'=>'555-0106','status'=>'Active','joined'=>'2024-02-14'],
    ['id'=>7,'name'=>'Grace Lee','email'=>'grace@email.com','phone'=>'555-0107','status'=>'Suspended','joined'=>'2023-09-30'],
    ['id'=>8,'name'=>'Henry Taylor','email'=>'henry@email.com','phone'=>'555-0108','status'=>'Active','joined'=>'2024-04-01'],
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

$totalBooks = array_sum(array_column($books, 'quantity'));
$totalMembers = count($members);
$activeBorrows = count(array_filter($borrowings, fn($b) => $b['status'] === 'Active'));
$overdueBorrows = count(array_filter($borrowings, fn($b) => $b['status'] === 'Overdue'));
$availableBooks = array_sum(array_column($books, 'available'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Dashboard</title>
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
            <li><a href="index.php" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li><a href="books.php"><i class="bi bi-book"></i> Books</a></li>
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
            <h4 class="mb-0">Dashboard</h4>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small"><?php echo date('l, F j, Y'); ?></span>
            </div>
        </div>

        <div class="container-fluid py-3">
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small">Total Books</div>
                                    <h3 class="mb-0 mt-1"><?php echo $totalBooks; ?></h3>
                                </div>
                                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-book"></i>
                                </div>
                            </div>
                            <div class="small text-muted mt-2"><i class="bi bi-check-circle text-success"></i> <?php echo $availableBooks; ?> available</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small">Members</div>
                                    <h3 class="mb-0 mt-1"><?php echo $totalMembers; ?></h3>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                            <div class="small text-muted mt-2"><i class="bi bi-person-check text-success"></i> <?php echo count(array_filter($members, fn($m) => $m['status']==='Active')); ?> active</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small">Active Borrows</div>
                                    <h3 class="mb-0 mt-1"><?php echo $activeBorrows; ?></h3>
                                </div>
                                <div class="stat-icon bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-arrow-left-right"></i>
                                </div>
                            </div>
                            <div class="small text-muted mt-2">out of <?php echo count($borrowings); ?> total</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small">Overdue</div>
                                    <h3 class="mb-0 mt-1"><?php echo $overdueBorrows; ?></h3>
                                </div>
                                <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                            </div>
                            <div class="small text-danger mt-2"><i class="bi bi-exclamation-circle"></i> needs attention</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Borrowings</h6>
                            <a href="borrowings.php" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Book</th>
                                            <th>Member</th>
                                            <th>Borrowed</th>
                                            <th>Due</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach(array_slice($borrowings, 0, 6) as $b):
                                            $book = $books[array_search($b['book_id'], array_column($books, 'id'))];
                                            $member = $members[array_search($b['member_id'], array_column($members, 'id'))];
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $book['title']; ?></strong><br><small class="text-muted"><?php echo $book['author']; ?></small></td>
                                            <td><?php echo $member['name']; ?></td>
                                            <td><?php echo $b['borrow_date']; ?></td>
                                            <td><?php echo $b['due_date']; ?></td>
                                            <td>
                                                <?php
                                                $badgeClass = match($b['status']) {
                                                    'Active' => 'bg-primary',
                                                    'Returned' => 'bg-success',
                                                    'Overdue' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $b['status']; ?></span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="bi bi-tags me-2"></i>Categories</h6>
                        </div>
                        <div class="card-body">
                            <?php foreach($categories as $cat):
                                $catBooks = count(array_filter($books, fn($b) => $b['category_id'] === $cat['id']));
                            ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><?php echo $cat['name']; ?></span>
                                <span class="badge bg-secondary"><?php echo $catBooks; ?> books</span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="bi bi-graph-up me-2"></i>Quick Stats</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Borrow Rate</span>
                                <strong><?php echo round($activeBorrows / count($borrowings) * 100); ?>%</strong>
                            </div>
                            <div class="progress mb-3" style="height:6px">
                                <div class="progress-bar bg-info" style="width:<?php echo round($activeBorrows / count($borrowings) * 100); ?>%"></div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Availability</span>
                                <strong><?php echo round($availableBooks / $totalBooks * 100); ?>%</strong>
                            </div>
                            <div class="progress" style="height:6px">
                                <div class="progress-bar bg-success" style="width:<?php echo round($availableBooks / $totalBooks * 100); ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
