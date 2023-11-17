<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;


use stdClass;
use CodeIgniter\API\ResponseTrait;

class Agregar extends BaseController {

    use ResponseTrait;
    private $defaultData = array(
        'title' => 'Turnos 2.0',
        'layout' => 'plantilla/lytDefault',
        'contentView' => 'vUndefined',
        'stylecss' => '',
    );
    public function __construct()
    {
        setlocale(LC_TIME, 'es_ES.utf8', 'es_MX.UTF-8', 'es_MX', 'esp_esp', 'Spanish'); // usar solo LC_TIME para evitar que los decimales los separe con coma en lugar de punto y fallen los inserts de peso y talla
        date_default_timezone_set('America/Mexico_City');  
        $session = \Config\Services::session();
        if($session->get('logueado')!= 1){
            header('Location:'.base_url().'index.php/Login/cerrar?inactividad=1');            
            die();
        }
    }

    private function _renderView($data = array()) {     
        $data = array_merge($this->defaultData, $data);
        echo view($data['layout'], $data);               
    }

    public function index()
    {        

        $session = \Config\Services::session();   
        $data = array();
        $catalogos = new Mglobal;
      
        try {
            $dataDB = array('select'=> 'id_asunto, dsc_asunto', 'tabla' => 'cat_asuntos', 'where' => 'visible = 1');
            $response = $catalogos->getTabla($dataDB);
            if (isset($response) && isset($response->data)) {
                $data['cat_asunto'] = $response->data;
            } else {
                $data['cat_asunto'] = array(); 
            }
        } catch (\Exception $e) {
            log_message('error', "Se produjo una excepción: " . $e->getMessage());
        }
        try {
            $dataDB = array( 'select'=> 'id, nombre, cargo, orden',  'tabla' => 'turnado', 'where' => 'visible = 1');
            $response = $catalogos->getTabla($dataDB);
            if (isset($response) && isset($response->data)) {
                $data['turnado'] = $response->data;
                $resultadoFiltrado = array_filter($response->data, function($elemento) {
                    return $elemento->orden == '2';
                });
                $data['cppNombre']= $resultadoFiltrado;

            } else {
                $data['turnado'] = array(); 
            }
        } catch (\Exception $e) {
            log_message('error', "Se produjo una excepción: " . $e->getMessage());
        }
        try {
            $dataDB = array( 'select'=> 'id_indicacion, dsc_indicacion',  'tabla' => 'indicaciones', 'where' => 'visible = 1');
            $response = $catalogos->getTabla($dataDB);
            if (isset($response) && isset($response->data)) {
                $data['indicacion'] = $response->data;
            } else {
                $data['indicacion'] = array(); 
            }
        } catch (\Exception $e) {
            log_message('error', "Se produjo una excepción: " . $e->getMessage());
        }
        try {
            $dataDB = array( 'select'=> 'id_personal, alias',  'tabla' => 'personal', 'where' => 'visible = 1');
            $response = $catalogos->getTabla($dataDB);
            if (isset($response) && isset($response->data)) {
                $data['tramito'] = $response->data;
            } else {
                $data['tramito'] = array(); 
            }
        } catch (\Exception $e) {
            log_message('error', "Se produjo una excepción: " . $e->getMessage());
        }
        try {
            $dataDB = array( 'select'=> 'id, nombre',  'tabla' => 'personal_llamadas', 'where' => 'orden > 1  AND mostrar = 1');
            $response = $catalogos->getTabla($dataDB);
            if (isset($response) && isset($response->data)) {
                $data['firmaTurno'] = $response->data;
            } else {
                $data['firmaTurno'] = array(); 
            }
        } catch (\Exception $e) {
            log_message('error', "Se produjo una excepción: " . $e->getMessage());
        }
        try {
            $dataDB = array( 'select'=> 'id_estatus, dsc_status',  'tabla' => 'cat_estatus', 'where' => 'visible = 1');
            $response = $catalogos->getTabla($dataDB);
            if (isset($response) && isset($response->data)) {
                $data['status'] = $response->data;
            } else {
                $data['status'] = array(); 
            }
        } catch (\Exception $e) {
            log_message('error', "Se produjo una excepción: " . $e->getMessage());
        }
        //  var_dump($data['firmaTurno']);
        //  die();
        $data['scripts'] = array('principal','agregar');
        $data['edita'] = 0;
        $data['nombre_completo'] = $session->nombre_completo; 
        $data['contentView'] = 'formularios/vFormAgregar';                
        $this->_renderView($data);
        
    }
    public function guardaTurno(){
        $response = new \stdClass();
        $response->error = true;
        $data = $this->request->getPost();
         $dataInsert = [
            'id_actividad'          => $idActividad,
            'id_estatus_respuesta'  => 0,
            'usuario_registro'      => $this->session->id_usuario,
        ];

        $dataConfig = [
            "tabla" => "actividad_respuesta",
            "editar"=> false,
        ];
        $respuesta = $this->globals->saveTabla($dataInsert,$dataConfig,["script"=>"Auditoria.saveRespuestaEspecifica"]);

        if ($respuesta->error){
            $response->respuesta = $respuesta->respuesta;
            $this->respond($response);
        }
        return $this->respond($response);
    }

  
}