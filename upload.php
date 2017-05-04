<?php

set_time_limit(0);
session_start();
$upload_path = "uploded_folder/";
$fileUploader = new FileUploader($_FILES, $upload_path);

class FileUploader {

    public function __construct($uploads, $uploadDir) {
        $bool = false;
        $paths = explode("###", rtrim($_SESSION["upload_paths"], "###"));
        foreach ($uploads as $key => $current) {
            $this->uploadFile = $uploadDir . rtrim($paths[$key], "/.");
            $this->folder = substr($this->uploadFile, 0, strrpos($this->uploadFile, "/"));
            if (strlen($current['name']) != 1) {
                if ($this->upload($current, $this->uploadFile)) {
                    $bool = true;
                }
            }
        }
        if ($bool) {
            echo "All files are uploaded, May check folder UPLODED_FOLDER";
        } else {
            echo "Some error has occured.";
        }
    }

    private function upload($current, $uploadFile) {
        if (!is_dir($this->folder)) {
            $old = umask(0);
            mkdir($this->folder, 0777, true);
            umask($old);
        }
        if (move_uploaded_file($current['tmp_name'], $uploadFile)) {
            return true;
        } else {
            return false;
        }
    }
}

?>
