<?php
       session_start();
//	if (isset($_SESSION['idtaikhoan'])) {
//		$taikhoan = $_SESSION['idtaikhoan'];
//	  }
    $id=$_SESSION['idtaikhoan'];
    require ('../../conn.php');
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
	$trangthai = 0;
 	$sqluser="SELECT suco.*,trangthai FROM suco,trangthai
              WHERE trangthai.idtrangthai=suco.trangthaiduyet";
    $queryuser=mysqli_query($conn,$sqluser);
	$kq=$conn->query($sqluser);
    $row1= $kq->fetch_assoc();
	$idsuco = $row1['idsuco'];
	$i=1;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Hệ thống quản lý sự cố Helpdesk</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
		<link rel="stylesheet" href="../../public/css/stylePanel.css">
		<link rel="stylesheet" href="../../public/css/menustyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../public/css/bootstrap.min.css">    
		<link rel="stylesheet" href="../../public/css/stylechitiet.css">
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<link  rel="stylesheet"  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link  rel="stylesheet"  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link  rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<!--
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../public/css/menustyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../public/css/stylechitiet.css">
-->
		<style>
			td img{
				width: 100px;
				height: 50px;
			}
		</style>
    </head>

    <body style="background: #fffff; padding: 0px; margin: 0px;">
        <div class="Container">
            <div class="row">
                <div id="header">
                    <div id="webname">
						<div style="color: aqua; font-size: 40px;float: left;width: 800px;">Hệ thống quản lý sự cố Helpdesk</div>
                        <div id="header_icon">
                            <div id="home">
                                <a href="../../logout.php"><img src="../../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin:0px; padding:0; ">
                                <a href="../nhanvien.php"><img src="../../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="content">
            <div id="menu">
                <ul>
<!--                    <li><a href="Listuser.php">Liệt kê</a></li>-->
                    <li><a href="../themsuco/themsuco.php"><b style="color:#fbf424;">Thêm mới</b></a></li>
                </ul>
            </div>
            <div style="text-align: center">
                <h2>Danh sách sự cố</h2>
            </div>
            <div id="table">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead >
                        <tr align="center">
                            <th width="5%">STT</th>
                            <th width="12%" >Tên sự cố</th>
                            <th width="10%">Mô tả sự cố</th>
							<th width="8%">Phòng</th>
							<th width="5%">Số máy</th>
							<th width="5%" >Thiết bị hỏng</th>
							<th width="15%" >Thông tin thêm</th>
							<th width="15%">Ngày tạo</th>
							<th width="15%">Ngày dự kiến hoàn thành</th>
<!--							<th width="11%">Xem chi tiet</th>-->
                            <th width="8%" >Trạng thái</th>
<!--                            <th>Hành động</th>-->
                           
						
							<th width="8%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($userList=mysqli_fetch_array($queryuser)){
                      echo  '<tr class="odd gradeX" align="center" height="100px">';
                      echo  '<td > '.$i++.'</td>';
                      echo  '<td >'.$userList["tensuco"].'</td>';
                      echo  '<td >'.$userList["motasuco"].'</td>';
					  echo  '<td >'.$userList["sophong"].'</td>';
					  echo  '<td >'.$userList["somay"].'</td>';
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
					  echo  '<td >'.$userList["hinhanh"].'</td>';
					  echo  '<td>'.$userList["thoigianyeucau"].'</td>';
					  echo  '<td>'.$userList["thoigianhoanthanh"].'</td>';
//						$hinhanh=../../themsuco/.$userList;
//						echo '<td>'.'<img src="../themsuco/'.$userList["hinhanh"].'"  width=40px height=20px/>'.'</td>';
						
//						echo  '<td width=40px height=20px>'.'<a href="xemchitiet('.$idsuco.')">'.'Xem chi tiet'.'</a>'.'</td>';
                      echo  '<td >'.$userList["trangthai"].'</td>';
//                      echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="del.php?id='.$userList["MATK"].'" onclick="return confirmAction()"> Delete</a>
//                                <i class="fa fa-pencil fa-fw"></i> <a href="edituser.php?id='.$userList["MACB"].'">Edit</a></td>';
                      
						if($userList["trangthai"]=="Chưa duyệt")
						echo '<td > <i class="fa fa-pencil fa-fw"></i> <a href="../sua.php?id='.$userList["idsuco"].'">Sửa</a></td>';
						else
						echo '<td>Không thể sửa</td>';
                        echo '</tr>';
                    }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
  <!--      <link rel="stylesheet" type="text/css" href="../../public/DataTables/datatables.min.css"/>
        <script src="../../public/jQuery/jquery-3.2.1.min.js"></script>
       <script type="text/javascript" src="../../public/DataTables/datatables.min.js"></script>-->
<!--
		 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js">
        </script>
-->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
					 initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            }
			);
        },
                    
                });
            });

        </script>
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn xóa tài khoản này")
            }

        </SCRIPT>
        <?php include '../footer.php';?>

		
         
    </html>
