<?php
namespace Src\Core\Interfaces;

interface IRequest{
    public function getRoute();
    public function getParams();
}