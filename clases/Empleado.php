<?php
abstract class Empleado {
    private string $dni;
    private string $nombre;
    private array $marcas = [];

    public function __construct(string $dni, string $nombre, array $marcas = []) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->marcas = $marcas;
    }

    public function getDni(): string { return $this->dni; }
    public function getNombre(): string { return $this->nombre; }
    public function getMarcas(): array { return $this->marcas; }

    public function agregarMarca(array $marca): void {
        $this->marcas[] = $marca;
    }

    // Polimorfismo: Cada clase hija calculará su estado (Tardanza / A tiempo)
    abstract public function registrarAsistencia(string $fecha, string $hora): array;
}