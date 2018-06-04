<?php
@session_start();
setlocale(LC_TIME, 'es_ES.utf8') OR setlocale(LC_TIME, 'es_ES');

// file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos->nombre, TRUE).PHP_EOL, FILE_APPEND );

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


        $this->loginInfo = $_SESSION["login_info"];

    }

    /* ----------------------------------------------------------------------
                            FUNCIONES BASE SQL
   ---------------------------------------------------------------------- */

    /* SUCESIÓN: select -> preparaSQL -> getRows -> ejecutarSQL */
    /**
     * Función SELECT en BD
     *
     * @param string $modulo Módulo a consultar
     * @param string $cond Condiciones de la consulta
     * @param string $campos Campos a devolver
     * @param string $order Orden establecido
     * @param string $limit Limite de filas
     * @return array Filas devueltas por la consulta sql
     */
    public function select($modulo, $cond = null, $campos = "*", $order = null, $limit = null) {

        // Preparamos la consulta SQL
        $sql = $this->preparaSQL([
            "modulo" => $modulo,
            "cond" => $cond,
            "campos" => $campos,
            "order" => $order,
            "limit" => $limit
        ]);

        $resultado = $this->getRows($sql);      // Recogemos los valores devueltos por la consulta

        return $resultado;
    }

    /**
     * Prepara consulta SELECT
     *
     * @param array $parametros Diferentes parametros para la consulta
     * @return string Consulta SQL completa
     */
    public function preparaSQL($parametros) {

        // Inicializamos
        $parametros = (object)$parametros;

        // Comprobaciones y adaptaciones
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

    /**
     * Obtiene las filas devueltas por la consulta
     *
     * @param string $sql Consulta SQL
     * @return array Filas devueltas por la consulta
     */
    public function getRows($sql) {

        if(!$res = $this->ejecutarSQL($sql)) return null;

        // Si la consulta tiene resultado
        $resultado = [];
        while($row = mysqli_fetch_object($res)) {
            $resultado[] = $row;        // Copiamos las columnas devueltas
        }
        mysqli_free_result($res);       // Limpiamos memoria

        return $resultado;
    }

    /**
     * Ejecuta la consulta SQL
     *
     * @param string $sql Consulta SQL
     * @return mysqli_result|bool 1 si ha tenido éxito, false en caso contrario
     */
    public function ejecutarSQL($sql) {

        if($sql == null || $sql == "") return null;

        $sql = trim($sql);  // Eliminarmos espacios en blanco (ini y fin)

        $resultado = mysqli_query($this->BD_CONEXION, $sql);     // Ejecutamos

        if($resultado) return $resultado;

        return false;
    }

    /**
     * Inserción de registros en BD
     *
     * @param array|object $valores Valores a insertar
     * @param string $modulo Módulo en el que insertar
     * @return bool true si ha tenido éxito
     */
    public function insert($valores, $modulo) {

        // Preparamos la consulta
        $sql = $this->insert_getSQL($valores, $modulo);

        // Ejecutamos
        if($this->ejecutarSQL($sql)) return true;

        return false;
    }

    /**
     * Prepara consulta INSERT
     *
     * @param array|object $valores Valores a insertar
     * @param string $modulo Módulo en el que insertar
     * @return string  Consulta SQL completa
     */
    public function insert_getSQL($valores, $modulo) {

        // Inicializamos
        $row = (object)$valores;

        // Preparamos la cabecera de la consulta
        $sql = $this->insert_getSQL_Cabecera($valores, $modulo);

        // Añadimos la parte de VALUES
        $sql .= "(";
        foreach ($row as $var => $valor) {
            $aux = mysqli_real_escape_string($this->BD_CONEXION, $valor);
            $sql .= "'$aux'" . ",";
        }

        $sql = rtrim($sql, ",");    // Eliminamos la "," del final de la consulta
        $sql .= ")";                        // Concatenamos

        return $sql;
    }

    /**
     * Prepara cabecera consulta INSERT
     * INSERT INTO .... (.., ..., ..., ....) VALUES
     *
     * @param array|object $valores Valores a insertar
     * @param string $modulo Módulo en el que insertar
     * @return string  Consulta SQL parcial
     */
    public function insert_getSQL_Cabecera($valores, $modulo) {

        // Inicializamos
        $row = (object)$valores;

        $sql = "INSERT INTO $modulo(";      // Preparamos la cabecera de la consulta
        foreach($row as $var => $valor) {
            $sql .= "$var,";                // INSERT INTO servicios (nombre, apellidos, dni, ....)
        }

        $sql = rtrim($sql, ",");    // Eliminamos la "," del final de la consulta
        $sql .= ") VALUES";                 // Concatenamos

        return $sql;
    }

    /**
     * Actualizacion de registros en BD
     *
     * @param array|object $valores Valores a actualizar
     * @param string $modulo Módulo sobre el que actualizar
     * @param string $cond Condicion
     * @return bool true si ha tenido éxito
     */
    public function update($valores, $modulo, $cond){
        /* Especial cuidado con la condicion, 1 actualiza el modulo al completo */
        // UPDATE `modulo` SET `nom_valor1`=valor1,`nom_valor2`=valor1 WHERE 1

        // Inicializamos
        $valores = (object)$valores;
        $sql = "";

        // Montamos la parte segunda de la consulta
        foreach ($valores as $var => $valor) {
            $aux = mysqli_real_escape_string($this->BD_CONEXION, $valor);
            $sql .= "$var=" . "'$valor'" . ",";
        }

        $sql = rtrim($sql, ",");                // Eliminamos la "," del final de la consulta
        $sql = "UPDATE $modulo SET $sql WHERE $cond";   // Montamos la consulta SQL completa

        if($this->ejecutarSQL($sql)) return true;       // Ejecutamos

        return false;
    }

    /**
     * Borrado de registros en BD
     *
     * @param string $modulo Módulo sobre el que borrar
     * @param string $cond Condicion
     * @return bool true si ha tenido éxito
     */
    public function delete($modulo, $cond) {

        $sql = "DELETE FROM $modulo WHERE $cond";   // Montamos la consulta SQL completa

        if($this->ejecutarSQL($sql)) return true;       // Ejecutamos

        return false;
    }

    /* ----------------------------------------------------------------------
                       FIN FUNCIONES BASE SQL
   ---------------------------------------------------------------------- */

    /**
     * SELECT * FROM usuarios WHERE nombre = '$user' AND pass = '$pass'"
     */
    public function login($user, $pass) {

        $row = $this->select("usuarios", "nombre = '$user' AND pass = '$pass'");

        if($row[0]->nombre == $user) {
            $this->loginInfo = $_SESSION["login_info"] = $row[0];
            return true;
        }

        return false;
    }

}
