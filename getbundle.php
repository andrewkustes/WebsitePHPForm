<?php
$mysqli = new mysqli("127.0.0.1","root","root","certifications");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

// Perform query


if ($result = $mysqli->query("SELECT c.*,ce.* FROM candidates_exam ce JOIN candidates c ON ce.candidate_id = c.candidate_id WHERE ce.candidate_exam_grade = 'pass'")) 
{
  echo "Returned rows are: " . $result->num_rows . '<br /><br />';

  if($result->num_rows > 0)
  {

    while ($row = $result->fetch_assoc())
    {
        $six_digit_random_number = random_int(100000, 999999);

        $key = 'GGOkggdNjJffQ8xtPquqvSdkduOrsi8e';
        $hash = hash_hmac('sha256', $six_digit_random_number, $key);

        $exam_id = $row['candidate_exam_id'];
        $name = $row['candidate_first_name'] . ' ' . $row['candidate_last_name'];
        $cert_name = $row['candidate_exam_name'];
        $date = $row['created_at'];
        $edate = date('Y-m-d H:i:s', strtotime('+2 years', strtotime($row['created_at'])));
        //$mysqli->query("INSERT INTO master (exam_id, hash, name, cert, date, expires) VALUES (\"$exam_id\",\"$hash\", \"$name\", \"$cert_name\", \"$date\", \"$edate\")");

        echo  $row['candidate_exam_id'] . ' ' . $hash . ' ' . $row['candidate_first_name'] . ' ' . $row['candidate_last_name'] . ' ' . $row['candidate_exam_name'] . ' ' . $row['created_at'] . ' ' . $edate . '<br />';
    }

  }


  // Free result set
  $result->free_result();
}

$mysqli->close();