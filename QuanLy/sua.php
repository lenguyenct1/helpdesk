
<?php
       session_start();
//	if (isset($_SESSION['idtaikhoan'])) {
//		$taikhoan = $_SESSION['idtaikhoan'];
//	  }
   // include ('../db/pgiangvien.php');
    $id=$_SESSION['idtaikhoan'];
    require ('../conn.php');
//    $sql="SELECT taikhoan.*, donvi.TENDV from canbo, donvi 
//        WHERE canbo.MADV=donvi.MADV AND canbo.MACB='$id';";
 $sql="SELECT taikhoan.*, nhomnguoidung.ten from taikhoan, nhomnguoidung 
        WHERE taikhoan.IDnhomnguoidung=nhomnguoidung.idnhomnguoidung AND taikhoan.idtaikhoan='$id';";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    $Mnv=$row['idtaikhoan'];
    $name=$row['taikhoan'];
    $ns=$row['matkhau'];
    $email=$row['email'];
    $chucvu=$row['ten'];

if(isset($_GET["id"])){
    $macanbo=$_GET["id"];
    require ('../conn.php');
    $sqlcb="SELECT  * FROM  `suco` WHERE idsuco='$macanbo';";
    $resulcb=mysqli_query($conn,$sqlcb);
    while ($ifList=mysqli_fetch_array($resulcb)){
		$idsuco=$ifList["idsuco"];
        $tensuco=$ifList["tensuco"];
        $motasuco=$ifList["motasuco"];
        $hinhanh=$ifList["hinhanh"];
		$sophong=$ifList["sophong"];
		$somay=$ifList["somay"];
		$thietbihong=$ifList["thietbihong"];
        $thoigianyeucau=$ifList["thoigianyeucau"];
        $thoigianhoanthanh=$ifList["thoigianhoanthanh"];
        $trangthaiduyet=$ifList["trangthaiduyet"];
    }
//    $sqluser="SELECT  * FROM  taikhoan WHERE MACB='$macanbo';";
//    $resuluser=mysqli_query($conn,$sqluser);
//    while ($ifurList=mysqli_fetch_array($resuluser)){
//        $ifurUser=$ifurList["USERNAME"];
//        $ifurStt=$ifurList["TRANGTHAI"];
//        $ifurCapdo=$ifurList["CAPDO"];
//    }

}
if(isset($_POST["btedit"])) {
    require ('../conn.php');
//    $sqldsbophaan="SELECT * FROM `suco`;";
//    $qbp=mysqli_query($conn,$sqldsbophaan);
//    $num=mysqli_num_rows($qbp);
//    $dsbp=mysqli_fetch_assoc($qbp);
//    //
//    //
    $idsc=$_POST["id"];
    $name=$_POST["tensuco"];
    $mota=$_POST["mota"];
    $thongtin=$_POST["post_content"];
	$sp=$_POST["sophong"];
	$sm=$_POST["somay"];
	$tbh=$_POST["thietbihong"];
    $hoanthanh=$_POST["hoanthanh"];
//    $slqcv="SELECT suco.* FROM suco WHERE idsuco='$idsc'";
//    $resul=mysqli_query($conn,$slqcv);
//    $tenchucvu=mysqli_fetch_assoc($resul);
//    $nameCV=$tenchucvu["TenChucVu"];
//    $ngaysinh=$_POST["ngaysinh"];
//    $stt=$_POST["stt"]; // 1 hi???n 0 ???n
    $nvsql="UPDATE `suco` SET
        `tensuco`='$name',`motasuco`='$mota',`hinhanh`='$thongtin',`sophong`='$sp',`somay`='$sm',`thietbihong`='$tbh',
        `thoigianhoanthanh`='$hoanthanh' WHERE idsuco = '$idsc' ";
//    mysqli_query($conn,$nvsql);
//    $usql="UPDATE taikhoan SET `TRANGTHAI`=$stt,`CAPDO`=$chucvu, NgayUpDate= CURRENT_DATE WHERE MACB='$manv' ;";
    if(mysqli_query($conn,$nvsql)){
        $ero=0;
        header('Location: sua.php?id='.$idsc.'&eror='.$ero);
    }else {
        $ero=1;
        header('Location: sua.php?id='.$idsc.'&eror='.$ero);
    }


}

