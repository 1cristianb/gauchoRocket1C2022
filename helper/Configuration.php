<?php
include_once('helper/MySqlDatabase.php');
include_once('helper/Router.php');
require_once('helper/MustachePrinter.php');
require_once('helper/Session.php');

include_once('controller/LoginController.php');
include_once('controller/HomeController.php');
include_once('controller/RegistroController.php');
include_once('controller/SuborbitalesController.php');
include_once('controller/VuelosController.php');

include_once('model/LoginModel.php');
include_once('model/RegistroModel.php');
include_once('model/SuborbitalesModel.php');
include_once('model/VuelosModel.php');

require_once('third-party/mustache/src/Mustache/Autoloader.php');

class Configuration {

    public function getLoginController() {
        return new LoginController($this->getLoginModel(), $this->getPrinter());
    }

    public function getHomeController() {
        return new HomeController($this->getPrinter());
    }
    public function getRegistroController() {
        return new RegistroController($this->getRegistroModel(), $this->getPrinter());
    }
    public function getSuborbitalesController() {
        return new SuborbitalesController($this->getSuborbitalesModel(), $this->getPrinter());
    }
	public function getVuelosController() {
        return new VuelosController($this->getVuelosModel(), $this->getPrinter());
    }

    /**
     * Model
     */

    private function getLoginModel(){
        return new LoginModel($this->getDatabase());
    }

    private function getRegistroModel() {
        return new RegistroModel($this->getDatabase());
    }

    private function getSuborbitalesModel() {
        return new SuborbitalesModel($this->getDatabase());
    }
	private function getVuelosModel() {
        return new VuelosModel($this->getDatabase());
    }

    private function getDatabase() {
       return new MySqlDatabase(
            'localhost',
            'root',
            '',
            'gauchorocket');

    }

    private function getPrinter() {
        return new MustachePrinter("view");
    }

    public function getRouter() {
        return new Router($this, "getHomeController", "execute");
    }
}