<?php
class ProductoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=db_resteco', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tb_producto");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Producto();

				$alm->__SET('intIdProducto', $r->intIdProducto);
				$alm->__SET('nvchNombre', $r->nvchNombre);
				$alm->__SET('dcmPrecio', $r->dcmPrecio);
                $alm->__SET('intCantidad', $r->intCantidad);
                $alm->__SET('nvchDireccionImg', $r->nvchDireccionImg);
                $alm->__SET('nvchDescripcion', $r->nvchDescripcion);
				$alm->__SET('intIdUbigeoProducto', $r->intIdUbigeoProducto);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tb_producto WHERE intIdProducto = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Producto();

			$alm->__SET('intIdProducto', $r->intIdProducto);
			$alm->__SET('nvchNombre', $r->nvchNombre);
			$alm->__SET('dcmPrecio', $r->dcmPrecio);
            $alm->__SET('intCantidad', $r->intCantidad);
            $alm->__SET('nvchDireccionImg', $r->nvchDireccionImg);
            $alm->__SET('nvchDescripcion', $r->nvchDescripcion);
			$alm->__SET('intIdUbigeoProducto', $r->intIdUbigeoProducto);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tb_producto WHERE intIdProducto = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Producto $data)
	{
		try 
		{
			$sql = "UPDATE tb_producto SET 
						nvchNombre          = ?, 
						dcmPrecio        = ?,
						intCantidad            = ?, 
						nvchDireccionImg = ?,
                        nvchDescripcion          = ?,
                        intIdUbigeoProducto            = ? 
				    WHERE intIdProducto = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nvchNombre'), 
					$data->__GET('dcmPrecio'), 
					$data->__GET('intCantidad'),
					$data->__GET('nvchDireccionImg'),
                    $data->__GET('nvchDescripcion'),
                    $data->__GET('intIdUbigeoProducto'),
					$data->__GET('intIdProducto')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Producto $data)
	{
		try 
		{
		$sql = "INSERT INTO tb_producto 
				(
					nvchNombre,
					dcmPrecio,
					intCantidad,
					nvchDireccionImg,
					nvchDescripcion,
					intIdUbigeoProducto
				) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nvchNombre'), 
				$data->__GET('dcmPrecio'), 
				$data->__GET('intCantidad'),
				$data->__GET('nvchDireccionImg'),
                $data->__GET('nvchDescripcion'),
                $data->__GET('intIdUbigeoProducto'),
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}