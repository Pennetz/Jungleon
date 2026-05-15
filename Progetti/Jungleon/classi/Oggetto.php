<?php

class Oggetto
{
    public string $nome;
    public int $livello;
    public ?string $Utenti;
    public ?string $descrizione;
    public ?string $storia;
    public int $valore;
    public string $rarita;
    public int $pubblico;
    public array $tipiArmature;
    public array $tipiArmi;
    public array $tipiPozioni;
    public array $tipiReliquie;

    public function __construct(
        string $nome,
        int $livello,
        ?string $Utenti,
        ?string $descrizione,
        ?string $storia,
        int $valore,
        string $rarita,
        int $pubblico = 0,
        array $tipiArmature = [],
        array $tipiArmi = [],
        array $tipiPozioni = [],
        array $tipiReliquie = []
    ) {
        $this->nome = $nome;
        $this->livello = $livello;
        $this->Utenti = $Utenti;
        $this->descrizione = $descrizione;
        $this->storia = $storia;
        $this->valore = $valore;
        $this->rarita = $rarita;
        $this->pubblico = $pubblico;
        $this->tipiArmature = $tipiArmature;
        $this->tipiArmi = $tipiArmi;
        $this->tipiPozioni = $tipiPozioni;
        $this->tipiReliquie = $tipiReliquie;
    }

    public static function fromRequest(object $data): self
    {
        $tipiArmature = isset($data->tipiArmature) && is_array($data->tipiArmature) ? $data->tipiArmature : [];
        $tipiArmi = isset($data->tipiArmi) && is_array($data->tipiArmi) ? $data->tipiArmi : [];
        $tipiPozioni = isset($data->tipiPozioni) && is_array($data->tipiPozioni) ? $data->tipiPozioni : [];
        $tipiReliquie = isset($data->tipiReliquie) && is_array($data->tipiReliquie) ? $data->tipiReliquie : [];

        return new self(
            (string) $data->nome,
            (int) $data->livello,
            $data->Utenti ?? null,
            $data->descrizione ?? null,
            $data->storia ?? null,
            (int) $data->valore,
            (string) ($data->rarita ?? ($data->{'rarità'} ?? '')),
            (int) ($data->pubblico ?? 0),
            $tipiArmature,
            $tipiArmi,
            $tipiPozioni,
            $tipiReliquie
        );
    }

    public function toDbValues(): array
    {
        return [
            $this->nome,
            $this->livello,
            $this->Utenti,
            $this->descrizione,
            $this->storia,
            $this->valore,
            $this->rarita,
            $this->pubblico,
        ];
    }
}