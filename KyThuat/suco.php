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
 	$sqluser="SELECT suco.*,trangthai.trangthai FROM suco,trangthai,giaiquyet
	WHERE suco.trangthaiduyet=trangthai.idtrangthai 
	and (trangthai.idtrangthai=2 or trangthai.idtrangthai=3)
	and suco.idsuco=giaiquyet.id
	and giaiquyet.nguoigiaiquyet=$Mnv";
    $queryuser=mysqli_query($conn,$sqluser);
	$kq=$conn->query($sqluser);
    $row1= $kq->fetch_assoc();
	$idsuco = $row1['idsuco'];
	$i=1;
?>
    <!DOCTYPE html>
    <html >

    <head>
        <title>Hệ thống quản lý sự cố Helpdesk</title>
        <meta charset="UTF-8">
<!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
-->
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../public/css/stylechitiet.css">
		<link rel="stylesheet" href="../public/css/menustyle.css">
		<script src="../ckeditor/ckeditor.js"></script>
    </head>

    <body style="background: #fffff; padding: 0px; margin: 0px;">
        <div class="Container">
            <div class="row">
                <div id="header">
                    <div id="webname">
						<div style="color: aqua; font-size: 40px; width: 800px;float: left;">Hệ thống quản lý sự cố Helpdesk</div>
                        <div id="header_icon">
                            <div id="home">
                                <a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin:0px; padding:0; ">
                                <a href="kythuat.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div id="menu">
                <ul>
<!--
                    <li><a href="Listuser.php">Liệt kê</a></li>
                    <li><a href="themsuco.php">Thêm mới</a></li>
-->
                </ul>
            </div>
            <div style="text-align: center">
                <h2>Danh sách sự cố</h2>
            </div>
			<form method="get">
            <div id="table" style="margin: auto;width: 1100px;">
                <table border="1px" class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr align="center">
                            <th width="5%">STT</th>
                            <th width="12%">Tên sự cố</th>
                            <th width="16%">Mô tả sự cố</th>
							<th width="12%">Phòng</th>
							<th width="9%">Số máy</th>
								<th >Thiết bị hỏng</th>
							<th width="14%">Thông tin</th>
							<th width="18%">Ngày tạo</th>
							<th width="18%">Ngày dự kiến hoàn thành</th>
<!--							<th width="11%">Thao tác</th>-->
                            <th width="14%">Trạng thái</th>
<!--                            <th>Hành động</th>-->
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($userList=mysqli_fetch_array($queryuser)){
                      echo  '<tr class="odd gradeX" align="center" height="100px">';
                      echo  '<td>'.$i++.'</td>';
                      echo  '<td>'.$userList["tensuco"].'</td>';
                      echo  '<td>'.$userList["motasuco"].'</td>';
						echo  '<td>'.$userList["sophong"].'</td>';
						echo  '<td>'.$userList["somay"].'</td>';
						 if($userList["thietbihong"]=="0")
					  echo  '<td >Máy PC</td>';
					elseif($userList["thietbihong"]=="1")
					 echo  '<td >Laptop</td>';
					 elseif($userList["thietbihong"]=="2")
					 echo  '<td >Máy tính bảng</td>';
					  elseif($userList["thietbihong"]=="3")
					 echo  '<td >Điện thoại</td>';
					  elseif($userList["thietbihong"]=="4")
					 echo  '<td >Máy in</td>';
					  elseif($userList["thietbihong"]=="5")
					 echo  '<td >Máy fax</td>';
						echo  '<td>'.$userList["hinhanh"].'</td>';
						 echo  '<td>'.$userList["thoigianyeucau"].'</td>';
						  echo  '<td>'.$userList["thoigianhoanthanh"].'</td>';
//						$hinhanh=../../themsuco/.$userList;
//						echo '<td>'.'<img src="../NhanVien/themsuco/'.$userList["hinhanh"].'"  width=40px height=20px/>'.'</td>';
//						echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="del.php?id='.$userList["idsuco"].'" onclick="return confirmAction()"> Delete</a>
//                                <i class="fa fa-pencil fa-fw"></i> <a href="../edituser.php?id='.$userList["idsuco"].'">Edit</a></td>';
						echo '<td><a href="sucocanxuly.php?id='.$userList["idsuco"].'" class="btn btn-primary" >'.$userList["trangthai"].'</a></td>';
                    //  echo  '<td>'.$userList["trangthai"].'</td>';
                   
                        echo '</tr>';
                    }
                      ?>
                    </tbody>
                </table>
            </div>
		</form>
        </div>
        <link rel="stylesheet" type="text/css" href="../public/DataTables/datatables.min.css" />
        <script src="../public/jQuery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../public/DataTables/datatables.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    order: [
                        [0, 'asc']
                    ],
                    'language': {
                        'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ nhân viên',
                        'lengthMenu': "Hiển thị _MENU_ nhân viên",
                        "emptyTable": "Không có dữ liệu trong bảng",
                        "paginate": {
                            "previous": "Trước",
                            "next": "Sau",
                            "infoEmpty": "Không có dữ liệu"

                        },
                        "search": "Lọc / Tìm kiếm:"
                    },
                });
            });

        </script>
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn xóa tài khoảng này")
            }

        </SCRIPT>
       <?php include 'footer.php';?>
    </body>

    </html>
