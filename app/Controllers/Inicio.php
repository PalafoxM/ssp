<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;

use stdClass;
use CodeIgniter\API\ResponseTrait;
require_once FCPATH . '/mpdf/autoload.php';
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
       
        $dataDB = array('tabla' => 'turno', 'where' => 'visible = 1 ORDER BY fecha_registro DESC');  
        $response = $principal->getTabla($dataDB); 
      
         return $this->respond($response->data);
    }

    public function pdfTurno(){
        $mpdf = new \Mpdf\Mpdf();
        $id_turno= $this->request->getGet('id_turno');
        // Agregar contenido al PDF
        $html = '<h1>Hello World - Turno ID: ' . $id_turno . '</h1>';
        $mpdf->WriteHTML($html);

        // Generar el PDF
        $mpdf->Output('output.pdf', 'I'); // Descargar el PDF directamente

        // También puedes guardar el PDF en el servidor utilizando una ruta en lugar de 'D'
        // $mpdf->Output('path/to/output.pdf', 'F'); // Guardar el PDF en el servidor

        exit;
    }

    
}