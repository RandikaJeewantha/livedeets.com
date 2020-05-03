<?php include_once("../../path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/posts.php");?>
<?php adminOnly(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19a961e060.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Create Posts</title>
</head>

<body>

    <?php include_once( ROOT_PATH . "/app/includes/adminHeader.php" );?>

    <!-- start page wrapper -->
    <div class="admin-wrapper">

        <?php include_once( ROOT_PATH . "/app/includes/adminSidebar.php" );?>

        <!-- admin content start -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Add Post</a>
                <a href="index.php" class="btn btn-big">Manage Posts</a>
            </div>

            <div class="content">
                <h2 class="page-title">Create Posts</h2>

                <?php include_once(ROOT_PATH . "/app/helpers/formErrors.php");?>

                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="">Title</label>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="text-input">
                    </div>

                    <div>
                        <label for="">body</label>
                        <textarea name="body" id="body"><?php echo $body; ?></textarea>
                    </div>

                    <div>
                        <label for="">Image</label>
                        <input type="file" name="image" class="text-input">
                    </div>

                    <div>
                        <label for="">Topic</label>
                        <select name="topic_id" class="text-input">

                            <option></option>

                            <?php foreach ($topics as $key => $topic): ?>

                            <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                            <option selected value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>

                            <?php else: ?>
                            <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>

                            <?php endif; ?>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div>

                        <?php if(empty($published)): ?>
                        <label for="">
                            <input type="checkbox" name="published">
                            Publish
                        </label>
                        <?php else: ?>
                        <label for="">
                            <input type="checkbox" name="published" checked>
                            Publish
                        </label>
                        <?php endif; ?>

                    </div>

                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Add Posts</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- admin content end -->

    </div>
    <!-- end page wrapper -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>

</body>

</html>

<script>
ClassicEditor
    .create(document.querySelector('#body'), {
        toolbar: ['undo', 'redo', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
            'blockQuote', 'imageUpload'
        ],
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                }
            ]
        },
        image: {
            toolbar: [
                'imageStyle:full',
                'imageStyle:side',
                '|',
                'imageTextAlternative'
            ]
        }
    });
</script>