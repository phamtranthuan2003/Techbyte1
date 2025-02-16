<x-app-layout>
  
    <h2 class="forgot-password-title" id="title">Đặt lại mật khẩu</h2>
    <form action="{{ route('users.updatepassword', $user->id) }}" method="post">
    @csrf
        
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" class="email" placeholder="Nhập mật khẩu">

        <label for="re-password">Nhập lại mật khẩu</label>
        <input type="password" id="re-password" name="password"  class="email" placeholder="Nhập lại mật khẩu">
    

        <button type="submit">Xác nhận</button>
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
    align-items: flex-start;
    height: 100vh;
    padding-top: 50px; /* Adjusting the space at the top */
    box-sizing: border-box;
}

/* Title styling */
.forgot-password-title {
    font-size: 2rem;
    color: #004d40;
    text-align: center;
    margin-bottom: 20px;
}

/* Form styling */
form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px; /* Ensures form doesn't get too wide */
    margin: 0;
    text-align: left;
}

/* Label styling */
label {
    font-size: 1rem;
    color: #004d40;
    margin-bottom: 8px;
    display: block;
}

/* Input field styling */
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 1rem;
    color: #333;
    transition: border-color 0.3s;
}

input[type="password"]:focus {
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