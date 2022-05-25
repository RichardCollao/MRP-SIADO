<?php

class CreateController extends EstablishmentsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = array();
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_establishment' => 0,
                'name_business' => $data['name_business'],
                'rut_business' => $data['rut_business'],
                'address_business' => $data['address_business'],
                'phone_business' => $data['phone_business'],
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'defaults_measures' => require_once (path::appConfigs('defaults_measures.php'))
            );

            if (!is_empty($this->_Model->duplicateName($values))) {
                $errors[] = 'El nombre ya se encuentra en uso';
            } elseif ($this->_Model->createEstablishment($values)) {

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
            }
        }
        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    private function _loadDataFromPost() {
        return array(
            'name_business' => trim($_POST['name_business']),
            'rut_business' => trim($_POST['rut_business']),
            'address_business' => trim($_POST['address_business']),
            'phone_business' => trim($_POST['phone_business']),
            'name' => trim($_POST['name']),
            'rut' => trim($_POST['rut']),
            'address' => trim($_POST['address']),
            'phone' => trim($_POST['phone'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (!preg_match('/^[^0-9][a-z0-9\-\s_ñ]{1,64}$/i', $name_business)) {
            $errors[] = 'El campo nombre constrcutorano es valido';
        }

        if (!preg_match('/^\d{1,8}\-[K|k|0-9]$/', $rut_business)) {
            $errors[] = 'El campo rut constructorano es valido';
        }

        if (Validate::address($address_business) !== true) {
            $errors[] = 'El campo direccion constructorano es valido, caracteres pemitidos letras, números, espacios, /.#-_';
        }

        if (strlen($phone_business) < 3 || strlen($phone_business) > 32) {
            $errors[] = 'El campo telefono constructora debe contener entre 3 y 16 carateres';
        } elseif (!preg_match('/^[0-9]+$/', $phone_business)) {
            $errors[] = 'El campo <b>telefono</b> no es valido, solo se permiten números';
        }

        if (!preg_match('/^[^0-9][a-z0-9\-\s_ñ]{1,64}$/i', $name)) {
            $errors[] = 'El campo nombre obrano es valido';
        }

        if (Validate::address($address) !== true) {
            $errors[] = 'El campo direccion obrano es valido, caracteres pemitidos letras, números, espacios, /.#-_';
        }

        if (strlen($phone) < 3 || strlen($phone) > 32) {
            $errors[] = 'El campo telefono obra debe contener entre 3 y 16 carateres';
        } elseif (!preg_match('/^[0-9]+$/', $phone)) {
            $errors[] = 'El campo telefono obra no es valido, solo se permiten números';
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
