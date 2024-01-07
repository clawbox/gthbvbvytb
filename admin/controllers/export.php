<?php
$errbox = false;
$method_sql = "Select * from withdraw_methods ";
$method_query = mysqli_query($con,$method_sql);

if(isset($_POST['status'])) {

$status = $_POST['status'];
$method = $_POST['method'];
if($method == "bank") {
    $export_sql = "SELECT * FROM `withdraws` WHERE `method` = '$method' AND `status` = '$status'";
    $export_query = mysqli_query($con,$export_sql);
   
    $html = '<table><tr><td>Id</td><td>User Id</td><td>Amount</td><td>Account Holder Name</td><td>Account Number</td><td>IFC Code</td></tr>';
    while($data = mysqli_fetch_array($export_query)) {
        $user_id = $data['user_id'];
        $bank_sql = "SELECT * FROM `user_bank` WHERE `user_id` = '$user_id'";
        $bank_query = mysqli_query($con,$bank_sql);
        $bank_data = mysqli_fetch_array($bank_query);
        $html .= '<tr><td>'.$data['id'].'</td><td>'.$data['user_id'].'</td><td>'.($data['amount'] * 75).'</td><td>'.$bank_data['name'].'</td><td>'.$bank_data['number'].'</td><td>'.$bank_data['IFSC'].'</td></tr>';

    
    
    }


}else {
    $export_sql = "SELECT * FROM `withdraws` WHERE `method` = '$method' AND `status` = '$status'";
    $export_query = mysqli_query($con,$export_sql);
    $html = '<table><tr><td>Id</td><td>User Id</td><td>Amount</td><td>Withdrawal Method</td><td>Withdrawal Account</td></tr>';
    while($data = mysqli_fetch_array($export_query)) {
        $html .= '<tr><td>'.$data['id'].'</td><td>'.$data['user_id'].'</td><td>'.($data['amount'] * 75).'</td><td>'.$data['method'].'</td><td>'.$data['account'].'</td></tr>';

    
    
    }


}

$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=withdraws.xls');
echo $html;
die();


}