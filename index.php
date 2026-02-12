<!DOCTYPE html>
<html>
<head>
<title>Student Information System</title>
<link rel="stylesheet" href="test.css">
</head>
<body>
<h2>Add Student</h2>
<form method="post" action="add_student.php">
<input type="text" name="full_name" placeholder="Full Name"
required><br>
<select name="course" required>
<option value="" selected hidden>Select Course</option>
<option value="COLLEGE OF GRADUATES">COLLEGE OF GRADUATES</option>
<option value="COLLEGE OF LAW (CLAW)">COLLEGE OF LAW (CLAW)</option>
<option value="COLLEGE OF ENGENEERING (COE)">COLLEGE OF ENGENEERING (COE)</option>
<option value="COLLEGE OF INFORMATION TECHNOLOGY (CIT)">COLLEGE OF INFORMATION TECHNOLOGY (CIT)</option>
<option value="COLLEGE OF ARTS AND SCIENCE (CAS)">COLLEGE OF ARTS AND SCIENCE (CAS)</option>
<option value="COLLEGE OF EDUCATION (CE)">COLLEGE OF EDUCATION (CE)</option>
<option value="COLLEGE OF MANAGEMENT (COM)">COLLEGE OF MANAGEMENT (COM)</option>
<option value="COLLEGE OF TECHNOLOGY (COT)">COLLEGE OF TECHNOLOGY (COT)</option>
<option value="INSTITUTE OF CRIMINAL JUSTICE EDUCATION (ICJE)">INSTITUTE OF CRIMINAL JUSTICE EDUCATION (ICJE)</option>
</select><br>
<select name="year_level" required>
<option value="" selected hidden>Select Year Level</option>
<option value="1st">1st Year</option>
<option value="2nd">2nd Year</option>
<option value="3rd">3rd Year</option>
<option value="4th">4th Year</option>
</select><br>
<input type="email" name="email" placeholder="Email"><br><br>
<button type="submit">Save</button>
</form>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
<h2 style="margin: 0;">Student List</h2>
<form method="get" action="index.php" class="search-form">
<div style="position: relative; display: flex; align-items: center;">
<input type="text" name="search" placeholder="Search by Student No, Name, Course, or Email" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" style="width: 350px; padding-right: 45px;">
<button type="submit" style="position: absolute; right: 5px; background: none; border: none; cursor: pointer; padding: 8px; color: #667eea;">🔍</button>
</div>
</form>
</div>

<?php
include 'config.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    $search_query = $conn->real_escape_string($search);
    $result = $conn->query("SELECT * FROM students WHERE student_no LIKE '%$search_query%' OR full_name LIKE '%$search_query%' OR course LIKE '%$search_query%' OR email LIKE '%$search_query%'");
} else {
    $result = $conn->query("SELECT * FROM students");
}
?>
<table border="1">
<tr>
<th>Student No</th>
<th>Name</th>
<th>Course</th>
<th>Year</th>
<th>Email</th>
<th>Action</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['student_no'] ?></td>
<td><?= $row['full_name'] ?></td>
<td><?= $row['course'] ?></td>
<td><?= $row['year_level'] ?></td>
<td><?= $row['email'] ?></td>
<td>
<a href="delete_student.php?id=<?= $row['student_id']

?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>


</body>
</html>


