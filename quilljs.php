<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the Quill content from the hidden input field
    $quillContent = $_POST['quill_content'];

    // You can now do something with $quillContent, for example, save it to a database
    // For this example, let's just print it to the screen
    echo "<h2>Your Quill Content:</h2>";
    echo "<div>{$quillContent}</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quill.js Form</title>
    <!-- Include Quill.js styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>

    <h1>Quill.js Form</h1>

    <form method="post">
        <label for="editor">Write something:</label>
        <!-- Create a div to hold the Quill editor -->
        <div id="editor" style="height: 300px;"></div>

        <!-- Include Quill.js scripts -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <!-- Initialize Quill -->
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow'
            });
        </script>

        <!-- Include a hidden input field to store Quill content -->
        <input type="hidden" name="quill_content" id="quill_content">
        
        <br>
        <button type="submit">Submit</button>
    </form>

    <!-- Script to update the hidden input with Quill content before form submission -->
    <script>
        var form = document.querySelector('form');
        form.onsubmit = function() {
            var quillContent = quill.root.innerHTML;
            document.getElementById('quill_content').value = quillContent;
        };
    </script>

</body>
</html>
