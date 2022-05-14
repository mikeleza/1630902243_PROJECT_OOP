<?php

    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'register_oop');

    class DB_con{
        function __construct(){
            $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: ". mysqli_connect_error();
            } 
        }

        public function usernameavailable($uname){
            $checkuser = mysqli_query($this->dbcon, "SELECT username FROM tbleusers WHERE username = '$uname'");
            return $checkuser;
        }


        public function registration($uname,$password,$uemail,$role){
            $reg = mysqli_query($this->dbcon, "INSERT INTO tbleusers(username, password, email, role) VALUES ('$uname','$password','$uemail','$role')");
             return $reg;
        }

        public function login($uname,$password){
            $login = mysqli_query($this->dbcon, "SELECT role,id,username,image FROM tbleusers WHERE username = '$uname' AND password = '$password'");
             return $login;
        }

        public function insertbook($bookname,$author,$publisher,$category,$details,$score,$price,$stock,$image_file){
            $inserbook = mysqli_query($this->dbcon, "INSERT INTO tblebooks(bookname,author,publisher,category,details,score,price,stock,image) VALUES ('$bookname','$author','$publisher','$category','$details','$score','$price','$stock','$image_file')");
             return $inserbook;
        }

        public function fetchdata() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblebooks");
            return $result;
        }

        public function fetchdatauser() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbleusers WHERE role = 'user'");
            return $result;
        }

        public function runQuery($query){
            $result = mysqli_query($this->dbcon, $query);

            while($row = mysqli_fetch_assoc($result)){
                $resultset[] = $row;
            }
            if(!empty($resultset))
            return $resultset;
        }

        public function numRows($query){
            $result = mysqli_query($this->dbcon, $query);
            $rowcount = mysqli_num_rows($result);
            return $rowcount;
        }

        public function fetchonerecord($uid){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbleusers WHERE id = '$uid'");
            return $result;
        }

        public function fetchonebook($uid){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblebooks INNER JOIN cbook ON tblebooks.category = cbook.cid WHERE tblebooks.ID = '$uid'");
            return $result;
        }

        public function fetchcate($cate){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblebooks INNER JOIN cbook ON tblebooks.category = cbook.cid WHERE cbook.cid = '$cate'");
            return $result;
        }

        public function fetchbkc($cate,$uid){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblebooks INNER JOIN cbook ON tblebooks.category = cbook.cid WHERE tblebooks.ID = '$uid'");
            return $result;
        }

        public function updateuser($fname,$lname,$email,$phone,$address,$twitter,$instagram,$facebook,$uid,$image_file){
            $result = mysqli_query($this->dbcon, "UPDATE tbleusers SET
                firstname = '$fname',
                lastname = '$lname',
                email = '$email',
                phone = '$phone',
                address = '$address',
                twitter = '$twitter',
                Instagram = '$instagram',
                facebook = '$facebook',
                image = '$image_file'
                WHERE id = '$uid'
            ");
        }

        public function updatebook($bookname,$author,$publisher,$category,$details,$score,$price,$stock,$image_file,$uid){
            $result = mysqli_query($this->dbcon, "UPDATE tblebooks SET
                bookname = '$bookname',
                author = '$author',
                publisher = '$publisher',
                category = '$category',
                details = '$details',
                score = '$score',
                price = '$price',
                stock = '$stock',
                image = '$image_file'
                WHERE ID = '$uid'
            ");
        }

        public function deleteuser($uid){
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbleusers WHERE id = '$uid'");
            return $deleterecord;
        }

        public function deletebook($uid){
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tblebooks WHERE id = '$uid'");
            return $deleterecord;
        }

    }
?>
