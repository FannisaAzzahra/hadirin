<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | outcome such as failure due to an invalid password / reset token.
    |
    */

    'reset' => 'Kata sandi Anda telah direset.',
    'sent' => 'Kami telah mengirimkan tautan reset kata sandi ke alamat email Anda.',
    'throttled' => 'Harap tunggu sebelum mencoba lagi.',
    'token' => 'Token reset kata sandi ini tidak valid.',
    'user' => "Kami tidak dapat menemukan pengguna dengan alamat email tersebut.",

    // === TAMBAHKAN BARIS-BARIS INI UNTUK EMAIL RESET PASSWORD ===
    // Ini adalah teks yang muncul di dalam email
    'reset_password_notification_text' => 'Anda menerima email ini karena kami menerima permintaan reset kata sandi untuk akun Anda.',
    'reset_password_expiration_text' => 'Tautan reset kata sandi ini akan kedaluwarsa dalam :count menit.',
    'reset_password_action_text' => 'Reset Kata Sandi', // Ini untuk teks tombol
    'reset_password_subcopy_text' => 'Jika Anda mengalami kesulitan dalam mengklik tombol ":actionText", silakan salin dan tempelkan tautan berikut ini ke dalam browser web Anda:',
    // 'reset_password_salutation' => 'Hormat kami,', // Opsional, jika Anda mau override salutation dari email.blade.php
    // 'reset_password_greeting' => 'Halo!', // Opsional, jika Anda mau override greeting dari email.blade.php
];