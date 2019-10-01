<?php

namespace App\Models;

class TempUser{
    
    private $nombre;
    private $apellido;
    private $correo;
    private $fechaIngreso;

    public function getNombre(): ?string{
        return $this->nombre;
    }

    public function setNombre(string $nombre): self{
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellido(): ?string{
        return $this->apellido;
    }

    public function setApellido(string $apellido): self{
        $this->apellido = $apellido;
        return $this;
    }

    public function getCorreo(): ?string{
        return $this->correo;
    }

    public function setCorreo(string $correo): self{
        $this->correo = $correo;
        return $this;
    }

    public function getFechaIngreso(): ?\DateTimeInterface{
        return $this->fechaIngreso;
    }

    public function setFechaIngreso(\DateTimeInterface $fechaIngreso): self{
        $this->fechaIngreso = $fechaIngreso;
        return $this;
    }


}
