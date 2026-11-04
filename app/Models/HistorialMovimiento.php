namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialMovimiento extends Model
{
    protected $table = 'historial_movimiento';
    protected $primaryKey = 'idMovimiento';
    public $timestamps = false;

    protected $fillable = [
        'idRefaccion', 'idUsuario', 'tipoMovimiento', 'cantidad', 'fechaHora'
    ];
}