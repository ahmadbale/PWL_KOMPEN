<?php
namespace App\Http\Controllers;
use App\Models\PersonilAkademikModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProfilePersonilController extends Controller
{
    public function index()
    {
        $user = PersonilAkademikModel::findOrFail(Auth::id());
        $breadcrumb = (object) [
            'title' => 'Data Profil',
            'list' => [
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Profil', 'url' => url('/profile-pa')]
            ]
        ];
        $activeMenu = 'profile';
        return view('profile-pa', compact('user'), [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:20|unique:personil_akademik,username',
            'nama'     => 'required|string|max:255',
            'nomor_induk'     => 'required|string|max:18',
            'nomor_telp' => 'required|string|max:15',
        ]);

        $personil = PersonilAkademikModel::findOrFail($id);
        $personil->username = $request->username;
        $personil->nama = $request->nama;
        $personil->nomor_induk = $request->nomor_induk;
        $personil->nomor_telp = $request->nomor_telp;
        $personil->save();

        return back()->with('status', 'Profil berhasil diperbarui');
        // return redirect('/profile-pa')->with('status', 'Profil berhasil diperbarui');

    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        $personil = PersonilAkademikModel::findOrFail($id);

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $personil->password)) {
                $personil->password = Hash::make($request->password);
                $personil->save();

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
        $personil = PersonilAkademikModel::findOrFail($id);

        // Cek jika ada file yang di-upload
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($personil->image && Storage::exists('public/photos/' . $personil->image)) {
                Storage::delete('public/photos/' . $personil->image);
            }

            // Ambil file yang di-upload
            $file = $request->file('image');
            $fileName = $file->hashName(); // Generate nama file unik

            // Simpan file di folder 'public/photos' di storage
            $file->storeAs('public/photos', $fileName); // Simpan gambar ke storage

            // Simpan nama file di database
            $personil->image = $fileName;
            $personil->save();
        }

        // Kembali ke halaman sebelumnya dengan status
        return back()->with('status', 'Foto profil berhasil diperbarui');
    }

}