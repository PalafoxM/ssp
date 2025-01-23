<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;

use stdClass;
use CodeIgniter\API\ResponseTrait;


require_once FCPATH . '/mpdf/autoload.php';
require_once FCPATH . "/qr_code/autoload.php";


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

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
        $principal = new Mglobal;  
        if($session->get('id_perfil') == 3){
            header('Location:'.base_url().'index.php/Inicio/formulario');            
            die();
        }
        if($session->get('id_perfil') == 4){
            header('Location:'.base_url().'index.php/Inicio/formulario_archivo');            
            die();
        }
        $data = array();
        $dataDB = array('tabla' => 'cat_dependencia', 'where' => 'visible = 1'); 
        $cat_dependencia = $principal->getTabla($dataDB); 
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = 0;
        $data['cat_dependencia'] = (!empty($cat_dependencia->data))?$cat_dependencia->data:''; 
        $data['nombre_completo'] = $session->nombre_completo; 
        $data['contentView'] = 'secciones/vInicio';                
        $this->_renderView($data);
        
    }
    public function formulario_archivo()
    {        
        $session = \Config\Services::session(); 
        $principal = new Mglobal;  
        $cargaDocumento = $principal->getTabla(['tabla' => 'documento', 'where' =>['visible' => 1, 'id_usuario' =>$session->id_usuario ]]);
        if(isset($cargaDocumento->data[0]) && !empty($cargaDocumento->data[0])){
            header('Location:'.base_url().'index.php/Inicio/listaDocumento');            
            die();
        }
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = 0;
        $data['contentView'] = 'formularios/vFormAgregarArchivo';                
        $this->_renderView($data);
        
    }
    public function formulario($id=0, $editar=0 )
    {        
        $session = \Config\Services::session(); 
        $principal = new Mglobal;  
        if($session->get('id_perfil') == 4){
            header('Location:'.base_url().'index.php/Inicio/formulario_archivo');            
            die();
        }
        $campus = $principal->getTabla(['tabla' => 'cat_campus', 'where' =>['visible' => 1]])->data;
        $licenciaturas = $principal->getTabla(['tabla' => 'cat_licenciatura', 'where' =>['visible' => 1]])->data;
      
        if($editar ==1){
          $practicante =  $principal->getTabla(['tabla' => 'practicante', 'where' =>['id_practicante' => $id,'visible' => 1]])->data[0];
          $data['practicante'] = $practicante;
        }
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = $editar;
        $data['campus'] =  $campus;
        $data['id_practicante'] =  $id;
        $data['licenciaturas'] =  $licenciaturas;
        $data['contentView'] = 'formularios/vFormAgregar';                
        $this->_renderView($data);
        
    }
    public function practicantes()
    {        
        $session = \Config\Services::session(); 
        $principal = new Mglobal;  
      
     
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = 0;
 
        $data['contentView'] = 'secciones/vPracticantes';                
        $this->_renderView($data);
        
    }
    public function getDocumentoPracticante()
    {        
        $session = \Config\Services::session(); 
        $principal = new Mglobal;  
        $documento = $principal->getTabla(['tabla' => 'vw_practicante', 'where' =>['visible' => 1, 'id_usuario' => $session->id_usuario]]);
        return $this->respond($documento->data);
    }
    public function listaDocumento()
    {        
        $session = \Config\Services::session(); 
        $principal = new Mglobal;  
        if($session->get('id_perfil') != 4){
            header('Location:'.base_url().'index.php/Inicio/formulario');            
            die();
        }
     
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = 0;
 
        $data['contentView'] = 'secciones/vlistaDocumento';                
        $this->_renderView($data);
        
    }
    public function getCampus()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        $id_campus = $this->request->getPost();
        $campus = $principal->getTabla(['tabla' => 'cat_licenciatura', 'where' =>['visible' => 1, 'id_campus' => $id_campus]]);
      
         return $this->respond($campus->data);
    }
    public function getPracticantesDocumento()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        

        $dataDB = ( $session->get('id_perfil') == 1 || $session->get('id_perfil') == '2')?array('tabla' => 'usuario', 'where' => ['id_perfil' => 4]):
        array('tabla' => 'usuario', 'where' => ['id_dependencia' =>  $session->id_dependencia,'id_perfil' => 4]);  
        $response = $principal->getTabla($dataDB); 
         return $this->respond($response->data);
    }
    public function getPracticantes()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        $user = $principal->getTabla(['tabla' => 'usuario', 'where' =>['visible' => 1, 'id_usuario' => $session->get('id_usuario') ]])->data[0];

        $dataDB = ( $session->get('id_perfil') == 1 || $session->get('id_perfil') == 2 )?array('tabla' => 'practicante', 'where' => ['visible' => 1]):
                                                     array('tabla' => 'practicante', 'where' => ['visible' => 1, 'id_dependencia' =>  $user->id_dependencia]);  
       
        $response = $principal->getTabla($dataDB); 
      
      
         return $this->respond($response->data);
    }
    public function getEstudianteCV()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        if( $session->id_dependencia == -1){
            $dataDB = array('tabla' => 'archivo_cv', 'where' => ['visible' => 1]); 
        }else{
            $dataDB = array('tabla' => 'archivo_cv', 'where' => ['id_dependencia' => $session->id_dependencia ,'visible' => 1]); 
        }
                                            
        $response = $principal->getTabla($dataDB); 
        return $this->respond($response->data);
    }
    public function getReportesMensual()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        if( $session->id_dependencia == -1){
            $dataDB = array('tabla' => 'vw_reportes', 'where' => ['visible' => 1]); 
        }else{
            $dataDB = array('tabla' => 'vw_reportes', 'where' => ['id_dependencia' => $session->id_dependencia ,'visible' => 1]); 
        }
                                            
        $response = $principal->getTabla($dataDB); 
        return $this->respond($response->data);
    }
    public function reportes()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        $data['scripts'] = array('principal','inicio');
        $data['edita']   = 0;
        $data['contentView'] = 'secciones/vReporteMensual';                
        $this->_renderView($data);
    }
    public function validarDocumento()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        if($session->id_perfil == '1' || $session->id_perfil == '2' ){
            $usuario = $principal->getTabla(['tabla' => 'usuario', 'where' =>['visible' => 1,'id_perfil' => 4]]);
            $data['usuario'] = $usuario->data; 
        }                      
        if($session->id_perfil == 3){
            $usuario = $principal->getTabla(['tabla' => 'usuario', 'where' =>['visible' => 1, 'id_dependencia' =>  $session->id_dependencia, 'id_perfil' => 4]]);
            $data['usuario'] = $usuario->data; 
        }   
     
        $data['scripts'] = array('principal','inicio');
        $data['edita']   = 0;
        $data['contentView'] = 'secciones/vPracticantesDocumento';                
        $this->_renderView($data);
    }
    public function estudianteCV()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        if($session->id_dependencia == -1){
            $catDependencia = $principal->getTabla(['tabla' => 'cat_dependencia', 'where' =>['visible' => 1 ]]);
            $data['cat_dependencia'] = $catDependencia->data; 
        }else{
            $catDependencia = $principal->getTabla(['tabla' => 'cat_dependencia', 'where' =>['visible' => 1, 'id_dependencia' => $session->id_dependencia ]]);
            $data['dependencia'] = $catDependencia->data[0]->dsc_dependencia; 
 
        }                         
        $data['scripts'] = array('principal','inicio');
        $data['edita']   = 0;
        $data['contentView'] = 'secciones/vCvs';                
        $this->_renderView($data);
    }
    public function getPrincipal()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        $dataDB = ( $session->get('id_perfil') == 1)?array('tabla' => 'usuario', 'where' => ['visible' => 1]):
                                                     array('tabla' => 'usuario', 'where' => ['visible' => 1, 'id_perfil' => 3]);  

        
        
        
       
        $response = $principal->getTabla($dataDB); 
        foreach ($response->data as $d) {
            $d->nombre_completo = $d->nombre . ' ' . $d->primer_apellido . ' ' . $d->segundo_apellido;
            switch($d->id_perfil)
            {
              case 1:
                $d->dsc_perfil = 'ADMINISTRADOR';
                break;
              case 2:
                $d->dsc_perfil = 'GESTOR';
                break;
              case 3:
                $d->dsc_perfil = 'ENLACE';
                break;
                case 4:
                    $d->dsc_perfil = 'PRACTICANTE';
                    break;
            }
            $catDependencia = $principal->getTabla(['tabla' => 'cat_dependencia', 'where' =>['visible' => 1, 'id_dependencia' =>$d->id_dependencia ]]);
            $d->dsc_dependencia = (!empty($catDependencia->data))?$catDependencia->data[0]->dsc_dependencia:'';
        }
      
         return $this->respond($response->data);
    }

    public function pdfDependencia(){
        $session = \Config\Services::session();
        setlocale(LC_TIME, 'es_ES');
        $catalogos = new Mglobal;

        $id_practicante= $this->request->getGet('id_practicante');
   
        $data = [];
        $dataDB = array('tabla' => 'practicante', 'where' => 'id_practicante= "'.$id_practicante.'" AND visible = 1');
        $response = $catalogos->getTabla($dataDB);
        $dataImagen = $this->encode_img_base64(FCPATH .'assets/images/encabezado.png', 'png');
     
        $data['dataImagen'] = $dataImagen;
        $data['datos'] = $response->data[0];
        $data['licenciatura'] =  $catalogos->getTabla(['tabla' => 'cat_licenciatura', 'where' => ['id_licenciatura' => $response->data[0]->licenciatura, 'visible' => 1]])->data[0];

        $view = 'pdfs/vpdfTurno.php';
        $mpdf = new \Mpdf\Mpdf([
            'margin_top' => 0,
            'margin_left' => 1,
            'margin_right' => 1,
            'format' => 'Letter', // Cambiar de 'Legal' a 'Letter'
            'mirrorMargins' => false,
        ]);

        $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(base_url()."/index.php/Login/index?doc=". $session->id_dependencia."")
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(400)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        //->logoPath(__DIR__.'/assets/symfony.png')
        ->labelText('')
        ->labelFont(new NotoSans(16))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();

        $filePath = FCPATH . 'uploads/qr_codes/qr_code_' .$session->id_dependencia . '.png'; // Ruta donde guardar el archivo
        $result->saveToFile($filePath);
        $data['filePath'] = $filePath;
        // Generar el PDF
        $html = view($view, $data);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // Descargar el PDF directamente
        exit;
    }
    private function encode_img_base64($file, $type) {
        if (file_exists($file)) {
            $imgData = base64_encode(file_get_contents($file));
            return 'data:image/' . $type . ';base64,' . $imgData;
        }
        return '';
    }
    

    
}