<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <!-- 
    TODO: it needs some style and maybe a "create" page 
    (it might be interesting to check the textarea for the pdf generator once finished) 
    -->
    <h1>Welcome to Home Page</h1>

    <?php
        use Hleyf\Blog\Models\Post;

        $posts = Post::getPosts();
        foreach ($posts as $post) {
            echo "<a href='{$post->getPostURL()}'>{$post->getTitle()}</a><br>";
        }

    ?>
</body>
</html>