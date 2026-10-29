<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login SIPUS-Del.
     * Cookie `del_last_user_email` digunakan untuk mengisi otomatis email di form (FITUR 3).
     */
    public function showLogin(Request $request): View
    {
        $lastEmail = $request->cookie('del_last_user_email', '');
        return view('auth.login', compact('lastEmail'));
    }

    /**
     * Memproses autentikasi pengguna menggunakan CIS Mock atau akun admin lokal.
     *
     * Alur autentikasi:
     * 1. Validasi input email dan password.
     * 2. Cek apakah email terdaftar sebagai admin (pustakawan/admin lokal).
     * 3. Jika bukan admin, cek sebagai mahasiswa via CIS mock (email @del.ac.id).
     * 4. Jika CIS mock aktif dan user belum terdaftar, buat akun mahasiswa baru otomatis.
     * 5. Setelah login berhasil, regenerasi ID sesi (cegah Session Fixation Attack).
     * 6. Simpan cookie `del_last_user_email` dengan flag HttpOnly dan SameSite=Lax.
     * 7. Simpan timestamp login di session untuk ditampilkan di navbar.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        $email = strtolower(trim($request->input('email')));
        $password = $request->input('password');
        $remember = $request->boolean('remember');
        $rememberEmail = $request->boolean('remember_email');

        // Langkah 1: Coba autentikasi dengan akun yang sudah ada di database
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // Regenerasi ID sesi untuk mencegah Session Fixation Attack (FITUR S4)
            $request->session()->regenerate();

            // Simpan timestamp login di session (FITUR 3)
            $request->session()->put('login_timestamp', now()->format('d M Y, H:i'));

            // Simpan cookie email terakhir dengan HttpOnly dan SameSite=Lax (FITUR S4)
            $this->queueLastEmailCookie($email, $rememberEmail);

            Log::info("[Login Berhasil] User {$email} (role: " . Auth::user()->role . ") berhasil login.");

            return Auth::user()->role === 'admin'
                ? redirect()->intended(route('admin.dashboard'))
                : redirect()->intended(route('katalog.index'));
        }

        // Langkah 2: Jika gagal dan CIS mode mock aktif, coba buat akun mahasiswa baru
        $cisMode = config('perpustakaan.cis_auth_mode', 'mock');

        if ($cisMode === 'mock' && str_ends_with($email, '@del.ac.id')) {
            // Cek apakah email ini BUKAN email admin
            $adminEmails = config('perpustakaan.admin_emails', []);
            if (in_array($email, $adminEmails)) {
                // Email admin tapi password salah
                Log::warning("[Login Gagal] Percobaan login admin dengan password salah: {$email}");
                return back()->withInput($request->only('email'))
                    ->with('error', 'Kredensial tidak valid. Periksa kembali email dan kata sandi Anda.');
            }

            // CIS Mock: Buat akun mahasiswa baru otomatis
            // Hanya peran mahasiswa yang dapat dibuat otomatis (keamanan Tahap 2)
            $nameParts = explode('@', $email);
            $nameFormatted = ucwords(str_replace('.', ' ', $nameParts[0]));

            // Cari atau buat NIM dari format email (mock)
            $nimBase = strtoupper(substr(md5($email), 0, 7));
            $nimMock = '12S' . $nimBase;

            $user = User::create([
                'name' => $nameFormatted,
                'email' => $email,
                'nim' => $nimMock,
                'role' => 'mahasiswa',
                'password' => Hash::make($password),
            ]);

            Auth::login($user, $remember);

            // Regenerasi ID sesi
            $request->session()->regenerate();
            $request->session()->put('login_timestamp', now()->format('d M Y, H:i'));
            $this->queueLastEmailCookie($email, $rememberEmail);

            Log::info("[CIS Mock] Akun mahasiswa baru dibuat: {$email} (NIM: {$nimMock})");

            return redirect()->intended(route('katalog.index'))
                ->with('success', "Selamat datang, {$nameFormatted}! Akun Anda telah dibuat secara otomatis melalui sistem CIS.");
        }

        // Login gagal
        Log::warning("[Login Gagal] Percobaan login gagal untuk email: {$email}");
        return back()->withInput($request->only('email'))
            ->with('error', 'Kredensial tidak valid. Periksa kembali email dan kata sandi Anda.');
    }

    /**
     * Memproses logout pengguna.
     *
     * Prosedur keamanan saat logout:
     * 1. Auth::logout() — mengosongkan data autentikasi.
     * 2. session()->invalidate() — menghapus seluruh data sesi dari database.
     * 3. session()->regenerateToken() — mengacak ulang token CSRF.
     */
    public function logout(Request $request): RedirectResponse
    {
        $userName = Auth::user()?->name ?? 'Unknown';

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info("[Logout] User {$userName} berhasil logout.");

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    /**
     * Mengantrekan cookie email terakhir login dengan flag keamanan.
     *
     * @param string $email Email yang akan disimpan di cookie
     * @param bool $remember Apakah pengguna memilih "Ingat email saya"
     */
    private function queueLastEmailCookie(string $email, bool $remember): void
    {
        if ($remember) {
            Cookie::queue(
                'del_last_user_email',
                $email,
                10080, // Durasi 7 hari (dalam menit)
                '/',
                null,
                false,  // secure=false pada localhost/http
                true,   // HttpOnly = true (cegah akses JavaScript / XSS)
                false,
                'lax'   // SameSite = lax (cegah CSRF cross-site)
            );
        }
    }
}
