<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Picture & Paging Lab</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #0d1b2a;
            color: #e0e1dd;
            margin: 0;
            padding: 40px 20px;
        }
        .main-wrapper {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
        }
        @media (max-width: 768px) {
            .main-wrapper { grid-template-columns: 1fr; }
        }
        .card {
            background-color: #1b263b;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #415a77;
            box-shadow: 0 8px 16px rgba(0,0,0,0.4);
            height: fit-content;
        }
        h2, h3 {
            color: #e0e1dd;
            margin-top: 0;
            border-bottom: 2px solid #415a77;
            padding-bottom: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #a3b18a;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #0d1b2a;
            border: 1px solid #415a77;
            border-radius: 6px;
            color: #fff;
        }
        button {
            background-color: #e0e1dd;
            color: #0d1b2a;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        button:hover { background-color: #cfd2cd; }
        
        /* User List Style */
        .user-item {
            display: flex;
            align-items: center;
            background-color: #0d1b2a;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #415a77;
        }
        .avatar-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #e0e1dd;
        }
        .user-info strong { color: #fff; font-size: 16px; }
        .user-info p { margin: 4px 0 0 0; font-size: 12px; color: #888; }
        
        /* Alert Messages */
        .alert { padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 14px; }
        .alert-success { background-color: #2a9d8f; color: #fff; }
        .alert-danger { background-color: #e63946; color: #fff; }

        /* TASK 03: Custom CodeIgniter Pagination Style Links */
        .pagination-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .pagination-container ul { list-style: none; padding: 0; display: flex; gap: 5px; }
        .pagination-container li a {
            color: #fff; background-color: #415a77; padding: 8px 12px;
            text-decoration: none; border-radius: 4px; font-size: 14px;
        }
        .pagination-container li.active a { background-color: #e0e1dd; color: #0d1b2a; font-weight: bold; }
    </style>
</head>
<body>

<div class="main-wrapper">
    
    <div class="card">
        <h2>Upload Profile</h2>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('profile/upload') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= old('username') ?>" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="avatar">Choose Profile Photo:</label>
                <input type="file" id="avatar" name="avatar" accept="image/*" required>
            </div>

            <button type="submit">Upload Account</button>
        </form>
    </div>

    <div class="card">
        <h3>Registered Users (5 per page)</h3>
        
        <?php if (empty($users)): ?>
            <p style="color: #888;">No users found. Upload one on the left form!</p>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <div class="user-item">
                    <img class="avatar-img" src="<?= base_url('uploads/' . $user['avatar']) ?>" alt="Avatar">
                    <div class="user-info">
                        <strong><?= esc($user['username']) ?></strong>
                        <p>ID Account: #<?= $user['id'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="pagination-container">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>

</div>

</body>
</html>