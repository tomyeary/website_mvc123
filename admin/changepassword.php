<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/session.php');
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
 ?> 
<?php
    if (isset($_POST['submit'])){
        $matkhaucu=$_POST['password'];
        $matkhaumoi=$_POST['newpassword'];
        $sql_doimatkhau = "SELECT * FROM tbl_admin WHERE adminPass = '$matkhaucu' LIMIT 1";
        $result = $this->db->select($sql_doimatkhau);
        $get_rows=mysqli_num_rows($sql_doimatkhau);
        if ($get_rows==0){
                
                        $alert = "Sai tài khoản hoặc mật khẩu xin hãy điển lại!";
                        return $alert;
            }else{
                $sql_capnhap="UPDATE tbl_admin set adminPass='$matkhaumoi'";
                 $result = $this->db->update($sql_capnhap);
                        $alert = "Bạn đã thay đổi mật khẩu!";
                        return $alert;
                }
        
        }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">               
         <form>
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="password" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpassword" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>