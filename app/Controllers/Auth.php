<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Hash;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url','form']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    } 

    public function save()
    {
        $validation = $this->validate([
            'fullname' =>[
                'rules' =>'required',
                'errors' =>[
                    'required' =>'Su Nombre completo es requerido'
                ]
                ],
        
            'lastname' =>[
                'rules' =>'required',
                'errors' =>[
                    'required' =>'Su Apellido es requerido'
                ]
                ],
            'email' =>[
                'rules' =>'required|valid_email|is_unique[user.email]',
                'errors' =>[
                    'required' =>'Correo electrónico es requerido',
                    'valid_email' =>'Debe ingresar un correo electrónico válido, por ejemplo:@gmail.com',
                    'is_unique' =>'Correo electrónico ya está registrado'
                ]
                ],
            'password' =>[
                'rules' =>'required|min_length[5]|max_length[12]',
                'errors' =>[
                    'required' =>'Se requiere Contraseña',
                    'min_length' =>'La Contraseña debe tener al menos 5 caracteres de longitud.',
                    'max_length' =>'La Contraseña no debe tener más de 12 caracteres de longitud'
                ]
                ],
        ]);
    
        if (!$validation) 
        {
            return view('auth/register', ['validation' => $this->validator]);
        } else {
            // Registro del uso en db
            $full_name = $this->request->getPost('fullname');
            $last_name = $this->request->getPost('lastname');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $values = [
                'full_name' => $full_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' =>Hash::make($password),
            ];

            $userModel = new \App\Models\UserModel();
            $query = $userModel->insert($values);
            if(!$query){
                return redirect()->back()->with('fail', 'Algo salió mal');
            } else {
                return redirect()->to('register')->with('success', '¡Ahora estás registrado/a con éxito!');
                $last_id = $userModel->insertID();
                session()->set('loggedUser', $last_id);
                return redirect()->to('dashboard');
            }
        }
    }

    public function check()
    {
        // Validación del Usuario
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[user.email]',
                'errors' => [
                    'required' => 'Correo electrónico es requerido',
                    'valid_email' => 'Introduzca una dirección de Correo Electrónico válida',
                    'is_not_unique' => 'Este Correo Electrónico no está registrado en nuestro servicio.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Se requiere Contraseña',
                    'min_length' => 'La Contraseña debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'La Contraseña no debe tener más de 12 caracteres de longitud'
                ]
            ]
        ]);

        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        } else {
            // Revisar el usuario
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $userModel = new \App\Models\UserModel();
            $user_info = $userModel->where('email', $email)->first();

            if (!$user_info) {
                session()->setFlashdata('fail', 'El Correo electrónico no encontrado.');
                return redirect()->to('/auth')->withInput();
            }

            $check_password = Hash::check($password, $user_info['password']);

            if (!$check_password) {
                session()->setFlashdata('fail', 'Contraseña Incorrecta');
                return redirect()->to('/auth')->withInput();
            } else {
                $user_id = $user_info['id_users'];
                session()->set('loggedUser', $user_id);

                // Verificar si el usuario es un administrador
                $adminEmails = ['nahuelalvarez@gmail.com', 'benjaoviedo@gmail.com'];

                if (in_array($email, $adminEmails)) {
                    return redirect()->to('/dashboard');
                } else {
                    return redirect()->to('/inicio');
                }
            }
        }
    }

    function Input(){
        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            return redirect()->to('/auth?acceso=fuera')->with('fail','¡Estás deslogeado!');
        }
    }
}