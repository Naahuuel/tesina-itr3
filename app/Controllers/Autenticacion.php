<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Hash;

class Autenticacion extends BaseController
{
    public function __construct()
    {
        helper(['url','form']);
    }

    public function index()
    {
        return view('autenticacion/login');
    }

    public function register()
    {
        return view('autenticacion/register');
    } 

    public function guardar()
    {
        $validation = $this->validate([
            'nombre_completo' =>[
                'rules' =>'required',
                'errors' =>[
                    'required' =>'Su Nombre completo es requerido'
                ]
                ],
        
            'apellido' =>[
                'rules' =>'required',
                'errors' =>[
                    'required' =>'Su Apellido es requerido'
                ]
                ],
            'email' =>[
                'rules' =>'required|valid_email|is_unique[usuario.email]',
                'errors' =>[
                    'required' =>'Correo electrónico es requerido',
                    'valid_email' =>'Debe ingresar un correo electrónico válido, por ejemplo:@gmail.com',
                    'is_unique' =>'Correo electrónico ya está registrado'
                ]
                ],
            'contraseña' =>[
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
            return view('autenticacion/register', ['validation' => $this->validator]);
        } else {
            // Registro del uso en db
            $nombre_completo = $this->request->getPost('nombre_completo');
            $apellido = $this->request->getPost('apellido');
            $email = $this->request->getPost('email');
            $contraseña = $this->request->getPost('contraseña');

            $values = [
                'nombre_completo' => $nombre_completo,
                'apellido' => $apellido,
                'email' => $email,
                'contraseña' =>Hash::make($contraseña),
            ];

            $userModel = new \App\Models\UserModel();
            $query = $userModel->insert($values);
            if(!$query){
                return redirect()->back()->with('fail', 'Algo salió mal');
            } else {
                return redirect()->to('register')->with('success', '¡Ahora estás registrado/a con éxito!');
                $last_id = $userModel->insertID();
                session()->set('loggedUser', $last_id);
                return redirect()->to('admin');
            }
        }
    }

    public function controlar()
    {
        // Validación del Usuario
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[usuario.email]',
                'errors' => [
                    'required' => 'Correo electrónico es requerido',
                    'valid_email' => 'Introduzca una dirección de Correo Electrónico válida',
                    'is_not_unique' => 'Este Correo Electrónico no está registrado en nuestro servicio.'
                ]
            ],
            'contraseña' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Se requiere Contraseña',
                    'min_length' => 'La Contraseña debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'La Contraseña no debe tener más de 12 caracteres de longitud'
                ]
            ]
        ]);

        if (!$validation) {
            return view('autenticacion/login', ['validation' => $this->validator]);
        } else {
            // Revisar el usuario
            $email = $this->request->getPost('email');
            $contraseña = $this->request->getPost('contraseña');
            $userModel = new \App\Models\UserModel();
            $user_info = $userModel->where('email', $email)->first();

            if (!$user_info) {
                session()->setFlashdata('fail', 'El Correo electrónico no encontrado.');
                return redirect()->to('/autenticacion')->withInput();
            }

            $check_password = Hash::check($contraseña, $user_info['contraseña']);

            if (!$check_password) {
                session()->setFlashdata('fail', 'Contraseña Incorrecta');
                return redirect()->to('/autenticacion')->withInput();
            } else {
                $user_id = $user_info['id_users'];
                session()->set('loggedUser', $user_id);

                // Verificar si el usuario es un administrador
                $adminEmails = ['nahuelalvarez@gmail.com', 'benjaoviedo@gmail.com'];

                if (in_array($email, $adminEmails)) {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/inicio');
                }
            }
        }
    }

    function Input(){
        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            return redirect()->to('/autenticacion?acceso=fuera')->with('fail','¡Estás deslogeado!');
        }
    }
}