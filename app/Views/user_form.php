<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Anti-Hacker Lab</title>
    <style>
        /* Modern Dark Theme Design */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0b132b;
            color: #f4f5f6;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .container {
            background-color: #1c2541;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            border: 1px solid #3a506b;
        }

        h2 {
            color: #5bc0be;
            margin-top: 0;
            font-size: 24px;
            border-bottom: 2px solid #3a506b;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-weight: 600;
        }

        input[type="text"] {
            background-color: #0b132b;
            border: 1px solid #3a506b;
            color: #ffffff;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #5bc0be;
            box-shadow: 0 0 8px rgba(91, 192, 190, 0.4);
        }

        button {
            background-color: #5bc0be;
            color: #0b132b;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #469d9b;
        }

        hr {
            border: 0;
            height: 1px;
            background: #3a506b;
            margin: 25px 0;
        }

        h3 {
            color: #6fffe9;
            margin-top: 0;
            font-size: 18px;
        }

        .result-box {
            background-color: #0b132b;
            border-left: 4px solid #6fffe9;
            padding: 15px;
            border-radius: 4px;
            font-family: 'Courier New', Courier, monospace;
            word-break: break-all;
        }

        .result-box p {
            margin: 0;
            font-size: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>The Anti-Hacker Lab</h2>
    
    <form action="<?= site_url('submit-form') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="username">Enter Name:</label>
            <input type="text" id="username" name="username" placeholder="Type text or HTML code..." required autocomplete="off">
        </div>
        
        <button type="submit">Submit Form</button>
    </form>
    
    <?php if (isset($username)): ?>
        <hr>
        <h3>Result Output:</h3>
        <div class="result-box">
            <p>Hello, Day 1 User: <strong><?= esc($username); ?></strong></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>