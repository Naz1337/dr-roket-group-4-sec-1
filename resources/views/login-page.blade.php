<x-app-layout>
    <div class="login-panel">
        <x-page-title class="mb-6">LOGIN</x-page-title>

        <div class="col-7">
            <label for="email" class="mb-2">Email</label>
            <input type="text" name="email" id="email" class="mb-4 form-control col-md-4">

            <label for="password" class="mb-2">Password</label>
            <input type="password" name="password" id="password" class="mb-4 form-control">
        </div>
        

        <!-- <label for="user-type" class="mb-2">User Type</label>
        <select name="userType" id="user-type" class="mb-8">
            <option value="platinum" selected>Platinum</option>
            <option value="crmp">CRMP</option>
            <option value="mentor">Mentor</option>
            <option value="admin">Admin</option>
        </select> -->

        <a href="/expert/myexpert" class="login-btn btn btn-primary mb-2">
            Login
        </a>
        <a class="login-btn btn btn-danger mb-2">
            Forget Password
        </a>
    </div>
</x-app-layout>