?>

<!DOCTYPE html>
<html>

<head>
    <title>H??? th???ng qu???n l?? Helpdesk</title>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
		
		<link rel="stylesheet" href="../public/css/stylePanel.css">
		<link rel="stylesheet" href="../public/css/menustyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../public/css/stylechitiet.css">
		<script src="../ckeditor/ckeditor.js"></script>


</head>

<body style="background: #FFFFFF; padding: 0px; margin: 0px;">
<div class="Container">
    <div class="row">
        <div id="header">
            <div id="webname"><div style="color: aqua; font-size: 40px; width: 800px;float: left">H??? th???ng qu???n l?? s??? c??? Helpdesk</div>
                <div id="header_icon">
                    <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Tho??t"></a></div>
                    <div id="logout" style="margin:0px; padding:0; "><a href="quanly.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang ch???"></a></div>
                    <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="content">
    <div id="menu">
        <ul>
<!--            <li><a href="Listuser.php">Li???t k??</a></li>-->
            <li><a href="themsuco.php"><b style="color:#fbf424;">Th??m m???i</b></a></li>
        </ul>
    </div>
    <h3 style="text-align: center">Ch???nh s???a s??? c???</h3>
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-10">
            <?php
            if(isset($_GET['eror'])){
                $error=$_GET['eror'];
                if($error==0 ){
                    echo '<div class="alert alert-success alert-dismissable">';
                    echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">??</a>';
                    echo   '<strong>Th??nh c??ng!</strong>Ch???nh s???a th??nh c??ng';
                    echo '</div>';}
                else if($error==1){
                    echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">??</a>
                    <strong>Th??m th???t b???i!</strong> C?? l???i khi ch???nh s???a
                  </div>';
                }
            }
            ?>
        </div>
        <div class="col-md-1"> </div>
    </div>
    <form action="sua.php" method="POST" id="formseddit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1"></div>
            <div class="col-md-4">
				<div class="form-group">

                    <label for="usr">ID</label>
                    <?php echo '<input type="text"  name="id" class="form-control" id="usr" value="'.$idsuco.'" readonly>';?>
                    <p class="text-danger" id="msg"></p>
                </div>
                <div class="form-group">

                    <label for="usr">T??n s??? c???</label>
                    <?php echo '<input type="text"  name="tensuco" class="form-control" id="usr" value="'.$tensuco.'" >';?>
                    <p class="text-danger" id="msg"></p>
                </div>
                <div class="form-group">
                    <label for="usr1">M?? t??? s??? c???</label>
                    <?php echo '<input type="text" name="mota" value="'.$motasuco.'" class="form-control" id="mota" placeholder="Nguy???n V??n A">';?>

                </div>
				<div class="form-group">
                    <label for="exampleInputEmail1">Th???i gian d??? ki???n ho??n th??nh</label>
                    <?php echo '<input type="date" name="hoanthanh" class="form-control" value="'.$thoigianhoanthanh.'" id="hoanthanh" placeholder="dd-mm-yyyy" readonly="">';?>
                </div>
				<div class="form-group">
                    <label for="usr">Ph??ng</label>
                    <select name="sophong" class="form-control" id="sel2">
                        <?php
                        $sql1='SELECT * FROM phongban;';
                        $result=mysqli_query($conn,$sql1);
                        while ($dscv=mysqli_fetch_array($result)){
                            if($dscv["ten"]==$sophong){
                                echo '<option value="'.$dscv["ten"].'" selected>'.$dscv["ten"].'</option>';
                            } else {
                                echo '<option value="'.$dscv["ten"].'">'.$dscv["ten"].'</option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                
				

            </div>
			
            <div class="col-md-4">
				
				<div class="form-group">

                    <label for="usr">S??? m??y</label>
                    <?php echo '<input type="text"  name="somay" class="form-control" id="usr" value="'.$somay.'" >';?>
                    <p class="text-danger" id="msg"></p>
                </div>
				<div class="form-group">
                    <label for="usr">Thi???t b??? h???ng</label>
                    <select name="thietbihong" class="form-control" id="sel2">
                      <?php
								if($thietbihong=="0"){
                                echo '<option value="'.$thietbihong.'" selected>M??y PC</option>';
								 echo '
								 
								
								  <option value="1">Laptop</option>
								  <option value="2">M??y t??nh b???ng</option>
								  <option value="3">??i???n tho???i</option>
								  <option value="4">M??y in</option>
								  <option value="5">M??y fax</option>
								';}
								elseif($thietbihong=="1"){
                                echo '<option value="'.$thietbihong.'" selected>Laptop</option>';
								echo '
								  <option value="0">M??y PC</option>
								
								  <option value="2">M??y t??nh b???ng</option>
								  <option value="3">??i???n tho???i</option>
								  <option value="4">M??y in</option>
								  <option value="5">M??y fax</option>
								';}
								elseif($thietbihong=="2"){
                                echo '<option value="'.$thietbihong.'" selected>M??y t??nh b???ng</option>'; 
								echo '
								   <option value="0">M??y PC</option>
								  <option value="1">Laptop</option>
							
								  <option value="3">??i???n tho???i</option>
								  <option value="4">M??y in</option>
								  <option value="5">M??y fax</option>
								';}
								elseif($thietbihong=="3"){
                                echo '<option value="'.$thietbihong.'" selected>??i???n tho???i</option>'; 
								echo '
								   <option value="0">M??y PC</option>
								  <option value="1">Laptop</option>
								  <option value="2">M??y t??nh b???ng</option>
							
								  <option value="4">M??y in</option>
								  <option value="5">M??y fax</option>
								';}
								elseif($thietbihong=="4"){
                                echo '<option value="'.$thietbihong.'" selected>M??y in</option>';
								echo '
								   <option value="0">M??y PC</option>
								  <option value="1">Laptop</option>
								  <option value="2">M??y t??nh b???ng</option>
								  <option value="3">??i???n tho???i</option>
							
								  <option value="5">M??y fax</option>
								';}
								elseif($thietbihong=="5"){
                                echo '<option value="'.$thietbihong.'" selected>M??y fax</option>';
								 echo '
								  <option value="0">M??y PC</option>
								  <option value="1">Laptop</option>
								  <option value="2">M??y t??nh b???ng</option>
								  <option value="3">??i???n tho???i</option>
								  <option value="4">M??y in</option>
							
								';}
								
									
								
							
                          

                        ?>
                    </select>
                </div>
				<div class="form-group">
                    <label for="exampleInputEmail1">Th??ng tin th??m</label>
                   <?php echo '<textarea name="post_content" id="post_content" placeholder="" class="form-control"  >'.$hinhanh.'</textarea>';?>
                </div>

                <input class="btn btn-success" name="btedit" type="submit" value="S???a ?????i">
                <a href="duyetsuco/duyetsuco.php" class="btn btn-primary">Quay l???i </a>
<!--                <a href="doimatkhau.php?id=<?php echo $macanbo; ?>" class="btn btn-primary">Thay ?????i m???t kh???u </a>-->
            </div>
        </div>

    </form>

</div>
  <?php include 'footer.php';?>

</body>
<!--
<script type="text/javascript">
    $.validator.addMethod("dateFormat",
        function(value, element) {
            return value.match(/^(\d{1,2})-(\d{1,2})-(\d{4})$/);
        },
        "Nh???p ????ng ?????nh d???ng dd-mm-yyyy.");
    $(function(){
        var validate = $("#formseddit").validate({
            rules :{
                tensuco :{
                    required :true,
                },
                motasuco :{
                    email:true,
                    required: true,
                },
                ngaysinh :{
                    dateFormat:true
                }
            },
            messages :{
                ten_nhan_vien :{
                    required:"Kh??ng ???????c b??? tr???ng",
                },
                email:{
                    email: "Nh???p sai ?????nh d???ng",
                    required: "????y l?? tr?????ng b???t bu???c"
                }

            }
        });

    });
</script>
-->
</html>
<script>
						var url = 'http://localhost/helpdesk';
							// Thay th??? <textarea id="post_content"> v???i CKEditor
							CKEDITOR.replace( 'post_content',{
								uiColor: '#9AB8F3',
								filebrowserBrowseUrl: url+'/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl: url+'/ckfinder/ckfinder.html?type=Images',
								filebrowserUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
							
								
							} );// tham s??? l?? bi???n name c???a textarea
						</script>