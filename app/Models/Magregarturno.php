<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Bitacoracontrol;
use App\Models\Mglobal;
use CodeIgniter\HTTP\Response;
use stdClass;

class Magregaturno extends Model 
{
    protected $DBGroup = 'default';
    public $errorConexion = false;
    private $Mglobal;

    //protected $table = 'zeus_usuarios';

    function __construct() {
        parent::__construct();        
        $this->db->query("SET lc_time_names = 'es_MX'");
        $this->Mglobal = new Mglobal();
    }

    public function guardarTurno($dataInsert,$dataBitacora){
       
        $Bitacoracontrol = new Bitacoracontrol();
        $response = new \stdClass();
        $response->error = true;
        $bitacora = [];
        $errorDB = false;
        
        /** para guardar en la primera
            * Funcion que realiza el guardado, actualización y manejop de errores en el manejo de tablas
            * @param object:db                     La instancia de base de datos que estas manejando. [$this->db]
            * @param object:response               Objeto stdClass para manejo de respuesta
            * @param array:dataInsert
            * @param array:dataBitacora
            * @param string:tabla
            * @param array:bitacora
            * @param string:variableReferencia     (opcional) Nombre de la variable que manejará el id insertado, RECOMENDABLE PARA TABLAS PRINCIPALES
            * @param array:editar                  (opcional) Llave primaria para editar ["idCampoTablaName",idTabla]
            * @param array:adicionales             Variable utilizada para el caso en que se requiera cambiar parte de la estructura de la función
            */
       if(!$this->Mglobal->localSaveTabla($this->db, $response, $dataInsert, $dataBitacora, 'turno', $bitacora, 'id_turno', false, false)){
        log_message("critical","Respuesta: ".json_encode($response));
        return $response;
       }




    }

}