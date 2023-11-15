<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
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
        $data = array();
        if ($session->get('logueado')==1) {
            header('Location:' . base_url() . '/index.php/Principal');
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
        $Mglobal = new Mglobal;
        
        $usuario = $this->request->getPost('usuario');
        $contrasenia = $this->request->getPost('contrasenia');

        $data = array();
        $dataDB = array('tabla' => 'usuarios', 'where' => 'usuario ="'.$usuario.'" and contrasenia = "'.md5($contrasenia).'" and visible = 1');  
        
        if($usuario && $contrasenia){
            $response = $Mglobal->getTabla($dataDB);
            if(sizeof($response->data) >= 1) {
                // obtener perfil del usuario
                $perfil = $Mglobal->getTabla(['tabla' => 'usuario_perfil', 'where' => ['id_usuario' => $response->data[0]->id_usuario, 'visible' => 1]]);
                if(!$perfil->data) die("error");

                
                // $sistemaActivo = $Mglobal->getTabla(['tabla'=>'configuracion', 'where'=>['dsc_configuracion'=>"sistemaActivo"] ])->data;
                // if ($perfil->data[0]->id_perfil != 1 && $sistemaActivo[0]->valor != 1){
                //     die("error");
                // }
                
                // Registrar login en bitacora de accesos
                // $dataInsert= [
                //     'usuario' => $usuario,
                //     'contrasena' => '',
                //     'logokerror' => '1',
                //     'hora' => date('Y-m-d H:i:s'),
                //     'ip' => $this->ServerVar("REMOTE_ADDR"),
                //     'browser' => $this->get_browser_name($this->ServerVar("HTTP_USER_AGENT"))
                // ];

                // $dataConfig = [
                //     "tabla" => "bitacora_accesos",
                //     "editar"=> false,
                // ];
                // $bitacora = $Mglobal->saveTabla($dataInsert,$dataConfig,['script'=>'Login.validarUsuario']);

                $session->set('id_perfil', $perfil->data[0]->id_perfil);
                $session->set('logueado', 1);
                $session->set('id_usuario',$response->data[0]->id_usuario);
                $session->set('usuario',$response->data[0]->usuario);
                $session->set('nombre_completo',$response->data[0]->nombre." ".$response->data[0]->primer_apellido." ".$response->data[0]->segundo_apellido);
                //$session->set('id_perfil',$response->data[0]->id_perfil);
                $session->set('id_unidad_responsable',$response->data[0]->id_unidad_responsable);
                //$session->set('dsc_unidad',$response->data[0]->id_perfil);
                //$session->set('foto_perfil',$response->data[0]->ruta_foto);
                //$session->set('dsc_perfil',$response->data[0]->dsc_perfil);
                
                die("correcto");
            }else{
                // Registrar login en bitacora de accesos
                // $dataInsert= [
                //     'usuario' => $usuario,
                //     'contrasena' => $contrasenia,
                //     'logokerror' => '0',
                //     'hora' => date('Y-m-d H:i:s'),
                //     'ip' => $this->ServerVar("REMOTE_ADDR"),
                //     'browser' => $this->get_browser_name($this->ServerVar("HTTP_USER_AGENT"))
                // ];

                // $dataConfig = [
                //     "tabla" => "bitacora_accesos",
                //     "editar"=> false,
                // ];
                // $bitacora = $Mglobal->saveTabla($dataInsert,$dataConfig,['script'=>'Login.validarUsuario']);
                // die("error");
            }            
        }        
        //Solicitar a la base de datos

        /*$session->set('logueado', 1);
        $session->set('id_usuario',$response->id_usuario);
        $session->set('id_persona',$response->id_persona);
        $session->set('usuario',$response->usuario);        */
        die("error");

    }
    public function cerrar() {
        $session = \Config\Services::session();  
        $session->destroy();
        $session->set('logueado', 0);        
        header('Location:'.base_url());
        //header('Location:' . base_url());
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