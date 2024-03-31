<x-app-layout>
    <div class="login-panel">
        <x-page-title class="mb-6">LOGIN</x-page-title>

        <label for="email" class="mb-2">Email</label>
        <input type="text" name="email" id="email" class="mb-4">

        <label for="password" class="mb-2">Password</label>
        <input type="password" name="password" id="password" class="mb-4">

        <label for="user-type" class="mb-2">User Type</label>
        <select name="userType" id="user-type" class="mb-8">
            <option value="platinum" selected>Platinum</option>
            <option value="crmp">CRMP</option>
            <option value="mentor">Mentor</option>
            <option value="admin">Admin</option>
        </select>

        <button class="btn btn-primary mb-2">
            Login
        </button>
        <button class="btn btn-danger">
            Forget Password
        </button>
    </div>
</x-app-layout>

