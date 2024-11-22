<?php

class Image {

    /**
     * Subir una imagen al servidor.
     * @param string $directory El directorio donde se almacenará la imagen
     * @param array $dataFile Información del archivo recibido
     * @return string Nombre de la imagen subida
     */
    public static function uploadImage($directory, $dataFile): string {

        $name = (explode(".", $dataFile['name']));
        $extension = end($name);
        $filename = time() . ".$extension";

        $fileUpload = move_uploaded_file(
            $dataFile['tmp_name'],
            "$directory/$filename"
        );

        if (!$fileUpload) {
            throw new Exception("No se pudo subir la imagen");
        } else {
            return $filename;
        }
    }

     /**
     * Eliminar una imagen del servidor.
     * @param string $file La ruta del archivo que se desea eliminar.
     * @return bool Retorna TRUE si el archivo fue eliminado exitosamente, o FALSE si no existe.
     */
    public static function deleteImage($file): bool {

        if (file_exists($file)) {

            $fileDelete = unlink($file);

            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }
}

?>
