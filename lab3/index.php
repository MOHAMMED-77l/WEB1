<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GPA Calculator - Final Stage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>GPA Calculator (AJAX & Bootstrap)</h3>
        </div>
        <div class="card-body">
            <form id="gpaForm">
                <div id="course-container">
                    <div class="row mb-3 course-row">
                        <div class="col-md-5">
                            <input type="text" name="course[]" class="form-control" placeholder="Course Name" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="credits[]" class="form-control" placeholder="Credits" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <select name="grade[]" class="form-select">
                                <option value="4.0">A (4.0)</option>
                                <option value="3.0">B (3.0)</option>
                                <option value="2.0">C (2.0)</option>
                                <option value="1.0">D (1.0)</option>
                                <option value="0.0">F (0.0)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mb-3" onclick="addCourseRow()">+ Add Course</button>
                <hr>
                <button type="submit" class="btn btn-success w-100">Calculate GPA</button>
            </form>

            <div id="resultArea" class="mt-4" style="display:none;">
                <div id="tableContent"></div>
                <div class="alert alert-info mt-3" id="gpaDisplay"></div>
            </div>
        </div>
    </div>
</div>

<script>
// وظيفة إضافة صف مادة جديد
function addCourseRow() {
    let row = $('.course-row:first').clone();
    row.find('input').val('');
    $('#course-container').append(row);
}

// وظيفة AJAX لإرسال البيانات دون تحديث الصفحة
$(document).ready(function() {
    $('#gpaForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'process.php', // سنقوم بإنشاء هذا الملف الآن
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                let data = JSON.parse(response);
                $('#tableContent').html(data.table);
                $('#gpaDisplay').html('<strong>' + data.message + '</strong>');
                $('#resultArea').fadeIn();
            }
        });
    });
});
</script>
</body>
</html>
