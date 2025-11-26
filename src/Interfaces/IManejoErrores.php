<?php
namespace Src\Interfaces;

interface IManejoErrores {
    public function logError($mensaje);
    public function mostrarError($mensaje);
}
