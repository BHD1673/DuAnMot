function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}

var quill = new Quill('#editor', {
    theme: 'snow',
    style: 'height: 1000px;',
  });

// Update the hidden input value when the Quill content changes
quill.on('text-change', function() {
document.getElementById('itemDescription').value = quill.root.innerHTML;
});

$(document).ready(function(){
    $("input[type='checkbox']").change(function(){
        var colorValue = $(this).val();
        if ($(this).is(":checked")) {
            $("#selectedColors").append("<div class='selected-color' data-color='" + colorValue + "'>" + 
                                            "<button class='btn btn-light m-1' style='background-color:" + colorValue + "' name='selectedColors[]'>" + colorValue + "</button>" + 
                                            "<a href='javascript:void(0)' onclick='removeColor(\"" + colorValue + "\")'>Xóa</a>" + 
                                        "</div>");
        } else {
            // Remove the selected color when unchecked
            $("#selectedColors .selected-color[data-color='" + colorValue + "']").remove();
        }
    });
});

function removeColor(color) {
    // Uncheck the corresponding checkbox
    $("#colorOptions input[value='" + color + "']").prop('checked', false);
    // Remove the selected color div
    $("#selectedColors .selected-color[data-color='" + color + "']").remove();
}
