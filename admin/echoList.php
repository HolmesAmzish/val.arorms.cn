<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章列表-Valley</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }
    </style>
</head>
<body>
    <?php
    include("../includes/admin-header.php");

    if (!isset($_SESSION['admin_name'])) {
        $login_error = "未知管理员";
        header("location:index.php?msg=$login_error");
        exit;
    }

    // 数据库查询
    require_once("../scripts/dbConnect.php");
    $conn = dbConnect();
    $sql = "SELECT * FROM echo";
    $result = $conn->query($sql);
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <h2 class="mt-4">树洞</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>消息ID</th>
                            <th>内容</th>
                            <th>发布者</th>
                            <th>发布时间</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // 遍历数据库查询结果，将用户数据输出到表格中
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['echo_id']}</td>";
                            echo "<td>{$row['content']}</td>";
                            echo "<td>{$row['sender_id']}</td>";
                            echo "<td>{$row['sent_at']}</td>";
                            echo "<td><a href='echoDelete.php?eid={$row['echo_id']}' class='btn btn-primary' onclick=\"return confirm('确认删除')\">删除</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
