<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;
//use App\Libraries\Validasesion;
//use App\Libraries\Globals;
use stdClass;
use CodeIgniter\API\ResponseTrait;

class Principal extends BaseController {

    use ResponseTrait;
    private $defaultData = array(
        'title' => 'Junta de Gobierno ISAPEG',
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
        //$validasesion = new Validasesion();
        //$this->globals = new Globals();
        
        /* if($session->get('logueado')!= 1){
            header('Location:'.base_url().'/index.php/Login/cerrar');            
            die();
        }else{
            //Comprobar sesión activa
            //$resp = $validasesion->sesion_activa($session->get('id_usuario'), ID_SISTEMA);            
            /*if($resp !=1){
                header('Location:'.base_url().'/index.php/Login');            
                die();
            }*/

       // } */
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

        // $Mglobal = new Mglobal();
        // $funciones = new Funciones();

        /* if ($session->id_perfil == IP_GESTOR_UNIDAD){
            $data['actividades'] = $Mglobal->getTabla(["tabla"=>"vw_actividad_auditoria vaa", "where"=>"vaa.id_unidad_responsable = 1 AND vaa.validada = 0 AND vaa.id_documento_final IS NULL", "order" => "fecha_limite_entrega_informacion ASC"]);

            foreach ($data['actividades']->data as $item) {
                $item->id_actividad = $funciones->encrypt($item->id_actividad);
            }

            $data['auditorias'] = $Mglobal->getTabla(["tabla"=>"vw_actividad_auditoria vaa", "where"=>"vaa.id_unidad_responsable = 1 AND vaa.validada = 0 AND vaa.id_documento_final IS NULL", "order" => "fecha_limite_entrega_informacion ASC", "groupBy"=>"id_auditoria"]);
        }else{
            $data['seguimiento'] = 0;
            $data['proximas'] = $Mglobal->getTabla(["select"=>"COUNT(*) AS contador" ,"tabla" => "vw_requerimiento vr", "where"=>"DATEDIFF(vr.fecha_limite , NOW()) < 5 AND vr.vigente = 1"]);
            $data['activas'] = $Mglobal->getTabla(["select"=>"COUNT(*) AS contador" ,"tabla" => "vw_auditoria va", "where"=>"va.id_documento_final IS NULL"]);
            $data['concluidas'] = $Mglobal->getTabla(["select"=>"COUNT(*) AS contador" ,"tabla" => "vw_auditoria va", "where"=>"va.id_documento_final IS NOT NULL"]);
        } */

        $data['scripts'] = array('principal');
        $data['edita'] = 0;
        $data['contentView'] = 'secciones/vVacio';                
        $this->_renderView($data);
        
    }
  
}