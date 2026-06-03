<?php
// app/Controllers/Profile.php
namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct() {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // TASK 03: Paginate kung saan 5 users kada page ang ipapakita
        $data = [
            'users' => $this->userModel->paginate(5),
            'pager' => $this->userModel->pager
        ];

        return view('profile_view', $data);
    }

    public function upload()
    {
        $rules = [
            'username' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Kukunin ang file descriptor handles
        $img = $this->request->getFile('avatar');

        // Suriin kung walang error sa native PHP post layer
        if ($img && !$img->hasMoved()) {
            if ($img->getError() !== UPLOAD_ERR_OK) {
                return redirect()->back()->withInput()->with('errors', ['avatar' => 'PHP Upload Error Code: ' . $img->getErrorString() . '. Please check your php.ini max size limits.']);
            }

            if ($img->isValid()) {
                $ext = $img->getExtension();
                $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'JPG', 'JPEG', 'PNG'];

                if (!in_array($ext, $allowedExts)) {
                    return redirect()->back()->withInput()->with('errors', ['avatar' => 'The file extension is invalid. Only JPG, JPEG, and PNG are allowed.']);
                }

                $newName = $img->getRandomName();
                $img->move(FCPATH . 'uploads/', $newName);

                // Pag-save sa DB engine model handler
                $this->userModel->insert([
                    'username' => $this->request->getPost('username'),
                    'avatar'   => $newName
                ]);

                return redirect()->to('profile')->with('success', 'Profile uploaded and saved successfully!');
            }
        }

        return redirect()->back()->withInput()->with('errors', ['avatar' => 'Unable to process the image file stream. Try a smaller resolution photo or adjust XAMPP php.ini settings.']);
    }
}