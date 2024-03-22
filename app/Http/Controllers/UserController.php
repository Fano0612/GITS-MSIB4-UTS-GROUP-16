<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use App\Models\GeneralManagerOperasional;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;




class UserController extends Controller
{
    public function register()
    {
        $data['title'] = "Register";
        return view('register', $data);
    }

    public function registerstaff()
    {
        $data['title'] = "Register Karyawan";
        return view('registerkaryawan', $data);
    }

    public function registeracc(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:karyawan,email|unique:pelanggan,email|unique:generalmanageroperasional,email',
            'nama' => 'required',
            'nomor_telepon' => 'required|unique:karyawan,nomor_telepon|unique:pelanggan,nomor_telepon|unique:generalmanageroperasional,nomor_telepon',
            'username' => 'required|unique:karyawan,username|unique:pelanggan,username|unique:generalmanageroperasional,username',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.required' => 'Email kosong, silakan memasukkan alamat email!',
            'email.unique' => 'Email terdaftar, silakan pilih Email yang lain!',
            'nama.required' => 'Nama kosong, silakan memasukkan Nama!',
            'nomor_telepon.required' => 'Nomor Telepon kosong, silakan memasukkan Nomor Telepon!',
            'nomor_telepon.unique' => 'Nomor Telepon terdaftar, silakan pilih Nomor Telepon yang lain!',
            'username.required' => 'Username kosong, silakan memasukkan Username!',
            'username.unique' => 'Username terdaftar, silakan pilih Username yang lain!',
            'password.required' => 'Password kosong, silakan memasukkan Password!',
            'password.min' => 'Silakan memasukkan password dengan minimal 6 karakter!',
            'password_confirmation.required' => 'Konfirmasi Password kosong, silakan memasukkan Konfirmasi Password!',
            'password_confirmation.same' => 'Password tidak sesuai',
            'gambar.required' => 'Gambar kosong, silakan memasukkan Gambar!',
            'gambar.image' => 'Tipe file harus gambar!',
            'gambar.mimes' => 'Hanya tipe gambar JPEG, PNG, JPG, dan GIF yang diperbolehkan!',
            'gambar.max' => 'Ukuran file gambar tidak boleh melebihi 2048 KB/2MB!'
        ]);

        $user = new Pelanggan([
            'email' => $request->email,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $user->gambar = $filename;
        }

        $existing_user = Pelanggan::where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if ($existing_user) {
            if ($existing_user->username == $request->username) {
                return redirect()->back()->withErrors(['username' => 'Username already exists'])->withInput();
            }
            if ($existing_user->email == $request->email) {
                return redirect()->back()->withErrors(['email' => 'Email already exists'])->withInput();
            }
        }

        $user->save();
        $userlist = new User([
            'email' => $user->email,
            'nama' => $user->nama,
            'nomor_telepon' => $user->nomor_telepon,
            'username' => $user->username,
            'password' => $user->password, 
            'gambar' => $user->gambar,
        ]);
    
        $userlist->save();
        return redirect()->route('login')->with('success', 'Data Berhasil Diregistrasi!');
    }
    public function registeraccstaff(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:karyawan,email|unique:pelanggan,email|unique:generalmanageroperasional,email',
            'nama' => 'required',
            'nomor_telepon' => 'required|unique:karyawan,nomor_telepon|unique:pelanggan,nomor_telepon|unique:generalmanageroperasional,nomor_telepon',
            'username' => 'required|unique:karyawan,username|unique:pelanggan,username|unique:generalmanageroperasional,username',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'jabatan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.required' => 'Email kosong, silakan memasukkan alamat email!',
            'email.unique' => 'Email terdaftar, silakan pilih Email yang lain!',
            'nama.required' => 'Nama kosong, silakan memasukkan Nama!',
            'nomor_telepon.required' => 'Nomor Telepon kosong, silakan memasukkan Nomor Telepon!',
            'nomor_telepon.unique' => 'Nomor Telepon terdaftar, silakan pilih Nomor Telepon yang lain!',
            'username.required' => 'Username kosong, silakan memasukkan Username!',
            'username.unique' => 'Username terdaftar, silakan pilih Username yang lain!',
            'password.required' => 'Password kosong, silakan memasukkan Password!',
            'password.min' => 'Silakan memasukkan password dengan minimal 6 karakter!',
            'password_confirmation.required' => 'Konfirmasi Password kosong, silakan memasukkan Konfirmasi Password!',
            'password_confirmation.same' => 'Password tidak sesuai',
            'jabatan.required' => 'Silakan pilih jabatan!',
            'gambar.required' => 'Gambar kosong, silakan memasukkan Gambar!',
            'gambar.image' => 'Tipe file harus gambar!',
            'gambar.mimes' => 'Hanya tipe gambar JPEG, PNG, JPG, dan GIF yang diperbolehkan!',
            'gambar.max' => 'Ukuran file gambar tidak boleh melebihi 2048 KB/2MB!'
        ]);

        if ($request->jabatan == 'karyawan') {
            $user = new Karyawan([
                'email' => $request->email,
                'nama' => $request->nama,
                'nomor_telepon' => $request->nomor_telepon,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'jabatan' => $request->jabatan,
            ]);
        } elseif ($request->jabatan == 'generalmanageroperasional') {
            $user = new GeneralManagerOperasional([
                'email' => $request->email,
                'nama' => $request->nama,
                'nomor_telepon' => $request->nomor_telepon,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'jabatan' => $request->jabatan,
            ]);
        }

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $user->gambar = $filename;
        }

        $user->save();
        $userlist = new User([
            'email' => $user->email,
            'nama' => $user->nama,
            'nomor_telepon' => $user->nomor_telepon,
            'username' => $user->username,
            'password' => $user->password, 
            'jabatan' => $user->jabatan, 
            'gambar' => $user->gambar,
        ]);
    
        $userlist->save();
        return redirect()->route('login')->with('success', 'Data Successfully Registered');
    }
    public function showPasswordForm()
    {
        return view('password_form');
    }

    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|password_check',
        ]);

        session(['entered_password' => true]);

        return redirect()->route('register.staff');
    }


    public function login()
    {
        $data['title'] = "Login";
        return view('login', $data);
    }

    public function loginacc(Request $request)
    {
        $request->validate([
            'username' => 'required|username',
            'password' => 'required',
        ],[ 
            'username.required' => 'Username kosong, silakan memasukkan Username!',
            'password.required' => 'Password kosong, silakan memasukkan Password!',

        ]);
    
        $credentials = $request->only(['username', 'password']);
    
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
    
            $user = Auth::user();
            if ($user && $user->status === 'inactive') {
                $user->status = 'active';
                $user->save();
                $request->session()->regenerate();
    
                if ($user->jabatan === 'pelanggan') {
                    return redirect()->intended('dashboardpelanggan');
                } else if ($user->jabatan === 'karyawan') {
                    return redirect()->intended('dashboardkaryawan');
                }
                else if ($user->jabatan === 'generalmanageroperasional') {
                    return redirect()->intended('dashboardgeneralmanageroperasional');
                }
            }
        }
    
        return back()->withErrors([
            'email' => 'Username dan/atau Password salah, silakan memasukkan Username/Password yang benar!',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->status = 'inactive';
            $user->save();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

        }
        return view('login');
    }



    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $randomPassword = Str::random(6);
            $user->password = Hash::make($randomPassword);
            $user->save();

            return redirect()->back()->with('success', 'Your password has been reset to: ' . $randomPassword);
        } else {
            return redirect()->back()->withErrors(['email' => 'Email not found']);
        }
    }


