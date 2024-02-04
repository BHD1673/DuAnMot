<div class="container mt-5">
    <form action="" method="post">
        <div class="form-group">
        <label for="brand_name">Tên brand:</label>
        <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Điền tên brand bạn muốn thêm">
        </div>
        <div class="form-group">
        <label for="brand_description">Mô tả brand:</label>
        <div id="editor" name="editor" style="min-height: 200px;"></div>
        <input type="hidden" name="quill_content" id="quill_content">
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
    });

    // Add an event listener to capture changes in the Quill editor
    quill.on('text-change', function() {
        // Get the HTML content from the Quill editor
        var quillContent = quill.root.innerHTML;

        // Log the content to the console
        console.log('Quill Content:', quillContent);

        // Update the hidden input field with the Quill content
        document.getElementById('quill_content').value = quillContent;
    });
</script>

