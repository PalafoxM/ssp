<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;

use stdClass;
use CodeIgniter\API\ResponseTrait;

class Principal extends BaseController {

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
        $data['scripts'] = array('principal');
        $data['edita'] = 0;
        $data['contentView'] = 'secciones/vVacio';                
        $this->_renderView($data);
        
    }
    public function guardarParticipantes()
    {
        $response = new \stdClass();
        $session = \Config\Services::session();
        $data = $this->request->getPost();
        $response->error = true;
        $response->respuesta = "Error al guardar el registro";
        $globals = new Mglobal;
        if($data['editar']!=1){
            $usuario = $globals->getTabla(['tabla' => 'usuario', 'where' =>['visible' => 1, 'curp' => $data['curp'] ]])->data;
            if( isset($usuario[0]) && !empty($usuario[0]) ){
                $response->respuesta = "la curp ya existe en la base de datos, favor de consultar";
                return $this->respond($response);
            }
        }
      
        if($data['contrasenia'] != $data['confir_contrasenia'] ){
            $response->respuesta = "las contraseñas no coinciden, favor de verificar";
            return $this->respond($response);
        }
        if( empty($data['contrasenia']) || empty($data['confir_contrasenia']) ){
            $response->respuesta = "El campo de contraseña es requerido";
            return $this->respond($response);
        }
        if( empty($data['correo']) ){
            $response->respuesta = "El campo de correo es requerido";
            return $this->respond($response);
        }
        if( empty($data['nombre']) ){
            $response->respuesta = "El campo de nombre es requerido";
            return $this->respond($response);
        }
        if( empty($data['primer_apellido']) ){
            $response->respuesta = "El campo de primer apellido es requerido";
            return $this->respond($response);
        }
        if( empty($data['curp']) ){
            $response->respuesta = "El campo CURP es requerido";
            return $this->respond($response);
        }
        if( $data['id_sexo'] == '0' ){
            $response->respuesta = "El campo de SEXO es requerido";
            return $this->respond($response);
        }
        if( $data['id_perfil'] == '0'){
            $response->respuesta = "El campo de Perfil es requerido";
            return $this->respond($response);
        }
        if( $data['id_dependencia'] == '0'){
            $response->respuesta = "El campo de Dependencia es requerido";
            return $this->respond($response);
        }

        $usuarios = [
            'id_sexo'         =>  (int)$data['id_sexo'],
            'id_perfil'       =>  (int)$data['id_perfil'], 
            'id_dependencia'  =>  (int)$data['id_dependencia'], 
            'nombre'          =>  $data['nombre'], 
            'correo'          =>  $data['correo'], 
            'primer_apellido' =>  $data['primer_apellido'], 
            'segundo_apellido'=>  $data['segundo_apellido'], 
            'contrasenia'     =>  md5($data['contrasenia']), 
            'usuario'         =>  $data['curp'], 
            'curp'         =>  $data['curp'], 
            'usu_reg'         =>  $session->get('id_usuario'),
            'fec_reg'         =>  date('Y-m-d H:i:s'),

        ]; 
        if($data['editar'] == 0){
            $dataConfig = [
                "tabla"=>"usuario",
                "editar"=>false
               // 'idEditar' => ['id_participante' => (int)$id_participante ],
            ];
    
            /* $email  = \Config\Services::email();
            $email->clear();
            $email->initialize([
                'protocol'    => 'smtp',
                'SMTPHost'    => 'smtp.gmail.com',
                'SMTPUser'    => 'palafox.marin31@gmail.com',  // Tu correo
                'SMTPPass'    => 'PalafoxMarin1989',  // Contraseña o contraseña de aplicación
                //'SMTPPass'    => 'iezw qaqs mbbz svjw',  // Contraseña o contraseña de aplicación
                'SMTPPort'    => 587,  // Puerto SMTP
                'SMTPCrypto'  => 'tls', // TLS para conexión segura
                'mailType'    => 'html', // Tipo de correo: HTML o texto
                'charset'     => 'utf-8',
                'wordWrap'    => true,
            ]);
            $email->setFrom('palafox.marin31@gmail.com', 'AGUSTIN PALAFOX'); // Remitente
            //$email->setFrom('palafox.marin31@gmail.com', $name);
            $email->setTo('palafox.marin@hotmail.com');
            $email->setSubject('Asunto del correo');            // Asunto
            $email->setMessage('<b>Este es un mensaje de prueba</b>'); // Contenido HTML
         
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            if ($email->send()) {
                echo 'Correo enviado correctamente';
            } else {
                $data = $email->printDebugger(['headers', 'subject', 'body']);
                echo 'No se pudo enviar el correo. Detalles: <br>' . $data;
            }  */
        }else{
            $dataConfig = [
                "tabla"=>"usuario",
                "editar"=>true,
                'idEditar' => ['id_usuario' => (int)$data['id_usuario'] ],
            ];
        }
        $dataBitacora = ['id_user' => $session->get('id_usuario'), 'script' => 'Agregar.php/guardaUsuario'];
        $result = $globals->saveTabla($usuarios, $dataConfig, $dataBitacora);
        if(!$result->error){
            $response->error = $result->error;
            $response->respuesta = $result->respuesta;
        }
     
      
        return $this->respond($response);
    } 
    public function guardarPracticante()
    {
        $response = new \stdClass();
        $session = \Config\Services::session();
        $data = $this->request->getPost();
        $response->error = true;
        $response->respuesta = "Error al guardar el registro";
        $globals = new Mglobal;
        //die( var_dump($session->get('id_usuario')) );
        $user = $globals->getTabla(['tabla' => 'usuario', 'where' =>['visible' => 1, 'id_usuario' => $session->get('id_usuario') ]])->data[0];

        if(isset($user) && $user->id_dependencia == -1){
            $response->respuesta = "Atencion el Admministrador no puede realizar un registro, solo los enlaces";
            return $this->respond($response);
        }
        $cat_dependencia = $globals->getTabla(['tabla' => 'cat_dependencia', 'where' =>['visible' => 1, 'id_dependencia' => $user->id_dependencia ]])->data[0];
        if( $data['licenciatura'] == '0' ){
            $response->respuesta = "El campo de licenciatura es requerido";
            return $this->respond($response);
        }
        $cat_licenciatura = $globals->getTabla(['tabla' => 'cat_licenciatura', 'where' =>['visible' => 1, 'id_licenciatura' => (int)$data['licenciatura'] ]])->data[0];
        if( empty($data['nombre']) ){
            $response->respuesta = "El campo de solicitante es requerido";
            return $this->respond($response);
        }
        if( empty($data['correo']) ){
            $response->respuesta = "El campo de correo es requerido";
            return $this->respond($response);
        }
        if( empty($data['puesto']) ){
            $response->respuesta = "El campo de puesto es requerido";
            return $this->respond($response);
        }
        if( empty($data['oficina']) ){
            $response->respuesta = "El campo de oficina es requerido";
            return $this->respond($response);
        }
        if( empty($data['domicilio']) ){
            $response->respuesta = "El campo de domicilio es requerido";
            return $this->respond($response);
        }
        if( empty($data['proyecto']) ){
            $response->respuesta = "El campo de proyecto es requerido";
            return $this->respond($response);
        }
        if( empty($data['descripcion']) ){
            $response->respuesta = "El campo de descripcion es requerido";
            return $this->respond($response);
        }
        if( empty($data['beneficios']) ){
            $response->respuesta = "El campo de beneficios es requerido";
            return $this->respond($response);
        }
        if( $data['modalidad'] == '0' ){
            $response->respuesta = "El campo de modalidad es requerido";
            return $this->respond($response);
        }
        if( $data['campus'] == '0' ){
            $response->respuesta = "El campo de campus es requerido";
            return $this->respond($response);
        }
        $campus = ($data['campus']== 1)?'CG':'CL';

        $practicante = [
            'modalidad'       =>  (int)$data['modalidad'],
            'campus'          =>  (int)$data['campus'],
            'licenciatura'    =>  (int)$data['licenciatura'],
            'id_dependencia'  =>  (int)$user->id_dependencia,
            'numero_prac'     =>  (int)$data['numero_prac'], 
            'folio'           =>  $cat_dependencia->dsc_corto.'-00'.$cat_dependencia->id_dependencia.'/'. $campus.'-'.substr($cat_licenciatura->dsc_licenciatura, 16) , 
            'nombre'          =>  $data['nombre'], 
            'correo'          =>  $data['correo'], 
            'puesto'          =>  $data['puesto'],  
            'oficina'         =>  $data['oficina'], 
            'domicilio'       =>  $data['domicilio'], 
            'telefono'        =>  $data['telefono'], 
            'proyecto'        =>  $data['proyecto'], 
            'dias'            =>  $data['dias'], 
            'hora'            =>  $data['hora'], 
            'descripcion'     =>  $data['descripcion'], 
            'beneficios'      =>  $data['beneficios'], 
            'actividad'       =>  $data['actividad'], 
            'conocimiento'    =>  $data['conocimiento'], 
            'usu_reg'         =>  $session->get('id_usuario'),
            'fec_reg'         =>  date('Y-m-d H:i:s'),

        ]; 
        if($data['editar'] == 0){
            $dataConfig = [
                "tabla"=>"practicante",
                "editar"=>false
               // 'idEditar' => ['id_participante' => (int)$id_participante ],
            ];
        }else{
            $dataConfig = [
                "tabla"=>"practicante",
                "editar"=>true,
                'idEditar' => ['id_practicante' => (int)$data['id_practicante'] ],
            ];
        }
        $dataBitacora = ['id_user' => $session->get('id_usuario'), 'script' => 'Agregar.php/guardaPracticante'];
        $result = $globals->saveTabla($practicante, $dataConfig, $dataBitacora);
        if(!$result->error){
            $response->error = $result->error;
            $response->respuesta = $result->respuesta;
        }
     
      
        return $this->respond($response);
    } 
    public function guardarCargaParticipante()
    {
        $response = ['error' => true, 'message' => ''];
        $session = \Config\Services::session();
    
        $requiredFiles = [
            'curp_archivo' => 'El archivo CURP es requerido.',
            'fiscal_archivo' => 'El archivo Situación Fiscal es requerido.',
            'comprobante' => 'El archivo Comprobante de domicilio es requerido.',
            'edo_cuenta' => 'El archivo Estado de cuenta es requerido.',
            'identificacion' => 'El archivo identificación es requerido.',
            'acta' => 'El archivo acta es requerido.',
            'constancia' => 'El archivo constancia es requerido.',
            'facultativo' => 'El archivo facultativo es requerido.',
            'escolares' => 'El archivo escolares es requerido.'
        ];
    
        foreach ($requiredFiles as $fieldName => $errorMessage) {
            $file = $this->request->getFile($fieldName);
    
            // Verificar si el archivo existe
            if ($file === null) {
                $response['error'] = true;
                $response['message'] = "No se encontró el archivo para el campo: $fieldName.";
                return $this->response->setJSON($response);
            }
    
            // Validar archivo
            if (!$file->isValid()) {
                $response['error'] = true;
                $response['message'] = $errorMessage;
                return $this->response->setJSON($response);
            }
    
            // Validar tipo MIME
            if (!in_array($file->getMimeType(), ['application/pdf'])) {
                $response['error'] = true;
                $response['message'] = "El archivo para $fieldName debe ser un PDF.";
                return $this->response->setJSON($response);
            }
    
            // Procesar archivo
            $newName = $file->getRandomName();
            $originalName = $file->getClientName();
            $size = $file->getSize();
            $mimeType = $file->getMimeType();
    
            $file->move(FCPATH . 'assets/pdf/practicante/', $fieldName.'_'.$newName);
    
            $datos = [
                'id_usuario' => $session->id_usuario,
                'nombre' => $fieldName,
                'ruta_absoluta' => FCPATH . 'assets/pdf/practicante/' . $fieldName.'_'.$newName,
                'ruta_relativa' => 'assets/pdf/practicante/' . $fieldName.'_'.$newName,
                'tipo' => $mimeType,
                'tamanio' => $size,
            ];
    
            $dataConfig = [
                "tabla" => "documento",
                "editar" => false
            ];
    
            $dataBitacora = ['id_user' => 7, 'script' => 'Agregar.php/guardaArchivo'];
    
            $globals = new Mglobal();
            $result = $globals->saveTabla($datos, $dataConfig, $dataBitacora);
            if (!$result) {
                $response['error'] = true;
                $response['message'] = 'Hubo un problema al guardar los datos en la base de datos.';
                return $this->response->setJSON($response);
            }
        }
    
        $response['error'] = false;
        $response['message'] = 'Archivos guardados correctamente.';
        return $this->response->setJSON($response);
    }
          
}