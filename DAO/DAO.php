<?php 
// Hàm đăng nhập
class SignUpContr {
    private $register_email;
    private $register_password;
    private $register_repassword;
    private $register_dob;
    private $register_sex;
    private $register_profile_image;

    public function __construct($register_email, $register_password, $register_repassword, $register_dob, $register_sex, $register_profile_image) {
        $this->register_email = $register_email;
        $this->register_password = $register_password;
        $this->register_repassword = $register_repassword;
        $this->register_dob = $register_dob;
        $this->register_sex = $register_sex;
        $this->register_profile_image = $register_profile_image;
    }

    private function empty_input() {
        $result = true;
        if (empty($this->register_email) || empty($this->register_password) || empty($this->register_repassword) || empty($this->register_dob) || empty($this->register_sex) || empty($this->register_profile_image)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail() {
        $result = true;
        if(!filter_var($this->register_email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch() {
        $result = true;
        if($this->register_password !== $this->register_repassword) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    
}
// function login($username, $password) {
//     $sql = "SELECT * FROM taikhoan WHERE Email = ? AND Password = ?";
//     return pdo_query($sql, $username, $password);
// }

// function register($username, $password, $fullname, $phone_number, $date_of_birth) {
//     $sql = "INSERT INTO taikhoan(Email, MatKhau, TenDayDu, SoDienThoai, NgaySinh)";
//     pdo_execute($sql, $username, $password, $fullname, $phone_number, $date_of_birth);
// }

// function forgotPassword($username) {
    
// }
?>