<x-app-layout>
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    
    <h2 class="forgot-password-title" id="title">Xác nhận email</h2>
    <form action="{{ route('users.resetpassword') }}" method="post">
    @csrf
        <p id="content">Vui lòng nhập email của bạn!</p>
        @csrf
        <input type="email" name="email" class="email" placeholder="Nhập email">
        <button type="submit" name="submit">Xác nhận</button>
    </form>
<style>
    /* General body and layout styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f7f6;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Aligns items to the top of the screen */
    height: 100vh;
    box-sizing: border-box; /* Ensures padding and margin are accounted for in the layout */
    padding-top: 50px; /* Adds space from the top of the screen */
}

/* Title styling */
.forgot-password-title {
    font-size: 2rem;
    color: #004d40;
    text-align: center;
    margin-bottom: 20px;
}

/* Content styling */
#content {
    text-align: center;
    font-size: 1rem;
    color: #555;
    margin-bottom: 20px;
}

/* Form styling */
form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px; /* Ensures the form doesn't get too wide */
    margin: 0;
    text-align: left;
}

/* Input field styling */
input[type="email"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 1rem;
    color: #333;
    transition: border-color 0.3s;
}

input[type="email"]:focus {
    border-color: #00796b;
    outline: none;
}

/* Button styling */
button {
    background-color: #00796b;
    color: white;
    padding: 12px;
    border-radius: 5px;
    font-size: 1rem;
    width: 100%;
    cursor: pointer;
    transition: background-color 0.3s;
    border: none;
}

button:hover {
    background-color: #004d40;
}

/* Error message styling */
p {
    font-size: 1rem;
    color: #d32f2f;
    text-align: center;
    margin-top: 10px;
}

</style>
        


    </x-app-layout>