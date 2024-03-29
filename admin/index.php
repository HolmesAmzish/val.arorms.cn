<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登录-Valley</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        .centered-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            padding: 20px; 
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .card {
            max-width: 400px;
            width: 100%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-cancel {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="centered-form">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">管理员登录</h4>
            <form class="profile-form" method="post" action="AdminLogin.php">
                
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" name="admin_name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密码</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" class="btn btn-primary mr-2">提交</button>
                <button class="btn btn-light" type="reset">重置</button>
                <div style="height: 10px;"></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
