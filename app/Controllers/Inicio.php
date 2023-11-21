<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;

use stdClass;
use CodeIgniter\API\ResponseTrait;

class Inicio extends BaseController {

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
            header('Location:'.base_url().'/index.php/Login/cerrar?inactividad=1');            
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
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = 0;
        $data['nombre_completo'] = $session->nombre_completo; 
        $data['contentView'] = 'secciones/vInicio';                
        $this->_renderView($data);
        
    }
    public function getPrincipal()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
       
        $dataDB = array('tabla' => 'principal', 'where' => 'visible = 1');  
        $response = $principal->getTabla($dataDB); 
      
         return $this->respond($response->data);
    }
    // public function getPrincipal() {
    //       $session = \Config\Services::session();
    //     $principal = new Mglobal;

    //     $data = $this->request->getBody();        
    //     $data = json_decode($data);
        
    //     $where ='visible = 1';

    //     $response = new \stdClass();
    //     $dataConfig = [
    //         'dataBase' => 'turnos2',
    //         'tabla' => 'principal'            
    //     ];

    //     if (isset($data->limit)) {
    //         $dataConfig['limit'] = ['start' => $data->offset, 'length' => $data->limit];
    //     }

    //     if ($data->search != "") {
    //         $where .= " AND (nombre LIKE '%" . $data->search . "%'";
    //         $where .= "OR primer_apellido LIKE '%" . $data->search . "%'";
    //         $where .= "OR segundo_apellido LIKE '%" . $data->search . "%'";                                
    //         $where .= ")";            
    //     } 

    //     $dataConfig['where'] = $where;
    //     $request = $principal->getTabla($dataConfig);
    //     //die(print_r($dataConfig));
    //     if (isset($dataConfig['limit'])) {
    //         unset($dataConfig['limit']);
    //     }
    //     $dataConfig['select'] = 'count(*) AS total_registros';
    //     $requestTotal = $principal->getTabla($dataConfig);

              
    //     $response->rows = $request->data;
    //     $response->total = $requestTotal->data[0]->total_registros;
    //     $response->totalNotFiltered = $requestTotal->data[0]->total_registros;
    //     // die(print_r($response));

    //     return $this->respond($response);
        
    // }
}