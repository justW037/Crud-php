<?php
    class User {
        private $conn;
        public function __construct($conn)
        {   
            $this->conn = $conn;
        }
        public function login($username , $password) {
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($this->conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $username;

                echo "đăng nhập thành công";
                if ($row['level'] == 2) {
                    $_SESSION['level'] = 2;
                header("Location: index.php"); 
                } else {
                    header("Location: userPage.php");
                }
            } else {
                echo "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
        }
        public function layDanhSachNguoiDung() {
            $sql = "SELECT * FROM users ORDER BY id";
            $query = mysqli_query($this->conn, $sql);
            $nguoiDungList = array();

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $nguoiDungList[] = $row;
                }
            } else {
                echo "<tr>
                        <td colspan='7'>Không có người dùng nào</td>
                    </tr>";
            }
            return $nguoiDungList;
        }
        public function checkTontai($username) {
            $sql = "SELECT id FROM users WHERE username = '$username'";
            $query = mysqli_query($this->conn, $sql);
            if(mysqli_num_rows($query) > 0) {
                return true;
            }
        }
        public function themNguoiDung($username,$password,$level) {
            $sql = "INSERT INTO users(username,password,level) VALUES ('$username','$password','$level')";
            $query = mysqli_query($this->conn, $sql);
            return $query;
        }
        public function layNguoiDung($id){
            $sql = "SELECT * FROM users WHERE id = '$id'";
            $query = mysqli_query($this->conn, $sql);
            return mysqli_fetch_array($query);
        }
        public function suaNguoiDung($id,$username,$password,$level) {
            $sql = "UPDATE users SET username = '$username' , password = '$password' , level = '$level' WHERE id = '$id'";
            $query = mysqli_query($this->conn, $sql);
            return $query;
        }
        public function xoaNguoiDung($id){
            $sql= "DELETE FROM users WHERE id='$id'";
            $query= mysqli_query($this->conn, $sql);
            return $query;
        }
    }
?>