<?php

/**
 * Archivo practica-jdmape.php
 * 
 * 
 * @author Juan de Dios Macía Perea <juandemac@hotmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Administra las rutas o peticiones
 * 
 * Las peticiones a la aplicación se hace de la forma
 * "controlador/método/param1/param2/..../paramN", y esta clase se encarga del
 * manejo de estas peticiones, extrae el controlador y el método y agrupa los
 * parámetros en un arreglo.
 */
class Peticion {

    /**
     * @var string Controlador de la petición 
     */
    public static $controlador;

    /**
     * @var string Método de la petición 
     */
    public static $metodo;

    /**
     * @var array Parámetros de la petición 
     */
    public static $args;

    /**
	 * 
     * @var string Url saneado de la petición 
     */
    private static $url;

    /**
     * Obtiene las partes de la petición
     * 
     * Extrae el controlador y el método de la petición, si el controlador o
     * método no existe se les asigna un controlador y método por defecto 
     * denominado index; también agrupa los parámetros en un arreglo, si 
     * no existen parámetros se asigna un arreglo vacío.
     */
    public static function rutear() {
        if (!is_null(filter_input(INPUT_GET, 'url'))) {
            self::$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $_aux = array_filter(explode('/', self::$url));
            self::$controlador = strtolower(array_shift($_aux));
            self::$metodo = strtolower(array_shift($_aux));
            self::$args = $_aux;

            if (empty(self::$metodo)) {
                self::$metodo = 'index';
            }
        } else {
            self::$controlador = 'index';
            self::$metodo = 'index';
            self::$args = array();
        }
    }

    /**
     * Obtiene el método de la petición
     * 
     * Une el prefijo al método de la petición 
     * @param string $prefijo Cadena prefijo
     * @return string Método a ejecutar
     */
    public static function getMetodo($prefijo = "") {
        return $prefijo . self::$metodo;
    }

}