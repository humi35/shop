<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

try{
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name FROM mst_staff WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print 'スタッフ一覧</br/></br/>';
    print '<form method="post" action="staff_branch.php">';//変更箇所:action="staff_edit.php"
    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rec == false){
            break;
        }
        print'<input type="radio" name="staffcode" value="'.$rec['code'].'">';
        print $rec['name'];
        print '<br/>';   
    }
    print '<input type="submit" name="disp" value="参照">';
    print '<input type="submit" name="add" value="追加">';
    print '<input type="submit" name="edit" value="修正">';//name属性 editを追加
    print '<input type="submit" name="delete" value="削除">';//追加
    print '</form>';
}catch(Exception $e){
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        print $e;
        exit();
}

?>
</body>

</html>