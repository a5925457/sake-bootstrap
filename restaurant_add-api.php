<?php
require __DIR__. '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];


$res_type = $_POST['res_type'] ?? '';
$res_area = $_POST['res_area'] ?? '';
$res_name = $_POST['res_name'] ?? '';
$res_intro = $_POST['res_intro'] ?? '';
$res_address = $_POST['res_address'] ?? '';

$ser_sun = $_POST['ser_sun'] ?? '';
$ser_mon = $_POST['ser_mon'] ?? '';
$ser_tue = $_POST['ser_tue'] ?? '';
$ser_wed = $_POST['ser_wed'] ?? '';
$ser_thu = $_POST['ser_thu'] ?? '';
$ser_fri = $_POST['ser_fri'] ?? '';
$ser_sat = $_POST['ser_sat'] ?? '';

$res_ser_hours[] = $ser_sat;
$res_ser_hours[] = $ser_sun;
$res_ser_hours[] = $ser_mon;
$res_ser_hours[] = $ser_tue;
$res_ser_hours[] = $ser_wed;
$res_ser_hours[] = $ser_thu;
$res_ser_hours[] = $ser_sat;

$new_res_ser_hours = json_encode($res_ser_hours);

$res_t_number = $_POST['res_t_number'] ?? '';
$web_link = $_POST['web_link'] ?? '';
$fb_link = $_POST['fb_link'] ?? '';
$ig_link = $_POST['ig_link'] ?? '';
$booking_link = $_POST['booking_link'] ?? '';


// // TODO: 檢查欄位資料
// if(empty($name)) {
//     $output['code'] = 401;
//     $output['error'] = '請輸入正確姓名';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// if(empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $output['code'] = 402;
//     $output['error'] = '請輸入正確email';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// if(empty($mobile) or !preg_match("/^09\d{2}-?\d{3}-?\d{3}$/", $mobile)) {
//     $output['code'] = 403;
//     $output['error'] = '請輸入正確手機號碼';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// if(empty($address)) {
//     $output['code'] = 404;
//     $output['error'] = '請輸入正確地址';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }




$sql = "INSERT INTO `restaurant`(
                           `res_type`, `res_area`, `res_name`, `res_intro`, `res_address`, `res_ser_hours`, `res_t_number`, `web_link`, `fb_link`, `ig_link`, `booking_link`, `res_create_date`, `res_update_date`
                           ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW() )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $res_type,
    $res_area,
    $res_name,
    $res_intro,
    $res_address,
    $new_res_ser_hours,
    $res_t_number,
    $web_link,
    $fb_link,
    $ig_link,
    $booking_link,
]);

$output['success'] = $stmt->rowCount()==1;  // rowCount() 為1 == 1 ，因此返回true
$output['rowCount'] = $stmt->rowCount();   // rowCount() 返回受最後一條 SQL 語句影響的行數



echo json_encode($output, JSON_UNESCAPED_UNICODE);