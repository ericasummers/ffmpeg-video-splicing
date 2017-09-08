<?php
    function retrieveMovieFolder(movFilePath) {
        $videoFileEndings = ['.mov', '.avi', '.gif', '.mp4', '.webm'];
        $folderPath = str_replace($videoFileEndings, '', movFilePath);
        if (file_exists($folderPath)) {
            retrieveFolderImages($folderPath);
        } else {
            try {
                mkdir($folderPath);
            } catch (Exception $e) {
                `echo ${e}`;
            }
            try {
                exec('ffmpeg -i ' . movFilePath . ' -vf fps=1/30 ' . $folderPath . '/img%03d.png');
            } catch (Exception $e) {
                `echo ${e}`;
            }
            retrieveFolderImages($folderPath);
        }
    }

    function retrieveFolderImages(folderPath) {
        $images = [];
        $allFolderFileNames = array_diff(scandir(folderPath), array('..', '.'));
        foreach($allFolderFileNames as $fileName) {
            if (pathinfo($fileName)['extension'] === 'jpg' || pathinfo($fileName)['extension'] === 'png') {
                array_push($images, $fileName);
            }
        }
        return $images;
    }
