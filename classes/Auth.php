<?php

class Auth {

    /**
     * Verifica las credenciales del usuario, y de ser correctas, guarda los datos en la sesión
     * @param string $username El nombre de usuario provisto
     * @param string $password El password provisto
     * @return mixed Devuelve el rol en caso que las credenciales sean correctas, FALSE en caso de que no lo sean y Null en caso que el usuario no se encuentre en la BDD
     */
    public static function login(string $email, string $password) {

        $user = User::getByEmail($email);

        if ($user) {

            if (password_verify($password, $user->getPassword())) {

                $datosLogin['id'] = $user->getId();
                $datosLogin['email'] = $user->getEmail();
                $datosLogin['name'] = $user->getName();
                $datosLogin['role'] = $user->getRole();

                $_SESSION['user'] = $datosLogin;

                echo "USER DATE A GUARDAR:";

                echo "<pre>";
                print_r($datosLogin);
                echo "</pre>";

                return $datosLogin['role'];
            } else {
                Alert::addAlert('danger', "El password ingresado no es correcto.");
                return false;
            }
        } else {
            Alert::addAlert('warning', "El usuario ingresado no se encontró en nuestra base de datos.");
            return NULL;
        }
    }

    /**
     * Verifica si existe un usuario dentro de la sesion y en el caso de que asi sea lo elimina
     */
    public static function logout() {

        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        };

        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }

    /**
     * Verifica si existe un usuario dentro de la sesion y en el caso de que asi sea lo elimina
     * @param number $level nivel de restrccion a aplicar
     * @return bool true en caso de poder ver la vista, caso contrario false
     */
    public static function verify($level = 0): bool {
        if (!$level) {
            return true;
        }
    
        if (isset($_SESSION['user'])) {
            
            if ($level > 1) {
                
                if (
                    $_SESSION['user']['role'] == "admin" 
                    or 
                    $_SESSION['user']['role'] == "superadmin"
                ) {
                    return true;
                } else {
                    Alert::addAlert('danger', "No tiene permisos para acceder a esta sección");
                    header('location: /admin/index.php?sec=login');
                    exit;
                }
    
            } else {
                return true;
            }
    
        } else {
            $routeMod = $level > 1 ? "./" : "";
            header("location: {$routeMod}index.php?sec=login");
            exit;
        }
    }}

?>