<!-- <?php
namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'reservas'; // Nombre de la tabla de reservas (ajusta esto según tu base de datos)
    protected $primaryKey = 'id'; // Clave primaria de la tabla de reservas
    protected $allowedFields = ['nombre_completo', 'telefono', 'mesa_id', 'dia', 'hora'];

    public function getMesasDisponibles()
    {
        // Realiza una consulta SQL para obtener las mesas disponibles desde la tabla 'mesas'
        $query = $this->db->table('mesas');
        $query->where('disponible', 1); // Suponiendo que 'disponible' indica si una mesa está disponible
        $result = $query->get()->getResultArray();

        return $result;
    }

    public function getDiasDisponibles()
    {
        // Realiza una consulta SQL para obtener los días disponibles desde la tabla adecuada
        // Supongamos que los días disponibles se almacenan en una tabla llamada 'dias_disponibles'

        $query = $this->db->table('dias_disponibles');
        $query->where('disponible', 1); // Suponiendo que 'disponible' indica si un día está disponible
        $result = $query->get()->getResultArray();

        return $result;
    }

    public function getHorasDisponibles()
    {
        // Realiza una consulta SQL para obtener las horas disponibles desde la tabla adecuada
        // Supongamos que las horas disponibles se almacenan en una tabla llamada 'horas_disponibles'

        $query = $this->db->table('horas_disponibles');
        $query->where('disponible', 1); // Suponiendo que 'disponible' indica si una hora está disponible
        $result = $query->get()->getResultArray();

        return $result;
    }

} -->
