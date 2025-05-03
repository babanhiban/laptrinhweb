namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|string|min:6',
            'confirm-password' => 'required|same:password',
        ], [
            'confirm-password.same' => 'Mật khẩu không khớp!',
            'email.unique' => 'Email đã tồn tại!',
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $hashedPassword = Hash::make($request->input('password'));

        $inserted = DB::table('users')->insert([
            'user_name' => $username,
            'user_email' => $email,
            'user_password' => $hashedPassword,
            'create_at' => now()
        ]);

        if ($inserted) {
            return redirect()->route('login')->with('success', 'Đăng ký thành công!');
        } else {
            return back()->with('error', 'Đăng ký thất bại. Vui lòng thử lại!')->withInput();
        }
    }
}
