<?php namespace App\Controllers;
use CodeIgniter\Controller;

use App\Libraries\Fechas;
use App\Models\Mglobal;
//use App\Libraries\Validasesion;
//use App\Libraries\Globals;
use stdClass;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController {

    use ResponseTrait;
    private $defaultData = array(
        'title' => 'Sitema de Turnos 2.0',
        'layout' => 'plantilla/lytDefault',
        'contentView' => 'vUndefined',
        'stylecss' => '',
    );
    public function __construct()
    {
        //fechas php en espanol
        setlocale(LC_TIME, 'es_ES.utf8', 'es_MX.UTF-8', 'es_MX', 'esp_esp', 'Spanish'); // usar solo LC_TIME para evitar que los decimales los separe con coma en lugar de punto y fallen los inserts de peso y talla
        date_default_timezone_set('America/Mexico_City');  
        $session = \Config\Services::session();        
    }

    private function _renderView($data = array()) {   
        /*if(isset($data['scripts'])){
            array_push($data['scripts'], "notificaciones");
        }*/    
        $data = array_merge($this->defaultData, $data);
        echo view($data['layout'], $data);               
    }

    public function index()
    {        
        $session = \Config\Services::session();
        $globals = new Mglobal;
        $data = array();
        $idDoc = $this->request->getGet('doc');
       
        if(isset($idDoc) && !empty($idDoc)){
            $data['dependencia'] = $idDoc;  
            $data['layout'] = 'plantilla/lytLogin';
            $data['contentView'] = 'secciones/vVacio';                           
            $this->_renderView($data); 
            die();
        }
       
       
        if ($this->request->getFile('file')) {
           
            try {
                $file           = $this->request->getFile('file');
                $id_dependencia = $this->request->getPost('id_dependencia');
                $nombre_login   = $this->request->getPost('nombre_login');
                $curp_login     = $this->request->getPost('curp_login');
                $matricula      = $this->request->getPost('matricula');
                // Validar tipo de archivo
                if (!$file->isValid() || $file->getMimeType() !== 'application/pdf') {
                    $response['error'] = true;
                    $response['message'] = 'El archivo debe ser un PDF válido';
                    return $this->response->setJSON($response);
                }
        
                // Guardar archivo
                $newName = $file->getRandomName(); // Genera un nombre único
                $originalName = $file->getClientName();
                $size = $file->getSize();
                $mimeType = $file->getMimeType();

                
               
                $dep = $globals->getTabla(['tabla' => 'cat_dependencia', 'where' => ['id_dependencia' => $id_dependencia, 'visible' => 1]]);
              
                $datos = [
                    'nombre'        => $nombre_login,
                    'curp'          => $curp_login,
                    'matricula'     => $matricula,
                    'folio'         => $dep->data[0]->dsc_corto.'-'.$curp_login,
                    'archivo'       => $originalName,
                    'tamanio'       => $size,
                    'tipo'          => $mimeType,
                    'ruta_relativa' => WRITEPATH . 'uploads/' . $newName,
                    'ruta_absoluta' => 'assets/pdf/' . $newName,
                    'id_dependencia' => $id_dependencia,
                ];
        
                $dataConfig = [
                    "tabla" => "archivo_cv",
                    "editar" => false
                ];
                $dataBitacora = ['id_user' => 7, 'script' => 'Agregar.php/guardaArchivo'];
                
                $globals = new Mglobal();
                $result = $globals->saveTabla($datos, $dataConfig, $dataBitacora);

                $file->move(FCPATH . 'assets/pdf/', $newName); 
                $response['message'] = 'Archivo subido correctamente: ' . $newName;
                return $this->response->setJSON($response);
        
            } catch (\Exception $e) {
                $response['error'] = true;
                $response['message'] = 'Error al subir el archivo: ' . $e->getMessage();
                return $this->response->setJSON($response);
            }
        }
        if ($session->get('logueado')==1) {
            header('Location:' . base_url() . 'index.php/Inicio');
            die();
        }
        //$data['scripts'] = array('principal','somatometria');   
        $data['scripts'] = array('principal');
        $data['layout'] = 'plantilla/lytLogin';
        $data['contentView'] = 'secciones/vLogin';                
        $this->_renderView($data); 
            
    }
    public function validar_usuario(){
        $session = \Config\Services::session();
        $catalogos = new Mglobal;
        
        $usuario = $this->request->getPost('usuario');
        $contrasenia = $this->request->getPost('contrasenia');

        $data = array();
       // $dataDB = array('tabla' => 'usuario', 'where' => 'usuario ="'.$usuario.'" and contrasenia like "'.md5($contrasenia).'" and visible = 1'); 
      
        $dataDB = array('tabla' => 'usuario', 'where' => ['usuario' => $usuario, 'contrasenia' => md5($contrasenia), 'visible' => 1]);  
        
        if($usuario && $contrasenia){
            $response = $catalogos->getTabla($dataDB);
            //die(print_r($response));
            if(sizeof($response->data) >= 1){
                $session->set('logueado', 1);
                $session->set('id_dependencia',$response->data[0]->id_dependencia);
                $session->set('id_usuario',$response->data[0]->id_usuario);
                $session->set('usuario',$response->data[0]->usuario);
                $session->set('nombre_completo',$response->data[0]->nombre." ".$response->data[0]->primer_apellido." ".$response->data[0]->segundo_apellido);
                $session->set('id_perfil',$response->data[0]->id_perfil);
                $session->set('cambio_password',$response->data[0]->cambio_pass);
                die("correcto");
            }else{
                die("error");
            }            
        }        
      
        die("error");

    }
    public function cerrar() {
        $session = \Config\Services::session();  
        $session->destroy();
        $session->set('logueado', 0);        
        header('Location:'.base_url());
        die();
    }
    
    /**
     * Obtiene el nombre del navegador que esta usando el usuario
     * @param type $user_agent La variable del servidor $_SERVER['HTTP_USER_AGENT']
     * @return string El nombre del navegador
     */
    function get_browser_name($user_agent) {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/'))
            return 'Opera';
        elseif (strpos($user_agent, 'Edge'))
            return 'Edge';
        elseif (strpos($user_agent, 'Chrome'))
            return 'Chrome';
        elseif (strpos($user_agent, 'Safari'))
            return 'Safari';
        elseif (strpos($user_agent, 'Firefox'))
            return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7'))
            return 'Internet Explorer';

        return $user_agent;
    }
    
    function ServerVar($Name) {
        $str = @$_SERVER[$Name];
        if (empty($str)) $str = @$_ENV[$Name];
        return $str;
    }
    
    function miDebug($msg) {
        $filename = ".debug.txt";
        if (!$handle = fopen($filename, 'a'))
                exit;
        if (is_writable($filename)) {
                $separador = "================================================================================";
                fwrite($handle, "" . $msg . "\n" . $separador . "\n\n");
        }
        fclose($handle);
    }
    
}