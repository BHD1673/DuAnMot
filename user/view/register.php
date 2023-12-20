<div class="container mt-5">
    <h2>Registration Form</h2>
    <form method="post" action="" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" >
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <label for="repassword">Confirm Password:</label>
            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirm your password">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>
        <div class="form-group">
            <label for="sex">Sex:</label>
            <select class="form-control" id="sex" name=sex>
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