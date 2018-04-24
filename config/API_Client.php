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

//        $query = "SELECT * FROM usuarios WHERE nombre = '$user' AND pass = '$pass' ";
//
//        if($res = $this->BD_CONEXION->query($query)){ // Existe
//            if($row = $res->fetch_object()){
//                $this->loginInfo = $_SESSION["ws_login_info"] = $row;
//                return true;
//            }
//        }
//        return false;

        $row = $this->getRows("usuarios", "nombre = '$user' AND pass = '$pass'");

        if($row[0]->nombre == $user) {
            $this->loginInfo = $_SESSION["ws_login_info"] = $row[0];
            return true;
        }

        return false;
    }

    public function nuevoServicio($datos) {
//        $datos = json_decode($datos);
//       file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos->nombre, TRUE).PHP_EOL, FILE_APPEND );

//        $query = "INSERT INTO servicios (nombre, apellidos, dni, tipo_servicio, tanatorio,
//        poblacion, provincia, calle, numero, fecha_nacimiento,estado_civil)
//        VALUES ('$datos->nombre', '$datos->apellidos', '$datos->DNI', '$datos->tipo_servicio',
//        '$datos->tanatorio', '$datos->natural_de', '$datos->provincia', '$datos->calle',
//        '$datos->numero', '$datos->fecha_nacimiento', '$datos->estado_civil')";
//
//        if($this->BD_CONEXION->query($query)) return true;
//
//        return false;

        $datos = json_decode($datos);
        $valores = [
            "nombre" => $datos->nombre,
            "apellidos" => $datos->apellidos,
            "dni" => $datos->DNI,
            "tipo_servicio" => $datos->tipo_servicio,
            "tanatorio" => $datos->tanatorio,
            "poblacion" => $datos->natural_de,
            "provincia" => $datos->provincia,
            "calle" => $datos->calle,
            "numero" => $datos->numero,
            "fecha_nacimiento" => $datos->fecha_nacimiento,
            "estado_civil" => $datos->estado_civil,
        ];

        $resultado = $this->insertar($valores, "servicios", "insertar");

        return $resultado;
    }

    public function getDifunto($nombre, $apellidos) {

//        $query = "SELECT * FROM servicios WHERE nombre = '$nombre' AND apellidos = '$apellidos'";
//
//        if($res = $this->BD_CONEXION->query($query)){ // Existe
//            if($row = $res->fetch_object()){
//                // Probar el caso en que haya varios difuntos con igual nombre ( while )
//                return $row;
//            } else return null;
//        } else return null;

        $row = $this->getRows("servicios", "nombre = '$nombre' AND apellidos = '$apellidos'");

        if($row[0]) return $row[0];
        return false;
    }

    /* ----------------------------------------------------------------------
                            FUNCIONES BASE SQL
   ---------------------------------------------------------------------- */

    function prueba(){
        //$resultado = $this->getRows("servicios", null, null, "nombre", 5);
        //$resultado = $this->getRows("servicios", "dni = '77375026 - J'", "nombre, apellidos");
//        INSERT INTO `usuarios`(`nombre`, `pass`, `rol`) VALUES ("luisss","pass_luis","jefe")
        $valores = [
            "nombre" => "luis_prueba",
            "pass" => "luis_pass",
            "rol" => "admin"
        ];

        $resultado = $this->insertar($valores, "usuarios", "insertar");

        print("<pre>");
        print_r($resultado);
        print("</pre>");
    }

    /*
    SUCESIÓN: getRows -> preparaSQL -> getArray -> ejecutarSQL
    */

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

        /****************************************/
        file_put_contents (__DIR__."/SOMELOG_SQL.log" , print_r($sql, TRUE).PHP_EOL, FILE_APPEND );
        print("<pre>");
        print_r("CONSULTA SQL: ");
        print_r($sql);
        print("</pre>");
        /****************************************/

        // Ejecutamos
        $resultado = mysqli_query($this->BD_CONEXION, $sql);

        if($resultado) return $resultado;

        return false;
    }

    /**
     * Función auxiliar para insertar en BD
     *
     * @param array|object $valores Valores a insertar
     * @param string $modulo Módulo
     * @param string $op Operación: "insertar" o "editar"
     * @return int|bool ID del registro insertado o false en caso de error
     * @return bool true si ha tenido éxito
     */
    public function insertar($valores, $modulo, $op = null) {

        // Preparamos la consulta
        $sql = $this->insertar_getSQL($valores, $modulo, $op);
        // Ejecutamos
        if($this->ejecutarSQL($sql)) return true;

        return false;
    }

    public function insertar_getSQL($valores, $modulo, $op = null) {

        // Inicializamos
        $row = (object)$valores;
        $sql = "";

        // Preparamos la cabecera de la consulta
        // INSERT INTO servicios (nombre, apellidos, dni, ....) values
        $sql = $this->insertar_getSQL_Cabecera($valores, $modulo, $op);

        // Añadimos la parte de VALUES
        $sql .= "(";
        foreach ($row as $var => $valor) {
            $aux = mysqli_real_escape_string($this->BD_CONEXION, $valor);
            $sql .= "'$aux'" . ",";
        }

        $sql = rtrim($sql, ",");    // Eliminamos la "," del final de la consulta
        $sql .= ")";     // Concatenamos

        return $sql;
    }

    public function insertar_getSQL_Cabecera($valores, $modulo, $op = null) {

        // Inicializamos
        $row = (object)$valores;

        if($op == null) $accion = "INSERT";
        else $accion = ($op == "editar") ? "REPLACE" : "INSERT";

        // Preparamos la cabecera de la consulta
        $sql = "$accion INTO $modulo(";
        foreach($row as $var => $valor) {
            $sql .= "$var,";    // INSERT INTO servicios (nombre, apellidos, dni, ....)
        }

        $sql = rtrim($sql, ",");    // Eliminamos la "," del final de la consulta
        $sql .= ") VALUES";     // Concatenamos

        return $sql;
    }


    /**
     * Función auxiliar para insertar en BD
     *
     * @param int $idEnvio
     * @param int $idFacturacion
     * @param int $payPal0Tarjetas1
     * @param int $idTarjeta
     * @param string $idTransaccion
     * @return object
    {
    "IdPedido": 0,
    "Mensajes": "string"
    }
     */







































}