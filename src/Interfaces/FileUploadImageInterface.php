<?php

namespace Aboleon\Framework\Interfaces;

interface FileUploadImageInterface
{
    public function ajax();
    public function setWidthHeight();
    public function processCrop();
    public function processDelete();
    public function processUpload();
}