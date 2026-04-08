<?php
header('Content-Type: application/json'); [cite: 802]

if (isset($_POST['course'], $_POST['credits'], $_POST['grade'])) {
    $courses = $_POST['course']; [cite: 803, 807]
    $credits = $_POST['credits']; [cite: 810]
    $grades = $_POST['grade']; [cite: 813]

    $totalPoints = 0; $totalCredits = 0;
    $tableHtml = '<table class="table table-bordered mt-3"><thead class="thead-dark"><tr><th>Course</th><th>Credits</th><th>Grade</th><th>Grade Points</th></tr></thead><tbody>'; [cite: 815, 818, 822, 823, 825, 832, 833]

    for ($i = 0; $i < count($courses); $i++) {
        $cr = floatval($credits[$i]); [cite: 839, 845]
        $g = floatval($grades[$i]); [cite: 848]
        if ($cr <= 0) continue; [cite: 851]

        $pts = $cr * $g; [cite: 854]
        $totalPoints += $pts; [cite: 856]
        $totalCredits += $cr; [cite: 858, 859]

        $tableHtml .= "<tr><td>".htmlspecialchars($courses[$i])."</td><td>$cr</td><td>$g</td><td>$pts</td></tr>"; [cite: 861, 862, 864, 866]
    }
    $tableHtml .= '</tbody></table>'; [cite: 876]

    if ($totalCredits > 0) {
        $gpa = $totalPoints / $totalCredits; [cite: 877, 878]
        // تحديد التقدير [cite: 879, 882, 884]
        if ($gpa >= 3.7) $interpretation = "Distinction";
        elseif ($gpa >= 3.0) $interpretation = "Merit";
        elseif ($gpa >= 2.0) $interpretation = "Pass";
        else $interpretation = "Fail";

        echo json_encode([
            'success' => true,
            'gpa' => $gpa,
            'message' => "Your GPA is " . number_format($gpa, 2) . " ($interpretation).",
            'tableHtml' => $tableHtml
        ]); [cite: 905, 907, 910, 913, 926]
    }
}
?>
