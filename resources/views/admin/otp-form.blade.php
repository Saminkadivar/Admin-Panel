<form action="{{ route('admin.verify.otp') }}" method="POST">
    @csrf
    <input type="number" name="otp" required placeholder="Enter OTP">
    <button type="submit">Login</button>
</form>
