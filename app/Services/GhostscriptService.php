<?php

namespace App\Services;

class GhostscriptService
{
    protected $ghostscriptPath;

    public function __construct()
    {
        $this->ghostscriptPath = 'C:\Program Files\gs\gs10.03.1\bin\gswin64c.exe'; // Path ke perintah Ghostscript
    }

    public function convertPdfToImage($inputFile, $outputFile)
    {
        $command = sprintf(
            '%s -sDEVICE=pngalpha -o %s -sDEVICE=pdfwrite -dNOPAUSE -dBATCH %s',
            $this->ghostscriptPath,
            escapeshellarg($outputFile),
            escapeshellarg($inputFile)
        );

        return shell_exec($command);
    }

    public function mergePdfs($outputFile, $inputFiles = [])
    {
        $inputFilesString = implode(' ', array_map('escapeshellarg', $inputFiles));
        $command = sprintf(
            '%s -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -sOutputFile=%s %s',
            $this->ghostscriptPath,
            escapeshellarg($outputFile),
            $inputFilesString
        );

        $output = shell_exec($command);

        // Cek apakah file output berhasil dibuat dan tidak kosong
        if (file_exists($outputFile) && filesize($outputFile) > 0) {
            return true;
        } else {
            return false;
        }
    }
}