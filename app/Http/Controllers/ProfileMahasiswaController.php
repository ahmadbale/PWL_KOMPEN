<?php
namespace App\Http\Controllers;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProfileMahasiswaController extends Controller
{
    public function index()
    {
        $user = MahasiswaModel::findOrFail(Auth::id());
        $breadcrumb = (object) [
            'title' => 'Data Profil',
            'list' => [
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Profil', 'url' => url('/profile-mhs')]
            ]
        ];
        $activeMenu = 'profile';
        return view('profile-mhs', compact('user'), [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:20',
            'nama'     => 'required|string|max:255',
        ]);

        $mahasiswa = MahasiswaModel::findOrFail($id);
        $mahasiswa->username = $request->username;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->save();

        return back()->with('status', 'Profil berhasil diperbarui');
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password'   => 'required|min:8|confirmed',
        ]);

        $mahasiswa = MahasiswaModel::findOrFail($id);

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $mahasiswa->password)) {
                $mahasiswa->password = Hash::make($request->password);
                $mahasiswa->save();

                return back()->with('status', 'Password berhasil diperbarui');
            } else {
                return back()
                    ->withErrors(['old_password' => __('Password lama tidak sesuai')])
                    ->withInput();
            }
        }

        return back()->with('status', 'Tidak ada perubahan pada password');
    }

    public function update_picture(Request $request, $id)
    {
        // Validasi file gambar
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = MahasiswaModel::findOrFail($id);

        // Cek jika ada file yang di-upload
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($mahasiswa->image && Storage::exists('public/photos/' . $mahasiswa->image)) {
                Storage::delete('public/photos/' . $mahasiswa->image);
            }

            // Ambil file yang di-upload
            $file = $request->file('image');
            $fileName = $file->hashName(); // Generate nama file unik

            // Simpan file di folder 'public/photos' di storage
            $file->storeAs('public/photos', $fileName); // Simpan gambar ke storage

            // Simpan nama file di database
            $mahasiswa->image = $fileName;
            $mahasiswa->save();
        }

        // Kembali ke halaman sebelumnya dengan status
        return back()->with('status', 'Foto profil berhasil diperbarui');
    }


}