<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;

use stdClass;
use CodeIgniter\API\ResponseTrait;
require_once FCPATH . '/mpdf/autoload.php';
class Usuario extends BaseController {

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
        $this->globals = new Mglobal();
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
        $data['unidad'] = $this->globals->getTabla(["tabla"=>"cat_clues","select"=>"id_clues, NOMBRE_UNIDAD", "where"=>["visible"=>1],'limit' => 10]); 
        $data['perfiles'] = $this->globals->getTabla(["tabla"=>"seg_perfiles", "where"=>["visible"=>1]]); 
        $data['cat_sexo'] = $this->globals->getTabla(["tabla"=>"cat_sexo", "where"=>["visible"=>1]]); 
        $data['scripts'] = array('principal','inicio');
        $data['edita'] = 0;
        $data['nombre_completo'] = $session->nombre_completo; 
        $data['contentView'] = 'secciones/vUsuarios';                
        $this->_renderView($data);
        
    }
    
    public function getUsuarios()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        $dataDB = array();
        if ($session->id_perfil == 1) {
            $dataDB = array('tabla' => 'usuario', 'where' => 'id_perfil >= 1 AND visible = 1 ORDER BY fecha_registro DESC');
        } elseif ($session->id_perfil >= 2) {
            $dataDB = array('tabla' => 'usuario', 'where' => 'id_perfil >= 1 AND visible = 1 ORDER BY fecha_registro DESC');
        } 
        $response = $principal->getTabla($dataDB);
        // var_dump($response);
        // die();
        return $this->respond($response->data);
    }
    public function getDocumento()
    {
        $session = \Config\Services::session();
        $principal = new Mglobal;
        $id_usuario = $this->request->getPost('id_usuario');
        $dataDB = array();
      
        if ($session->id_perfil == '1' || $session->id_perfil == '2') {
            $dataDB = array('tabla' => 'vw_practicante', 'where' => ['visible' => 1, 'id_usuario'=> $id_usuario]);
        }else  {
            $dataDB = array('tabla' => 'vw_practicante', 'where' => ['id_usuario'=> $id_usuario ,'id_dependencia'=> $session->id_dependencia, 'visible' => 1]);
        } 
        $response = $principal->getTabla($dataDB);
        // var_dump($response);
        // die();
        return $this->respond($response->data);
    }
    public function getUsuario()
    {
        $session = \Config\Services::session();
        $id_usuario = $this->request->getPost('id_usuario');
        
        // Validar que el ID de usuario esté presente y sea válido
        if (!$id_usuario) {
            return $this->fail('ID de usuario no proporcionado', 400);
        }

        // var_dump($id_usuario);
        // die();
        $response = $this->globals->getTabla(["tabla"=>"usuario", "select"=>"id_usuario, usuario, contrasenia, id_perfil,curp, nombre, primer_apellido, segundo_apellido,id_dependencia, id_sexo, correo" ,"where"=>["id_usuario" => $id_usuario, "visible" => 1]])->data;
        // var_dump($response[0]);
        // die();
        return $this->respond($response[0]);
    }
    public function deleteUsuario()
    {
        $response = new \stdClass();
        $response->error = true;
        $data = $this->request->getPost();

        if (!isset($data['id_usuario']) || empty($data['id_usuario'])){
            $response->respuesta = "No se ha proporcionado un identificador válido";
            return $this->respond($response);
        }

        $dataConfig = [
            "tabla"=>"usuario",
            "editar"=>true,
            "idEditar"=>['id_usuario'=>$data['id_usuario']]
        ];
        $response = $this->globals->saveTabla(["visible"=>0],$dataConfig,["script"=>"Usuario.deleteUsuario"]);
        return $this->respond($response);
    }
    public function eliminarPracticante()
    {
        $response = new \stdClass();
        $response->error = true;
        $id_practicante = $this->request->getPost('id_practicante');

        if (!isset($id_practicante) || empty($id_practicante)){
            $response->respuesta = "No se ha proporcionado un identificador válido";
            return $this->respond($response);
        }

        $dataConfig = [
            "tabla"=>"practicante",
            "editar"=>true,
            "idEditar"=>['id_practicante'=>$id_practicante]
        ];
        $response = $this->globals->saveTabla(["visible"=>0],$dataConfig,["script"=>"Usuario.deletePracticante"]);
        return $this->respond($response);
    }
    public function UpdateUsuario()
    {
        $response = new \stdClass();
        $response->error = true;
        $data = $this->request->getPost();
        // var_dump(isset($data['editar']));
        // die();
        
        $dataInsert=[       
            'usuario' => $data['usuario'],
            'contrasenia' => md5($data['contrasenia']),
            'correo' => $data['correo'],
            'id_perfil' => $data['perfil'],
            'id_sexo' => $data['sexo'],
            'nombre' =>$data['nombre'],
            'primer_apellido' => $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'],
            'id_clues' => $data['id_clues'],
        ];
        // var_dump($dataInsert);
        // die();
        if (isset($data['editar'])){
            $dataConfig = [
                "tabla"=>"seg_usuarios",
                "editar"=>false,
                //  "idEditar"=>['id_usuario'=>$data['id_usuario']]
            ];  
      
        }else{
            $dataConfig = [
                "tabla"=>"seg_usuarios",
                "editar"=>true,
                 "idEditar"=>['id_usuario'=>$data['id_usuario']]
            ];
        }
        

        $response = $this->globals->saveTabla($dataInsert,$dataConfig,["script"=>"Usuario.saveUsuario"]);
        return $this->respond($response);
    }
    public function guardarComentario()
    {
        $response = new \stdClass();
        $response->error = true;
        $data = $this->request->getPost();
        $dataInsert=[       
            'comentario' => $data['comentario'],
           
        ];
        $dataConfig = [
            "tabla"=>"archivo_cv",
            "editar"=>true,
             "idEditar"=>['id_archivo_cv'=>$data['id_archivo_cv']]
        ];
        $response = $this->globals->saveTabla($dataInsert,$dataConfig,["script"=>"Usuario.saveUsuario"]);
        return $this->respond($response);
         
    }
    public function editarArchivo()
    {
        $session = \Config\Services::session();
        $globals = new Mglobal;
        $data = array(); 
        if ($this->request->getFile('file')) {
            try {
                $file           = $this->request->getFile('file');
                $id_documento   = $this->request->getPost('id_documento');
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
    
                $datos = [
                    'tamanio' => $size,
                    'tipo' => $mimeType,
                    'ruta_absoluta' => WRITEPATH . 'uploads/pdf/practicante/' . $newName,
                    'ruta_relativa' => 'assets/pdf/practicante/' . $newName,
                    'valido' => 0
                ];
        
                $dataConfig = [
                    "tabla"        => "documento",
                    "editar"       => true,
                    "idEditar"     =>["id_documento" => (int)$id_documento]
                ];
                $dataBitacora = ['id_user' => 7, 'script' => 'Agregar.php/guardaArchivo'];
           
                $result = $globals->saveTabla($datos, $dataConfig, $dataBitacora);

                $file->move(FCPATH . 'assets/pdf/practicante/', $newName); 
                $response['message'] = 'Archivo subido correctamente: ' . $newName;
                return $this->response->setJSON($result);
        
            } catch (\Exception $e) {
                $response['error'] = true;
                $response['message'] = 'Error al subir el archivo: ' . $e->getMessage();
                return $this->response->setJSON($response);
            }
        }
    }
    public function guardarComentarioDoc()
    {
        $response = new \stdClass();
        $response->error = true;
        $data = $this->request->getPost();
        if($data['id']==1){
            $dataInsert=[       
                'valido'      => $data['id'], 
            ];
        }else{
            $dataInsert=[       
                'comentarios' => $data['comentario'],
                'valido'      => $data['id']
               
            ];
        }
       
        $dataConfig = [
            "tabla"=>"documento",
            "editar"=>true,
            "idEditar"=>['id_documento'=>$data['id_documento']]
        ];
        $response = $this->globals->saveTabla($dataInsert,$dataConfig,["script"=>"Usuario.saveDocumento"]);
        return $this->respond($response);
         
    }
    public function cambioEstatus()
    {
        $response = new \stdClass();
        $response->error = true;
        $id_archivo_cv = $this->request->getPost('id_archivo_cv');
        $id            = $this->request->getPost('id');
        $dataInsert=[       
            'estatus' => $id,
           
        ];
        $dataConfig = [
            "tabla"=>"archivo_cv",
            "editar"=>true,
             "idEditar"=>['id_archivo_cv'=> $id_archivo_cv]
        ];
        $response = $this->globals->saveTabla($dataInsert,$dataConfig,["script"=>"Usuario.saveUsuario"]);
        return $this->respond($response);
         
    }
    public function saveUsuario()
    {
        $response = new \stdClass();
        $response->error = true;
        $data = $this->request->getPost();
        var_dump($data['id_usuario']);
        die();
        // if (!isset($data['id_usuario']) || empty($data['id_usuario'])){
        //     $response->respuesta = "No se ha proporcionado un identificador válido";
        //     return $this->respond($response);
        // }
        // $dataInsert=[
        //     'dsc_carpeta'          => $dsc_carpeta,
        //     'id_carpeta_padre'  => $id_carpeta_raiz,
        //     'id_unidad'           => $id_unidad,
        //     'ruta'           => $ruta_raiz.'/'.$nombre_unix,
        //     'ruta_real'       => $ruta_carpeta_fisica,
        //     'fecha_registro'       => date('Y-m-d H:i:s'),
        //     'usuario_registro' => $session->id_usuario,
        //     'visible'     => 1,
        //     'nombre_carpeta'     => $nombre_unix
        // ];

        $dataConfig = [
            "tabla"=>"seg_usuarios",
            "editar"=>false,
            // "idEditar"=>['id_usuario'=>$data['id_usuario']]
        ];
        $response = $this->globals->saveTabla($dataInsert,$dataConfig,["script"=>"Usuario.saveUsuario"]);
        return $this->respond($response);
    }
    
}