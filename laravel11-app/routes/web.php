<?php

use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register-process', function (Request $request) {
    NguoiDung::create([
        'ten_tk' => $request->input('ten_tk'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')), // Hash mật khẩu
    ]);

    return redirect('/login.html'); // Chuyển hướng sau khi đăng ký thành công
});

Route::post('/login-process', function (Request $request) {
    $user = NguoiDung::where('email', $request->input('email'))->first();

    if ($user && Hash::check($request->input('password'), $user->password)) {
        return redirect('/list.html'); // Chuyển hướng sau khi đăng nhập thành công
    } else {
        return 'Sai email hoặc mật khẩu!';
    }
});

Route::get('/api/account/{id}', function ($id) {
    $account = App\Models\NguoiDung::find($id);
    if ($account) {
        return response()->json($account);
    } else {
        return response()->json(['message' => 'Tài khoản không tồn tại'], 404);
    }
});

Route::delete('/api/account/{id}', function ($id) {
    $account = App\Models\NguoiDung::find($id);
    if ($account) {
        $account->delete();
        return response()->json(['message' => 'Tài khoản đã được xóa!']);
    }
    return response()->json(['message' => 'Tài khoản không tồn tại!'], 404);
});

Route::get('/api/accounts', function () {
    return response()->json(NguoiDung::all());
});

Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

Route::put('/api/account/{id}', function (Request $request, $id) {
    $account = App\Models\NguoiDung::find($id);
    if ($account) {
        $account->ten_tk = $request->input('ten_tk');
        $account->email = $request->input('email');
        $account->save();

        return response()->json(['message' => 'Cập nhật thành công!'], 200);
    }
    return response()->json(['message' => 'Tài khoản không tồn tại!'], 404);
});

Route::get('/api/accounts', function (Request $request) {
    $perPage = $request->input('per_page', 10); // Số lượng tài khoản mỗi trang (mặc định là 10)
    $accounts = App\Models\NguoiDung::paginate($perPage);

    return response()->json($accounts);
});

