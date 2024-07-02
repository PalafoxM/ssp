<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Curps;
use App\Libraries\Fechas;
use App\Libraries\Funciones;
use App\Models\Mglobal;
use App\Models\Magregarturno;


use stdClass;
use Exception;
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
    
    //public function obtenerOpcionesSelect($select, $tabla, $where = null)
    //{
    //     $catalogos = new Mglobal;
    //     try {
    //         $dataDB = array('select' => $select, 'tabla' => $tabla, 'where' => $where);
    //         $response = $catalogos->getTabla($dataDB);

    //         if (isset($response) && isset($response->data)) {
    //             return $response->data;
    //         } else {
    //             return array();
    //         }
    //     } catch (\Exception $e) {
    //         log_message('error', "Se produjo una excepción: " . $e->getMessage());
    //         return array();
    //     }
    // }

    // Ejemplo de uso
    // $opcionesAsunto = obtenerOpcionesSelect('id_asunto, dsc_asunto', 'cat_asuntos', 'visible = 1');


    // public function index()
    // {        
       
    //     $session = \Config\Services::session();   
    //     $data = array();
    //     $catalogos = new Mglobal;
      
    //     try {
    //         $dataDB = array('select'=> 'id_asunto, dsc_asunto', 'tabla' => 'cat_asuntos', 'where' => 'visible = 1');
    //         $response = $catalogos->getTabla($dataDB);
    //         if (isset($response) && isset($response->data)) {
    //             $data['cat_asunto'] = $response->data;
    //         } else {
    //             $data['cat_asunto'] = array(); 
    //         }
    //     } catch (\Exception $e) {
    //         log_message('error', "Se produjo una excepción: " . $e->getMessage());
    //     }
    //     try {
    //         $dataDB = array( 'select'=> 'id_destinatario, nombre_destinatario, cargo, id_tipo_cargo',  'tabla' => 'cat_destinatario', 'where' => 'visible = 1');
    //         $response = $catalogos->getTabla($dataDB);
    //         if (isset($response) && isset($response->data)) {
    //             $data['turnado'] = $response->data;
    //             $resultadoFiltrado = array_filter($response->data, function($elemento) {
    //                 return $elemento->id_tipo_cargo == '2';
    //             });
    //             $data['cppNombre']= $resultadoFiltrado;
    //             $personaFirma = array_filter($response->data, function($elemento) {
    //                 return $elemento->id_tipo_cargo == '9';
    //             });
    //             $data['firmaTurno']= $personaFirma;

    //         } else {
    //             $data['turnado'] = array(); 
    //         }
    //     } catch (\Exception $e) {
    //         log_message('error', "Se produjo una excepción: " . $e->getMessage());
    //     }
    //     try {
    //         $dataDB = array( 'select'=> 'id_indicacion, dsc_indicacion',  'tabla' => 'cat_indicaciones', 'where' => 'visible = 1');
    //         $response = $catalogos->getTabla($dataDB);
    //         if (isset($response) && isset($response->data)) {
    //             $data['indicacion'] = $response->data;
    //         } else {
    //             $data['indicacion'] = array(); 
    //         }
    //     } catch (\Exception $e) {
    //         log_message('error', "Se produjo una excepción: " . $e->getMessage());
    //     }
    //     try {
    //         $dataDB = array( 'select'=> 'id_estatus, dsc_status',  'tabla' => 'cat_estatus', 'where' => 'visible = 1');
    //         $response = $catalogos->getTabla($dataDB);
    //         if (isset($response) && isset($response->data)) {
    //             $data['status'] = $response->data;
    //         } else {
    //             $data['status'] = array(); 
    //         }
    //     } catch (\Exception $e) {
    //         log_message('error', "Se produjo una excepción: " . $e->getMessage());
    //     }
    //     //  var_dump($data['firmaTurno']);
    //     //  die();
    //     $data['scripts'] = array('principal','agregar');
    //     $data['edita'] = 0;
    //     $data['nombre_completo'] = $session->nombre_completo; 
    //     $data['contentView'] = 'formularios/vFormAgregar';                
    //     $this->_renderView($data);
        
    // }
    public function index()
    {
        $session = \Config\Services::session();
        $data = array();
        $catalogos = new Mglobal;

        $tables = array(
            'cat_asuntos' => 'id_asunto, dsc_asunto',
            'cat_destinatario' => 'id_destinatario, nombre_destinatario, cargo, id_tipo_cargo',
            'cat_indicaciones' => 'id_indicacion, dsc_indicacion',
            'cat_estatus' => 'id_estatus, dsc_status'
        );

        foreach ($tables as $table => $select ) {
            try {
                if ($table == 'cat_destinatario'){
                    $dataDB = array('select' => $select, 'tabla' => $table, 'where' => 'visible = 1 ORDER BY id_tipo_cargo ASC');
                    $response = $catalogos->getTabla($dataDB); 
                }
                $dataDB = array('select' => $select, 'tabla' => $table, 'where' => 'visible = 1');
                $response = $catalogos->getTabla($dataDB);

                if (isset($response) && isset($response->data)) {
                    $data[$table] = $response->data;

                    // Filtrar datos según criterios
                    switch ($table) {
                        case 'cat_destinatario':
                            $data['turnado'] = $response->data; //tambien se ocupa esta variable para llenar el select con copia
                            // $data['cppNombre']
                            // $data['cppNombre'] = array_filter($response->data, function($elemento) {
                            //     return $elemento->id_tipo_cargo == '1';
                            // });
                            $data['firmaTurno'] = array_filter($response->data, function($elemento) {
                                return $elemento->id_tipo_cargo == '9';
                            });
                            break;
                    }
                } else {
                    $data[$table] = array();
                }
            } catch (\Exception $e) {
                $this->handleException($e);
            }
        }

            $data['scripts'] = array('principal','agregar');
            $data['edita'] = 0;
            $data['nombre_completo'] = $session->nombre_completo; 
            $data['contentView'] = 'formularios/vFormAgregar';                
            $this->_renderView($data);
    }

    private function handleException($e)
    {
        log_message('error', "Se produjo una excepción: " . $e->getMessage());
    }
    // function validarCampo($valor,$nombreCampo) {
    // // function validarCampo($valor, $nombreCampo) {
    //     $pattern = "/^([a-zA-Z 0-9]+)$/";
    //     // global $pattern;
    //     // return preg_match($pattern, $valor) ? $valor : null;
    //     if (!preg_match($pattern, $valor)) {
    //         throw new Exception("Error en el campo '$nombreCampo': No cumple con el patrón esperado.");
    //         // $this->handleException("Error en el campo '$nombreCampo': No cumple con el patrón esperado.");
    //     }
    
    //      return $valor;
    // }
    // function validarCampo($valor, $nombreCampo) {
    //     $pattern = "/^([a-zA-Z 0-9]+)$/";
    
    //     if (!preg_match($pattern, $valor)) {
    //         throw new Exception("Error en el campo '$nombreCampo': No cumple con el patrón esperado.");
    //     }
    
    //     return $valor;
    // }
    function validarCampo($valor, $nombreCampo) {
        // $pattern = "/^([a-zA-Z 0-9]+)$/";
        $pattern = "/^([a-zA-ZáéíóúüñÁÉÍÓÚÜÑ 0-9]+)$/";
        
        if (!preg_match($pattern, $valor)) {
            throw new Exception("Error en el campo '$nombreCampo': Por favor, utilice únicamente caracteres alfanuméricos (letras y números). Gracias.");
        }
    
        return $valor;
    }
    public function guardaTurno(){
        $session = \Config\Services::session();
        $response = new \stdClass();
        // $response->error = true;
        $agregar = new Magregarturno();
        $data = $this->request->getPost();
        
        $currentDateTime = new \DateTime();
        $formattedDate = $currentDateTime->format('Y-m-d H:i:s');
        $fecha_peticion = $currentDateTime::createFromFormat('d/m/Y', $data['fecha_peticion'])->format('Y-m-d');
        $fecha_recepcion = $currentDateTime::createFromFormat('d/m/Y', $data['fecha_recepcion'])->format('Y-m-d');

        $anioActual = date("Y"); 
        $dataInsert = [
            'anio'                         => $anioActual,
            'id_asunto'                    => $data['asunto'],           
            'fecha_peticion'               => $fecha_peticion,             
            'fecha_recepcion'              => $fecha_recepcion,                           
            'solicitante_titulo'           => $data['titulo_inv'],                 
            'solicitante_nombre'           => $data['nombre_t'],                 
            'solicitante_primer_apellido'  => $data['primer_apellido'],                         
            'solicitante_segundo_apellido' => $data['segundo_apellido'],                         
            'solicitante_cargo'            => $data['cargo_inv'],             
            'solicitante_razon_social'     => $data['razon_social_inv'],                     
            'resumen'                      => $this->validarCampo($data['resumen'],"resumen"),     
            'id_estatus'                   => $data['status'],         
            'confirmacion'                 => isset($data['confirmacion']) ? $data['confirmacion'] : '0',
            'resultado_turno'              => $data['resultado_turno'],             
            'firma_turno'                  => $data['firma_turno'],         
            'usuario_registro'             => $session->id_usuario,             
            'fecha_registro'               => $formattedDate, 
            // arrays
            'id_destinatario'              => isset($data['nombre_turno']) ? $data['nombre_turno'] : array(), 
            'id_destinatario_copia'        => isset($data['cpp']) ? $data['cpp'] : array(),
            'id_indicacion'                => isset($data['indicacion']) ? $data['indicacion'] : array(),
        ];
       /*  var_dump($dataInsert);
        die(); */
        $dataBitacora = ['id_user' =>  $session->id_usuario, 'script' => 'Agregar.php/guardaTurno'];
        
       
        try {
            $respuesta = $agregar->guardarTurnoNuevo($dataInsert, $dataBitacora);
            $response->respuesta = $respuesta;
            return $this->respond($response);
        } catch (\Exception $e) {
            $this->handleException($e);
            
            $response->error = $e->getMessage();
            return $this->respond($response);
        }
    }

  
}