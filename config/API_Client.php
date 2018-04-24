<?php
@session_start();
setlocale(LC_TIME, 'es_ES.utf8') OR setlocale(LC_TIME, 'es_ES');

class APIClient {

    public $HOST = "localhost";
    public $BD = "funesterp";
    public $USER = "root";
    public $PASS = "";
    public $BD_CONEXION;

    // Variables auxiliares
    public $loginInfo;
    public $debug;

    public function __construct() {
        $this->BD_CONEXION = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->BD);
        mysqli_set_charset($this->BD_CONEXION, "utf8");

        $this->initParametros();
    }

    private function initParametros(){
        // Util para cuando cerramos la ventana y la sesion no ha caducado
        // y por tanto hay que reutilizar los datos de la API
        $this->loginInfo = $_SESSION["ws_login_info"];
    }

    public function login($user, $pass) {

        $query = "SELECT usuarios.* FROM usuarios WHERE nombre = '$user' AND pass = '$pass' ";

        if($res = $this->BD_CONEXION->query($query)){ // Existe
            if($row = $res->fetch_object()){
                $this->loginInfo = $_SESSION["ws_login_info"] = $row;
                return true;
            }
        }
        return false;
    }

    public function nuevoServicio($datos) {
        $datos = json_decode($datos);
//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos->nombre, TRUE).PHP_EOL, FILE_APPEND );

        $query = "INSERT INTO servicios (nombre, apellidos, dni, tipo_servicio, tanatorio, 
        poblacion, provincia, calle, numero, fecha_nacimiento,estado_civil) 
        VALUES ('$datos->nombre', '$datos->apellidos', '$datos->DNI', '$datos->tipo_servicio', 
        '$datos->tanatorio', '$datos->natural_de', '$datos->provincia', '$datos->calle', 
        '$datos->numero', '$datos->fecha_nacimiento', '$datos->estado_civil')";

        if($this->BD_CONEXION->query($query)) return true;
        return false;
    }

    public function getDifunto($nombre, $apellidos) {

        $query = "SELECT * FROM servicios WHERE nombre = '$nombre' AND apellidos = '$apellidos'";

        if($res = $this->BD_CONEXION->query($query)){ // Existe
            if($row = $res->fetch_object()){
                // Probar el caso en que haya varios difuntos con igual nombre ( while )
                return $row;
            } else return null;
        } else return null;

    }


    /* ----------------------------------------------------------------------
                             FUNCIONES BASE SQL
    ---------------------------------------------------------------------- */

    public function prueba(){
        //$resultado = $this->getRows("servicios", null, null, "nombre", 5);
        $resultado = $this->getRows("servicios", "dni = '77375026 - J'", "nombre, apellidos");

        print("<pre>");
        print_r($resultado);
        print("</pre>");
    }


    public function getRows($modulo, $cond = null, $campos = "*", $order = null, $limit = null, &$sql = null) {

        /* Elimino la posibilidad de que el modulo sea null */
        //if($modulo == null) global $modulo;       // Necesario?

        // Preparamos la consulta SQL
        $sql = $this->preparaSQL([
            "modulo" => $modulo,
            "cond" => $cond,
            "campos" => $campos,
            "order" => $order,
            "limit" => $limit
        ]);

        // Recogemos los valores devueltos por la consulta
        $resultado = $this->getArray($sql);

        return $resultado;
    }

    public function preparaSQL($parametros) {

        //global $modulo;     // Necesario?
        $parametros = (object)$parametros;

        // Comprobaciones y adaptaciones
        //if($parametros->modulo == null) $parametros->modulo = $modulo;  // Necesario?
        if($parametros->cond === false) $parametros->cond = "false";
        if(!isset($parametros->cond)) $parametros->cond = 1;
        if($parametros->campos == null) $parametros->campos = "*";

        // Montamos la consulta
        $sql = "SELECT $parametros->campos FROM $parametros->modulo WHERE $parametros->cond";

        // Añadimos condiciones menos usuales
        //if($parametros->group_by) $sql = "$sql group by $parametros->group_by";
        //if($parametros->having) $sql = "$sql having $parametros->having";
        if($parametros->order) $sql = "$sql ORDER BY $parametros->order";
        if($parametros->limit) $sql = "$sql LIMIT $parametros->limit";

        print("<pre>");
        print_r("CONSULTA SQL: ");
        print_r($sql);
        print("</pre>");

        return $sql;
    }

    public function existeCampo($campo, $tabla) {

    }

    public function getArray($sql) {

        if(!$res = $this->ejecutarSQL($sql)) return null;

        // Si la consulta tiene resultado
        $resultado = [];
        while($row = mysqli_fetch_object($res)) {
            // Copiamos las columnas devueltas
            $resultado[] = $row;
        }
        mysqli_free_result($res);   // Limpiamos memoria

        return $resultado;
    }

    public function ejecutarSQL($sql) {

        if($sql == null || $sql == "") return null;

        $sql = trim($sql);  // Eliminarmos espacios en blanco (ini y fin)
        // Ejecutamos
        $resultado = mysqli_query($this->BD_CONEXION, $sql);

        if($resultado) return $resultado;
        else return false;
    }







































}
