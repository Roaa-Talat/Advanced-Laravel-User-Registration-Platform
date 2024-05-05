@extends('layout\master')

@section('content')
    <div class="big-content">
        <div class="container" style="margin: auto;">
            <h1 class="title">Registration Form</h1>
            <div class="content">
                <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
                    @csrf
                    <div class="profile-picture" onclick="document.getElementById('userImage').click()" style="position:relative;">
                        <span class="placeholder-text" id="chooseImageText">Click to choose an image</span>
                        <input type="file" name="userImage" id="userImage" accept="image/png, image/jpeg" onchange="previewImage()" style="display:none;">
                        <img id="imagePreview" src="{{ asset('user.png') }}" style="position:absolute;width:100%">
                    </div>
                    <div class="user-details">
                        <div class="input-box">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="name" id="fullname" placeholder="Enter your name" value="{{ old('fullName') }}" required>
                        </div>
                        <div class="input-box">
                            <label for="username">Username</label>
                            <input type="text" name="user_name" id="username" placeholder="Enter your username" required>
                        </div>
                        <div class="input-box">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required>
                            <p class="d-none birthdate-error-msg"></p>
                            <div class="tooltip">
                                <input type="button" value="List" name="show_names" id="show_names_button">
                                <span class="tooltiptext">Show the list with actors' names born on the same day</span>
                            </div>
                        </div>
                        <div class="input-box">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                            <p class="d-none mail-error-msg"></p>
                        </div>
                        <div class="input-box">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" name="phone" id="phoneNumber" placeholder="Enter your phone number" value="{{ old('phoneNumber') }}" required>
                            <p class="d-none phone-error-msg"></p>
                        </div>
                        <div class="input-box">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" placeholder="Enter your address" value="{{ old('address') }}" required>
                        </div>
                        <div class="input-box">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" value="{{ old('password') }}" required>
                            <p class="d-none password-error-msg"></p>
                        </div>
                        <div class="input-box">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password" value="{{ old('confirmPassword') }}" required>
                            <p class="d-none confirm-password-error-msg"></p>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Register" name="register">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
