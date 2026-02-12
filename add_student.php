<?php
include 'config.php';

if (empty($_POST['full_name']) || empty($_POST['course']) || empty($_POST['year_level']) || empty($_POST['email'])) {
    die("All fields are required. <a href='index.php'>Back</a>");
}

// Get year level and convert to year code
$year_level = $_POST['year_level'];
$year_map = array(
    '1st' => 244,
    '2nd' => 243,
    '3rd' => 242,
    '4th' => 241
);
$year_code = $year_map[$year_level];

// Get the next student number for this year
$result = $conn->query("SELECT MAX(CAST(SUBSTRING_INDEX(student_no, '-', -2) AS UNSIGNED)) as max_num FROM students WHERE student_no LIKE '$year_code-%'");
$row = $result->fetch_assoc();
$next_num = ($row['max_num'] !== null) ? $row['max_num'] + 1 : 0;
$student_num = str_pad($next_num, 4, '0', STR_PAD_LEFT);

// Generate student number in format: 241-0000-2
$student_no = $year_code . '-' . $student_num . '-2';

$sql = "INSERT INTO students (student_no, full_name, course,
year_level, email)
VALUES (
'$student_no',
'$_POST[full_name]',
'$_POST[course]',
'$_POST[year_level]',
'$_POST[email]'
)";
if ($conn->query($sql)) {

echo "Student added successfully! <a href='index.php'>Back</a>";
} else {
echo "Error: " . $conn->error;
}
?>