<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查看-Valley</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .card {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }
        .post {
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php
    include("../includes/header.php");
    require_once("../scripts/dbConnect.php");
    $conn = dbConnect();
    $post_id = $_GET['pid'];

    // Post information
    $stmt = $conn->prepare("SELECT p.*, u.*
                FROM posts p
                JOIN users u ON p.author = u.username
                WHERE p.post_id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // add views
    $conn->query("UPDATE posts SET views = views + 1 WHERE post_id=$post_id");
    
    ?>

    <div class="container mt-5">
        <div class="row">
            <!-- 侧边栏 -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">信息</h5><hr>
                        <p class="card-text">作者：<a href="profile.php?uid=<?php echo $row['user_id']; ?>"><?php echo $row['author']; ?></a></p>
                        <p class="card-text">发布日期：<?php echo $row['creation_date']; ?></p>
                        <p class="card-text">浏览数：<?php echo $row['views']; ?></p>
                        <p class="card-text">点赞数：<?php echo $row['likes']; ?></p>
                        <p class="card-text">标签：<?php echo $row['tags']; ?></p>
                    </div>
                </div>
            </div>
            <!-- 主栏 -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5><hr>
                        <p class="card-text"><?php echo $row['content']; ?></p>
                    </div>
                </div>
                <!-- comments -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">评论区</h5>
                        <!-- 评论列表 -->
                        <ul class="list-group">
                            <?php
                            $stmt_comment = $conn->prepare("SELECT * FROM comments WHERE post_id=?");
                            $stmt_comment->bind_param("i", $post_id);
                            $stmt_comment->execute();
                            $result_comment = $stmt_comment->get_result();
                            while ($row_comment = $result_comment->fetch_assoc()) {
                                $comment_date = strtotime($row_comment['comment_date']);
                            ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-0"><?php echo $row_comment['username'] . ":"; ?></h6>
                                    </div>
                                    <small class="text-muted"><?php echo "点赞 " . $row_comment['likes'] . " | " . date("Y-m-d H:i", $comment_date); ?></small>
                                </div>
                                <p class="mb-1"><?php echo $row_comment['comment_content']; ?></p>
                            </li>
                            <?php  }?>
                        </ul>
                    </div>
                </div>

                <!-- send comments -->
                <div class="card post">
                    <form class="post-form" action="../scripts/doComment.php" method="post">
                        <input type="hidden" name="post_id"  value="<?php echo $post_id?>">
                        <div class="mb-3">
                            <label for="post_comments" class="form-label">发送评论</label>
                            <textarea type="text" class="form-control" name="comment" placeholder="评论"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">发送</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("../includes/footer.html"); ?>
    <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