public function showAccount($id)
    {
        $user = User::find($id);
        return view('editprofile', compact('user'));
    }
    public function showAccount2($id)
    {
        $user = User::find($id);
        return view('editprofile2', compact('user'));
    }
    public function showAccount3($id)
    {
        $user = User::find($id);
        return view('editprofile3', compact('user'));
    }
    public function editAccount(Request $request, $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('dashboardgeneralmanageroperasional')->with('error', 'Data Tidak Ditemukan!');
        }
    
        $rules = [
            'nama' => 'required',
            'nomor_telepon' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    
        // Check if the email is changed
        if ($request->email !== $user->email) {
            $rules['email'] = 'required|unique:userlist,email';
        }
    
        // Check if the nomor_telepon is changed
        if ($request->nomor_telepon !== $user->nomor_telepon) {
            $rules['nomor_telepon'] = 'required|unique:userlist,nomor_telepon';
        }
    
        // Check if the username is changed
        if ($request->username !== $user->username) {
            $rules['username'] = 'required|unique:userlist,username';
        }
    
        $validatedData = $request->validate($rules, [
            // Your custom validation messages here
        ]);
    
        $user->update([
            'email' => $validatedData['email'] ?? $user->email,
            'nama' => $validatedData['nama'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'password' => Hash::make($request->password),
            'username' => $validatedData['username'],
        ]);
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $file_name = $file->getClientOriginalName();
            $file_path = $file->move(public_path('images'), $file_name);
            $user->gambar = $file_name;
            $user->save();
        }
    
        return redirect()->route('dashboardgeneralmanageroperasional')->with(['laporan' => $user]);
    }
    
    public function editAccount2(Request $request, $id)
    {

        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('dashboardkaryawan')->with('error', 'Data Tidak Ditemukan!');
        }
    
        $rules = [
            'nama' => 'required',
            'nomor_telepon' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    
        // Check if the email is changed
        if ($request->email !== $user->email) {
            $rules['email'] = 'required|unique:userlist,email';
        }
    
        // Check if the nomor_telepon is changed
        if ($request->nomor_telepon !== $user->nomor_telepon) {
            $rules['nomor_telepon'] = 'required|unique:userlist,nomor_telepon';
        }
    
        // Check if the username is changed
        if ($request->username !== $user->username) {
            $rules['username'] = 'required|unique:userlist,username';
        }
    
        $validatedData = $request->validate($rules, [
            // Your custom validation messages here
        ]);
    
        $user->update([
            'email' => $validatedData['email'] ?? $user->email,
            'nama' => $validatedData['nama'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'password' => Hash::make($request->password),
            'username' => $validatedData['username'],
        ]);
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $file_name = $file->getClientOriginalName();
            $file_path = $file->move(public_path('images'), $file_name);
            $user->gambar = $file_name;
            $user->save();
        }
    
        return redirect()->route('dashboardkaryawan')->with(['laporan' => $user]);
    }
    public function editAccount3(Request $request, $id)
    {

        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('dashboardpelanggan')->with('error', 'Data Tidak Ditemukan!');
        }
    
        $rules = [
            'nama' => 'required',
            'nomor_telepon' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    
        // Check if the email is changed
        if ($request->email !== $user->email) {
            $rules['email'] = 'required|unique:userlist,email';
        }
    
        // Check if the nomor_telepon is changed
        if ($request->nomor_telepon !== $user->nomor_telepon) {
            $rules['nomor_telepon'] = 'required|unique:userlist,nomor_telepon';
        }
    
        // Check if the username is changed
        if ($request->username !== $user->username) {
            $rules['username'] = 'required|unique:userlist,username';
        }
    
        $validatedData = $request->validate($rules, [
            // Your custom validation messages here
        ]);
    
        $user->update([
            'email' => $validatedData['email'] ?? $user->email,
            'nama' => $validatedData['nama'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'password' => Hash::make($request->password),
            'username' => $validatedData['username'],
        ]);
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $file_name = $file->getClientOriginalName();
            $file_path = $file->move(public_path('images'), $file_name);
            $user->gambar = $file_name;
            $user->save();
        }
    
        return redirect()->route('dashboardpelanggan')->with(['laporan' => $user]);
    }


   
    public function showProfile($id)
    {
        $user = User::find($id);
        return view('daftarpelangganupdate', compact('user'));
    }
    public function editProfile(Request $request, $id)
    {

        $user = User::find($id);
        $validatedData = $request->validate([
            'id' => 'nullable',           
            'email' => 'nullable',
            'nama' => 'nullable',
            'nomor_telepon' => 'nullable',
            'username' => 'nullable',
            'status_belanja_bantuan_karyawan' => 'nullable',

        ]);


        if ($user) {
            $user->update([
                'id' => $validatedData['id'],
                'email' => $validatedData['email'],
                'nama' => $validatedData['nama'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'username' => $validatedData['username'],
                'status_belanja_bantuan_karyawan' => $validatedData['status_belanja_bantuan_karyawan'],


            ]);

            
                $user->save();

            return redirect()->route('daftarpelanggan')->with(['laporan' => $user]);
        } else {
            return redirect()->route('daftarpelanggan')->with('error', 'Data Not Found');
        }
    }

    public function deleteProfile($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Laporan kriminalitas berhasil dihapus.');
    }


}
