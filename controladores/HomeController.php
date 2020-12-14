<?php
session_start();
/**
 * Controlador de la página de entrada al portal desde la que se pueden hacer las funciones que te permita tu rol
 */
class HomeController extends BaseController
{
   public function __construct()
   {
      parent::__construct();
      // $this->modelo = new UserModel();
      //$this->mensajes = [];
   }

   public function index()
   {
      $parametros = [
      ];
      $this->view->show("inicio", $parametros);
   }

}
