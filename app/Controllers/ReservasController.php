<?php

namespace App\Controllers;

use App\Models\ReservaModel;
use CodeIgniter\Controller;

class ReservasController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Cargar la base de datos en el constructor
    }

    public function mostrarDisponibilidad()
    {
        $reservaModel = new ReservaModel();

        $restauranteId = 1; // Asegúrate de ajustar esto según tu configuración
        $mesasDisponibles = $reservaModel->getMesasDisponibles($restauranteId);

        // Obtener días disponibles
        $diasDisponibles = $reservaModel->getDiasDisponibles();

        // Obtener horas disponibles
        $horasDisponibles = $reservaModel->getHorasDisponibles();

        // Pasar los datos a la vista
        $data = [
            'mesasDisponibles' => $mesasDisponibles,
            'diasDisponibles' => $diasDisponibles,
            'horasDisponibles' => $horasDisponibles
        ];

        return view('reservas/disponibilidad', $data);
    }

    // public function getMesasDisponibles()
    // {
    //     // Realiza una consulta SQL para obtener las mesas disponibles desde la tabla 'mesas'
    //     $query = $this->db->table('mesas');
    //     $query->where('disponible', 1); // Suponiendo que 'disponible' indica si una mesa está disponible
    //     $query->where('restaurante_id', $idDelRestaurante); // Agrega esta línea para filtrar por restaurante si es necesario
    //     $query->limit(20); // Limita el resultado a un máximo de 20 mesas
    //     $result = $query->get()->getResultArray();
    // }

    // public function getDiasDisponibles()
    // {
    //     $query = $this->db->table('dias_disponibles');
    //     $query->where('disponible', 1); // Suponiendo que 'disponible' indica si un día está disponible
    //     $result = $query->get()->getResultArray();
    
    //     return $result;
    // }

    // public function getHorasDisponibles()
    // {
    //     $query = $this->db->table('horas_disponibles');
    //     $query->where('disponible', 1); // Suponiendo que 'disponible' indica si una hora está disponible
    //     $result = $query->get()->getResultArray();
    
    //     return $result;
    // }

    // public function actualizarDisponibilidad($tabla, $id)
    // {
    //         // Actualiza la disponibilidad de la tabla específica en la base de datos
    //     if ($tabla === 'mesas') {
    //         // Supongamos que 'mesas' es el nombre de la tabla de mesas
    //         $this->db->table('mesas')->where('id', $id)->update(['disponible' => 0]);
    //     } elseif ($tabla === 'dias_disponibles') {
    //         // Supongamos que 'dias_disponibles' es el nombre de la tabla de días disponibles
    //         $this->db->table('dias_disponibles')->where('id', $id)->update(['disponible' => 0]);
    //     } elseif ($tabla === 'horas_disponibles') {
    //         // Supongamos que 'horas_disponibles' es el nombre de la tabla de horas disponibles
    //         $this->db->table('horas_disponibles')->where('id', $id)->update(['disponible' => 0]);
    //     }
    // }

    public function reservar()
    {
        $nombreCompleto = $this->request->getPost('nombre_completo');
        $telefono = $this->request->getPost('telefono');
        $mesaSeleccionada = $this->request->getPost('mesa_id');
        $diaSeleccionado = $this->request->getPost('dia');
        $horaSeleccionada = $this->request->getPost('hora');
 
        $rules = [
            'nombre_completo' => 'required|min_length[3]|max_length[100]',
            'telefono' => 'required|numeric|exact_length[10]'
        ];

        $errors = [
            'nombre_completo' => [
                'required' => 'El campo Nombre Completo es obligatorio.',
                'min_length' => 'El campo Nombre Completo debe tener al menos 3 caracteres.',
                'max_length' => 'El campo Nombre Completo no debe superar los 100 caracteres.'
            ],
            'telefono' => [
                'required' => 'El campo Teléfono es obligatorio.',
                'numeric' => 'El campo Teléfono debe contener solo números.',
                'exact_length' => 'El campo Teléfono debe tener exactamente 10 dígitos.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            // En caso de errores de validación, muestra los mensajes de error y vuelve a la página de reserva
            return redirect()->to('reservas')
                ->withInput()
                ->with('validation', $this->validator);
        }

        // Si la validación es exitosa, guarda la reserva en la base de datos
        $reservaModel = new ReservaModel();
        $reservaModel->insert([
            'nombre_completo' => $nombreCompleto,
            'telefono' => $telefono,
            'mesa_id' => $mesaSeleccionada, // Cambié 'mesa' a 'mesa_id' para reflejar la relación con otra tabla
            'dia' => $diaSeleccionado,
            'hora' => $horaSeleccionada
        ]);


        // // Actualiza la disponibilidad de mesas, días y horas
        // $this->actualizarDisponibilidad('mesas', $mesaSeleccionada);
        // $this->actualizarDisponibilidad('dias_disponibles', $diaSeleccionado);
        // $this->actualizarDisponibilidad('horas_disponibles', $horaSeleccionada);

        // Redirige a una página de confirmación
        return redirect()->to('confirmacion');
    }

    public function confirmacion()
    {
        // Define un mensaje de confirmación
        $mensajeconfirmacion = 'La reserva se ha realizado con éxito. ¡Gracias!';

        // Almacena el mensaje en la sesión
        $session = session();
        $session->setFlashdata('mensaje_confirmacion', $mensajeconfirmacion);

        $session = session();
        $mensajeconfirmacion = $session->getFlashdata('mensaje_confirmacion');

        $data = ['mensajeconfirmacion' => $mensajeconfirmacion];

        return view('reservas/confirmacion', $data);
    }

}

