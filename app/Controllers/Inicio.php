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
        // $session = \Config\Services::session();
        setlocale(LC_TIME, 'es_ES');
        $catalogos = new Mglobal;
        $dataPage = [];
        $mpdf = new \Mpdf\Mpdf();
        $id_turno= $this->request->getGet('id_turno');
        // Agregar contenido al PDF
        // $dataPage['id_turno'] = $id_turno;
        $select = '
        id_turno,
        anio, 
        id_asunto,
        fecha_recepcion,
        solicitante_titulo, 
        solicitante_nombre,
        solicitante_primer_apellido,
        solicitante_segundo_apellido, 
        solicitante_cargo,
        solicitante_razon_social,
        resumen,
        usuario_registro,
        firma_turno,
        ';
        $dataDB = array('select' => $select,'tabla' => 'turno', 'where' => 'id_turno= "'.$id_turno.'" AND visible = 1');
        $response = $catalogos->getTabla($dataDB);
        $dataPage['id_turno'] = $response->data[0]->id_turno;
        $dataPage['anio'] = $response->data[0]->anio;
        $titulo = (empty($response->data[0]->solicitante_titulo)) ? '' : $response->data[0]->solicitante_titulo.".";
        $dataPage['nombre_completo'] = $titulo." ".$response->data[0]->solicitante_nombre." ".$response->data[0]->solicitante_primer_apellido." ".$response->data[0]->solicitante_segundo_apellido;
        $dataPage['cargo'] = $response->data[0]->solicitante_cargo;
        $dataPage['razon_social'] =$response->data[0]->solicitante_razon_social; 
        $dataPage['resumen'] =$response->data[0]->resumen; 
       
        $dataPage['fecha_recepcion'] =  strftime('%d/%b/%y', strtotime($response->data[0]->fecha_recepcion));;
        
        $dataDB = array('select' => 'dsc_asunto', 'tabla' => 'cat_asuntos', 'where' => 'id_asunto= "'.$response->data[0]->id_asunto.'" AND visible = 1');
        $responseAsunto = $catalogos->getTabla($dataDB);
        $dataPage['asunto'] = $responseAsunto->data[0]->dsc_asunto;

        $dataDB = array('select' => 'usuario','tabla' => 'seg_usuarios', 'where' => 'id_usuario= "'.$response->data[0]->usuario_registro.'" AND visible = 1');
        $responseUsuario = $catalogos->getTabla($dataDB);
        $dataPage['usuario_registro'] = $responseUsuario->data[0]->usuario;
        // var_dump($responseUsuario);
        //  die();

        $dataImagen = $this->encode_img_base64(FCPATH .'assets/images/formato.png', 'png');
        $html = view("pdfs/vpdfTurno.php", ["dataPage" => $dataPage,"dataImagen" =>$dataImagen] );
        $mpdf->WriteHTML($html);

        // Generar el PDF
        $mpdf->Output('output.pdf', 'I'); // Descargar el PDF directamente
        exit;
    }
    function encode_img_base64($img_path = false, $img_type = 'png')
    {
        if ($img_path) {
            //convert image into Binary data
            $img_data = fopen($img_path, 'rb');
            $img_size = filesize($img_path);
            $binary_image = fread($img_data, $img_size);
            fclose($img_data);
            //Build the src string to place inside your img tag
            $img_src = "data:image/" . $img_type . ";base64," . str_replace("\n", "", base64_encode($binary_image));
            return $img_src;
        }
        return false;
    }

    
}