<?php

class Alert {

    /**
     * Registra una alerta en el sitema, guardandola en la sesión
     * @param string $tipo el tipo de alerta danger/warning/success
     * @param string $mensaje El contenido de la alerta
     */
    public static function addAlert(string $type, string $message) {

        $_SESSION['alerts'][] = [
            'type' => $type,
            'message' => $message
        ];

    }

    /**
     * Vacia la lista de alertas
     */
    public static function clearAlerts() {
        $_SESSION['alerts'] = [];
    }

    /**
     * Devuelve todas las alertas acumuladas en el sistema, y vacia la lista
     * @return string 
     */
    public static function getAlerts() {

        if (!empty($_SESSION['alerts'])) {

            $currentAlerts = "";
            foreach ($_SESSION['alerts'] as $alert) {
                $currentAlerts .= self::printAlert($alert);
            }
            self::clearAlerts();
            return $currentAlerts;
            
        }else {
            return null;
        }

    }

    /**
     * Retorna un html con la alerta y su respectivo contenido
     * @return string 
     */
    private static function printAlert($alert): string {
        $html = "<div class='alert alert-{$alert['type']} alert-dismissible fade show' role='alert'>";
        $html .= $alert['message'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $html .= "</div>";    

        return $html;
    }
}

?>