<?php
require_once 'SModelo/producto.entidad.php';
require_once 'SModelo/producto.model.php';

class ProductoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new ProductoModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/Producto/producto.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Producto();
        
        if(isset($_REQUEST['intIdProducto'])){
            $alm = $this->model->Obtener($_REQUEST['intIdProducto']);
        }
        
        require_once 'view/header.php';
        require_once 'view/Producto/producto-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $alm = new Producto();
        
        $alm->__SET('intIdProducto',   $_REQUEST['intIdProducto']);
        $alm->__SET('nvchNombre',      $_REQUEST['nvchNombre']);
        $alm->__SET('dcmPrecio',       $_REQUEST['dcmPrecio']);
        $alm->__SET('intCantidad',     $_REQUEST['intCantidad']);
        
        // add img
        $alm->__SET('nvchDireccionImg',$_REQUEST['nvchDireccionImg']);
        if( !empty( $_FILES['nvchDireccionImg']['name'] ) ){
            $foto = date('ymdhis') . '-' . strtolower($_FILES['nvchDireccionImg']['name']);
            move_uploaded_file ($_FILES['nvchDireccionImg']['tmp_name'], 'uploads/' . $foto);
            
            $alm->__SET('nvchDireccionImg', $foto);
        }
        // END add img


        $alm->__SET('nvchDescripcion',    $_REQUEST['nvchDescripcion']);
        $alm->__SET('intIdUbigeoProducto',$_REQUEST['intIdUbigeoProducto']);


        if($alm->__GET('intIdProducto') != '' ? 
           $this->model->Actualizar($alm) : 
           $this->model->Registrar($alm));
        
        header('Location: adminproducto.php');
    }
    
    /*
    public function Excel(){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=mi_archivo.xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
        
        require_once 'view/alumno/alumno-excel.php';
    }
    */
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['intIdProducto']);
        header('Location: adminproducto.php');
    }
}