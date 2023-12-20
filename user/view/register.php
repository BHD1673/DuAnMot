<?php 
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
    
}

if(isset($_POST["submit"])) {
    $register_email = $_POST["email"];
    $register_password = $_POST['password'];
    $register_repassword = $_POST['repassword'];
    $register_dob = $_POST['dob'];
    $register_sex = $_POST['sex'];
    $register_profile_image = $_POST['profile_image'];

}

?>
<div class="container mt-5">
    <h2>Registration Form</h2>
    <form>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                required>
        </div>
        <div class="form-group">
            <label for="repassword">Confirm Password:</label>
            <input type="password" class="form-control" id="repassword" name="repassword"
                placeholder="Confirm your password" required>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <div class="form-group">
            <label for="sex">Sex:</label>
            <select class="form-control" id="sex" name=sex required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Profile Image:</label>
            <input type="file" class="form-control-file" id="image" name="profile_image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>