<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courses = $_POST['course'];
    $credits = $_POST['credits'];
    $grades = $_POST['grade'];
    
    $totalPoints = 0;
    $totalCredits = 0;
    $table = "<table class='table table-bordered'><thead><tr><th>Course</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";

    for ($i = 0; $i < count($courses); $i++) {
        $cr = floatval($credits[$i]);
        $gp = floatval($grades[$i]);
        $totalPoints += ($cr * $gp);
        $totalCredits += $cr;
        $table .= "<tr><td>{$courses[$i]}</td><td>$cr</td><td>$gp</td></tr>";
    }
    $table .= "</tbody></table>";

    $gpa = ($totalCredits > 0) ? ($totalPoints / $totalCredits) : 0;
    $msg = "Your GPA is: " . number_format($gpa, 2);

    // إرسال البيانات للـ AJAX
    echo json_encode([
        'table' => $table,
        'message' => $msg
    ]);
}
