<?php
require __DIR__. '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];


$res_id = isset($_POST['res_id']) ? intval($_POST['res_id']) : 0;

if(empty($res_id)) {
    $output['code'] = 400;
    $output['error'] = '沒有該餐廳編號';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}

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


// 檢查欄位資料
if(empty($res_name)) {
    $output['code'] = 401;
    $output['error'] = '請輸入餐廳名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($res_intro)) {
    $output['code'] = 402;
    $output['error'] = '請輸入餐廳介紹';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($res_address)) {
    $output['code'] = 403;
    $output['error'] = '請輸入餐廳地址';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($ser_sat) or empty($ser_sun) or empty($ser_mon) or empty($ser_tue) or empty($ser_wed) or empty($ser_thu) or empty($ser_fri)) {
    $output['code'] = 404;
    $output['error'] = '請輸入營業時間';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($res_t_number) or !preg_match("/\d{2,4}-?\d{3,4}-?\d{3,4}#?(\d+)?/", $res_t_number)) {
    $output['code'] = 405;
    $output['error'] = '請輸入正確餐廳電話';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if((!empty($web_link) && !filter_var($web_link, FILTER_VALIDATE_URL)) or (!empty($fb_link) && !filter_var($fb_link, FILTER_VALIDATE_URL)) or (!empty($ig_link) && !filter_var($ig_link, FILTER_VALIDATE_URL)) or (!empty($booking_link) && !filter_var($booking_link, FILTER_VALIDATE_URL))) {
    $output['code'] = 406;
    $output['error'] = '請輸入正確網址';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}




$sql = "UPDATE `restaurant` SET 
`res_type`=?,
`res_area`=?,
`res_name`=?,
`res_intro`=?,
`res_address`=?,
`res_ser_hours`=?,
`res_t_number`=?,
`web_link`=?,
`fb_link`=?,
`ig_link`=?,
`booking_link`=?,
`res_update_date`=NOW()
WHERE `res_id`=?";

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
    $res_id
]);


if($stmt->rowCount()==0) {
    $output['error'] = '資料未修改';
} else {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);