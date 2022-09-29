<?php
require_once "db.php";

$stmt = $conn->query(
    "SELECT COUNT(CASE WHEN occupation = 'เกษตรกร' THEN 1 END) AS เกษตรกร ,
    COUNT(CASE WHEN occupation = 'ปศุสัตว์' THEN 1 END) AS ปศุสัตว์ ,
    COUNT(CASE WHEN occupation = 'บุคลากรภาครัฐ' THEN 1 END) AS บุคลากรภาครัฐ ,
    COUNT(CASE WHEN occupation = 'บุคลากรภาคเอกชน' THEN 1 END) AS บุคลากรภาคเอกชน ,
    COUNT(CASE WHEN occupation = 'การประมง' THEN 1 END) AS การประมง ,
    COUNT(CASE WHEN occupation = 'อาหารและเครื่องดื่ม' THEN 1 END) AS อาหารและเครื่องดื่ม ,
    COUNT(CASE WHEN occupation = 'ช่าง' THEN 1 END) AS ช่าง ,
    COUNT(CASE WHEN occupation = 'นักออกแบบ' THEN 1 END) AS นักออกแบบ FROM res_user");
$result = $stmt->fetchAll();

echo json_encode($result, JSON_UNESCAPED_UNICODE);
