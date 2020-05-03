<?php include_once("../../path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/topics.php");?>
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
    <title>Topics Edit</title>
</head>
<body>

    <?php include_once( ROOT_PATH . "/app/includes/adminHeader.php" );?>
    
    <!-- start page wrapper -->
    <div class="admin-wrapper">

    <?php include_once( ROOT_PATH . "/app/includes/adminSidebar.php" );?>

    <!-- admin content start -->
    <div class="admin-content">
        <div class="button-group">
            <a href="create.php" class="btn btn-big">Add Topics</a>
            <a href="index.php" class="btn btn-big">Manage Topics</a>
        </div>

        <div class="content">
            <h2 class="page-title">Edit Topics</h2>

            <?php include_once(ROOT_PATH . "/app/helpers/formErrors.php");?>

            <form action="edit.php" method="post">

                <input type="hidden" name="id" value="<?php echo $id; ?> ">
                <div>
                    <label for="">Name</label>
                    <input type="text" name="name" value="<?php echo $name; ?>" class="text-input">
                </div>

                <div>
                    <label for="">Description</label>
                    <textarea name="description" id="body"><?php echo $description; ?></textarea>
                </div>

                <div>
                   <button type="submit" name="update-topic" class="btn btn-big">Update Topic</button>
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
