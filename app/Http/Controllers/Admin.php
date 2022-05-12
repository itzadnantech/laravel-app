<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{

    ///Load Helper
    public function __construct()
    {

        // parent::__construct();

    }


    //Load_Login_Page
    public function Load_Login_Page()
    {
        $data = array();
        $data['title'] = 'admin Login Page';
        return view('admin.index', $data);
    }


    ///Login_Process
    public function Login_Process(Request $request)
    {


        ///check form validation
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);

        ///validation errors
        if ($validation->fails()) {
            ///validation errors code
            $errors = $validation->errors()->toArray();
            $error_array = array();
            foreach ($errors as $key => $value) {
                $error_array[] = array($key, $value[0]);
            }
            $data = array('code' => 'errors', 'message' => $error_array);
            echo json_encode($data);
            die;
        } else {
            extract($request->all());
            $findData = GetByWhereRecord('admin', array('email' => $email));
            if ($findData) {
                if (Hash::check($password, $findData[0]->password)) {
                    ///set session
                    session()->put('admin_id', $findData[0]->admin_id);
                    session()->put('email', $findData[0]->email);
                    session()->put('admin_logged_in', true);
                    session()->save();

                    // $data =  session()->all();
                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // die;

                    ///Success
                    $redirect_url = 'dashboard';
                    $data = array('code' => 'success', 'message' => 'Logged in successful', 'redirect_url' => $redirect_url);
                    echo json_encode($data);
                    die;
                }
                $data = array('code' => 'warning', 'message' => 'Sorry Password Not Match!');
                echo json_encode($data);
                die;
            } else {
                $data = array('code' => 'warning', 'message' => 'Sorry admin No Exists!');
                echo json_encode($data);
                die;
            }
        }
    }





    ////Load_Dashboard
    public function Load_Dashboard()
    {

        $data = array();
        $data['title'] = 'admin Dashboard';
        return view('admin.dashboard', $data);
    }


    ///admin_logout
    public function admin_logout()
    {
        session()->invalidate();
        session()->regenerateToken();
        return redirect('admin/login');
    }
}
