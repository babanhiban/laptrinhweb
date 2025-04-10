<!-- Tạo controller trong Controller laravel -->
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->has('rememberMe');

        $user = DB::table('users')->where('user_name', $username)->first();

        if ($user && password_verify($password, $user->user_password)) {
            Session::put('user_id', $user->user_id);
            Session::put('user_name', $user->user_name);

            if ($remember) {
                Cookie::queue('username', $user->user_name, 43200); // 30 ngày
                Cookie::queue('user_id', $user->user_id, 43200);
            }

            return redirect('list');
        } else {
            return back()->with('error', $user ? '⚠ Sai mật khẩu!' : '⚠ Tài khoản không tồn tại!')
                         ->withInput();
        }
    }
}
