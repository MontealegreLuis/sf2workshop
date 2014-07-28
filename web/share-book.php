<?php
require '../vendor/autoload.php';

is_user_logged();

$conn = db_connect();
$sql = <<<QUERY
    SELECT
        a.author_id,
        a.name
     FROM author a
QUERY;
$authors = query_fetch_all($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head><?php include '../app/theme/header.phtml' ?></head>
    <body>
        <article class="container">
            <?php include '../app/theme/navigation.phtml' ?>
            <?php include '../app/theme/branding.phtml' ?>
            <h2>Share a book</h2>
            <form action="/index.php/books/save" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <select name="author-id" class="form-control">
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo $author['author_id'] ?>">
                                <?php echo $author['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file"><br>
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-default">
            </form>
        </article>
        <?php include '../app/theme/scripts.phtml' ?>
    </body>
</html>
