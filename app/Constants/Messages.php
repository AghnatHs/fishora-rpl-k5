<?php

namespace App\Constants;

class Messages
{
    public const WRONG_CREDENTIALS = 'Invalid credentials. Ensure your email and password is correct.';
    public const TOO_MANY_ATTEMPTS = 'Too many login attempts. Please try again in later.';

    public const RESET_PASSWORD_LINK_SENT = 'Password request send to email. Kindly check your email.';
    public const SUCCESS_RESET_PASSWORD = 'Password successfully reset. Please login using new password.'; 
    public const TOO_MANY_ATTEMPTS_RESET_PASSWORD = 'Too many reset password request attempts. Please try again in later.';
}
